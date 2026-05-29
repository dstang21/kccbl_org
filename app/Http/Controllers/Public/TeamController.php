<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Game;
use App\Models\PlayerTeam;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\TeamCoach;
use App\Support\SeasonContext;
use Illuminate\Contracts\View\View;

class TeamController extends Controller
{
    public function __construct(private readonly SeasonContext $seasonContext)
    {
    }

    public function index(): View
    {
        $currentSeason = $this->seasonContext->current();

        $clubs = Club::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        $seasonRecords = collect();

        if ($currentSeason) {
            $seasonRecords = SeasonTeam::query()
                ->where('season', $currentSeason->year)
                ->get()
                ->keyBy('club_id');
        }

        return view('public.teams.index', [
            'clubs' => $clubs,
            'currentSeason' => $currentSeason,
            'seasonRecords' => $seasonRecords,
            'title' => 'Teams',
        ]);
    }

    public function showCurrent(Club $club): View
    {
        return $this->showForSeason($club, $this->seasonContext->current());
    }

    public function showSeason(Club $club, Season $season): View
    {
        return $this->showForSeason($club, $season);
    }

    public function printSchedule(Club $club): View
    {
        $currentSeason = $this->seasonContext->current();

        abort_if(! $currentSeason, 404, 'No active season is configured.');

        $games = $this->scheduleForClub($club, $currentSeason);

        return view('public.teams.print', [
            'club' => $club,
            'games' => $games,
            'season' => $currentSeason,
            'title' => $club->name.' Printable Schedule',
        ]);
    }

    private function showForSeason(Club $club, ?Season $season): View
    {
        abort_if(! $season, 404, 'No season is configured.');

        $seasonEntry = SeasonTeam::query()
            ->with('club')
            ->where('club_id', $club->id)
            ->where('season', $season->year)
            ->first();

        $roster = PlayerTeam::query()
            ->with(['player.activeImage'])
            ->where('club_id', $club->id)
            ->where('season', $season->year)
            ->orderByRaw('jersey_num IS NULL')
            ->orderBy('jersey_num')
            ->orderBy('player_id')
            ->get();

        $staff = TeamCoach::query()
            ->with('staff')
            ->where('club_id', $club->id)
            ->where('season', $season->year)
            ->orderBy('staff_id')
            ->get();

        $schedule = $this->scheduleForClub($club, $season);

        $recentResults = $schedule
            ->filter(fn (Game $game) => $game->completed)
            ->sortByDesc('game_date')
            ->take(5);

        $upcomingGames = $schedule
            ->filter(fn (Game $game) => ! $game->completed)
            ->take(5);

        $seasonHistory = SeasonTeam::query()
            ->with('seasonModel')
            ->where('club_id', $club->id)
            ->orderByDesc('season')
            ->get();

        return view('public.teams.show', [
            'club' => $club,
            'currentSeason' => $season,
            'recentResults' => $recentResults,
            'roster' => $roster,
            'seasonEntry' => $seasonEntry,
            'seasonHistory' => $seasonHistory,
            'staff' => $staff,
            'title' => $club->name,
            'upcomingGames' => $upcomingGames,
        ]);
    }

    private function scheduleForClub(Club $club, Season $season)
    {
        return Game::query()
            ->with(['clubOne', 'clubTwo', 'parkField.park'])
            ->forSeason($season)
            ->where(function ($query) use ($club): void {
                $query
                    ->where('club_1_id', $club->id)
                    ->orWhere('club_2_id', $club->id);
            })
            ->orderBy('game_date')
            ->get();
    }
}