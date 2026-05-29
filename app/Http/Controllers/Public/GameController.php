<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameStat;
use App\Models\PlayerTeam;
use Illuminate\Contracts\View\View;

class GameController extends Controller
{
    public function show(int $gameId): View
    {
        $game = Game::query()
            ->with(['clubOne', 'clubTwo', 'parkField.park', 'innings'])
            ->findOrFail($gameId);

        $stats = GameStat::query()
            ->with('player')
            ->where('game_id', $game->game_id)
            ->orderBy('bat_order')
            ->orderBy('pitch_order')
            ->get();

        $memberships = PlayerTeam::query()
            ->where('season', $game->season)
            ->whereIn('player_id', $stats->pluck('player_id')->all())
            ->get()
            ->keyBy('player_id');

        $batting = [
            'team1' => collect(),
            'team2' => collect(),
        ];

        $pitching = [
            'team1' => collect(),
            'team2' => collect(),
        ];

        foreach ($stats as $stat) {
            $membership = $memberships->get($stat->player_id);

            if (! $membership) {
                continue;
            }

            $bucket = $membership->club_id == $game->club_1_id ? 'team1' : 'team2';

            if ($stat->AB > 0 || $stat->R > 0 || $stat->H > 0 || $stat->RBI > 0 || $stat->BB_batter > 0) {
                $batting[$bucket]->push($stat);
            }

            if ((float) $stat->IP > 0.0 || $stat->HA > 0 || $stat->ER > 0 || $stat->SO_Pitched > 0) {
                $pitching[$bucket]->push($stat);
            }
        }

        return view('public.game.show', [
            'batting' => $batting,
            'currentSeason' => null,
            'game' => $game,
            'pitching' => $pitching,
            'title' => 'Game '.$game->game_id,
        ]);
    }
}