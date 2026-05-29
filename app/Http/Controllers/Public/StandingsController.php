<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SeasonTeam;
use App\Support\SeasonContext;
use Illuminate\Contracts\View\View;

class StandingsController extends Controller
{
    public function __construct(private readonly SeasonContext $seasonContext)
    {
    }

    public function index(): View
    {
        $currentSeason = $this->seasonContext->current();

        $standings = collect();

        if ($currentSeason) {
            $standings = SeasonTeam::query()
                ->with('club')
                ->where('season', $currentSeason->year)
                ->orderBy('division')
                ->orderByDesc('wins')
                ->orderBy('losses')
                ->get()
                ->groupBy(fn (SeasonTeam $seasonTeam) => $seasonTeam->division ?: 'League');
        }

        return view('public.standings.index', [
            'currentSeason' => $currentSeason,
            'standings' => $standings,
            'title' => 'Standings',
        ]);
    }
}