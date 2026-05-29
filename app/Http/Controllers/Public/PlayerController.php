<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PlayerTeam;
use App\Models\SeasonStat;
use App\Models\ScoutingVideo;
use App\Support\SeasonContext;
use Illuminate\Contracts\View\View;

class PlayerController extends Controller
{
    public function __construct(private readonly SeasonContext $seasonContext)
    {
    }

    public function index(): View
    {
        $currentSeason = $this->seasonContext->current();

        $memberships = collect();

        if ($currentSeason) {
            $memberships = PlayerTeam::query()
                ->with(['club', 'player.activeImage'])
                ->where('season', $currentSeason->year)
                ->orderBy('club_id')
                ->orderBy('jersey_num')
                ->get();
        }

        return view('public.players.index', [
            'currentSeason' => $currentSeason,
            'memberships' => $memberships,
            'title' => 'Players',
        ]);
    }

    public function show(int $id): View
    {
        $player = Player::query()
            ->with(['activeImage', 'images'])
            ->findOrFail($id);

        $history = PlayerTeam::query()
            ->with('club')
            ->where('player_id', $player->player_id)
            ->orderByDesc('season')
            ->get();

        $seasonStats = SeasonStat::query()
            ->where('player_id', $player->player_id)
            ->orderByDesc('season')
            ->get();

        $videos = ScoutingVideo::query()
            ->where('player_id', $player->player_id)
            ->orderByDesc('post_date')
            ->get();

        return view('public.players.show', [
            'history' => $history,
            'player' => $player,
            'seasonStats' => $seasonStats,
            'title' => $player->full_name,
            'videos' => $videos,
        ]);
    }

    public function leagueRoster(): View
    {
        $currentSeason = $this->seasonContext->current();

        $roster = collect();

        if ($currentSeason) {
            $roster = PlayerTeam::query()
                ->with(['club', 'player.activeImage'])
                ->where('season', $currentSeason->year)
                ->orderBy('club_id')
                ->orderBy('jersey_num')
                ->get()
                ->groupBy(fn (PlayerTeam $membership) => $membership->club?->name ?: 'Unassigned');
        }

        return view('public.roster.index', [
            'currentSeason' => $currentSeason,
            'roster' => $roster,
            'title' => 'League Roster',
        ]);
    }
}