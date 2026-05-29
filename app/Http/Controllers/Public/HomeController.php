<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Club;
use App\Models\Game;
use App\Models\SeasonTeam;
use App\Models\Sponsor;
use App\Support\SeasonContext;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly SeasonContext $seasonContext)
    {
    }

    public function index(): View
    {
        $currentSeason = $this->seasonContext->current();

        $featuredNews = BlogPost::query()
            ->orderByDesc('pinned')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        $sponsors = Sponsor::query()
            ->orderBy('sponsor_level')
            ->orderBy('name')
            ->limit(10)
            ->get();

        $clubs = Club::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        $standings = collect();
        $upcomingGames = collect();
        $recentResults = collect();

        if ($currentSeason) {
            $standings = SeasonTeam::query()
                ->with('club')
                ->where('season', $currentSeason->year)
                ->orderBy('division')
                ->orderByDesc('wins')
                ->orderBy('losses')
                ->limit(8)
                ->get();

            $games = Game::query()
                ->with(['clubOne', 'clubTwo', 'parkField.park'])
                ->forSeason($currentSeason);

            $upcomingGames = (clone $games)
                ->scheduled()
                ->orderBy('game_date')
                ->limit(5)
                ->get();

            $recentResults = (clone $games)
                ->completed()
                ->orderByDesc('game_date')
                ->limit(5)
                ->get();
        }

        return view('public.home.index', [
            'clubs' => $clubs,
            'currentSeason' => $currentSeason,
            'featuredNews' => $featuredNews,
            'recentResults' => $recentResults,
            'sponsors' => $sponsors,
            'standings' => $standings,
            'title' => 'Home',
            'upcomingGames' => $upcomingGames,
        ]);
    }
}