<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Support\SeasonContext;
use Illuminate\Contracts\View\View;

class ScheduleController extends Controller
{
    public function __construct(private readonly SeasonContext $seasonContext)
    {
    }

    public function index(): View
    {
        $currentSeason = $this->seasonContext->current();

        $games = collect();

        if ($currentSeason) {
            $games = Game::query()
                ->with(['clubOne', 'clubTwo', 'parkField.park'])
                ->forSeason($currentSeason)
                ->orderBy('game_date')
                ->get()
                ->groupBy(fn (Game $game) => $game->game_date?->format('l, F j, Y') ?? 'TBD');
        }

        return view('public.schedule.index', [
            'currentSeason' => $currentSeason,
            'games' => $games,
            'title' => 'Schedule',
        ]);
    }

    public function results(): View
    {
        $currentSeason = $this->seasonContext->current();

        $games = collect();

        if ($currentSeason) {
            $games = Game::query()
                ->with(['clubOne', 'clubTwo', 'parkField.park'])
                ->forSeason($currentSeason)
                ->completed()
                ->orderByDesc('game_date')
                ->get()
                ->groupBy(fn (Game $game) => $game->game_date?->format('l, F j, Y') ?? 'TBD');
        }

        return view('public.schedule.results', [
            'currentSeason' => $currentSeason,
            'games' => $games,
            'title' => 'Results',
        ]);
    }
}