<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SeasonStat;
use App\Models\TeamStatRegular;
use App\Support\SeasonContext;
use Illuminate\Contracts\View\View;

class StatisticsController extends Controller
{
    public function __construct(private readonly SeasonContext $seasonContext)
    {
    }

    public function index(): View
    {
        $currentSeason = $this->seasonContext->current();

        $leaders = [
            'average' => collect(),
            'home_runs' => collect(),
            'era' => collect(),
            'strikeouts' => collect(),
        ];

        if ($currentSeason) {
            $baseQuery = SeasonStat::query()->with('player')->where('season', $currentSeason->year);

            $leaders['average'] = (clone $baseQuery)->orderByDesc('H')->orderByDesc('AB')->get()->filter(fn (SeasonStat $stat) => $stat->AB >= 10)->sortByDesc(fn (SeasonStat $stat) => (float) $stat->batting_average)->take(10)->values();
            $leaders['home_runs'] = (clone $baseQuery)->orderByDesc('HR')->limit(10)->get();
            $leaders['era'] = (clone $baseQuery)->get()->filter(fn (SeasonStat $stat) => (float) $stat->IP > 0)->sortBy(fn (SeasonStat $stat) => (float) $stat->earned_run_average)->take(10)->values();
            $leaders['strikeouts'] = (clone $baseQuery)->orderByDesc('SO_Pitched')->limit(10)->get();
        }

        return view('public.stats.index', [
            'currentSeason' => $currentSeason,
            'leaders' => $leaders,
            'title' => 'Statistics',
        ]);
    }

    public function section(string $type): View
    {
        $currentSeason = $this->seasonContext->current();
        $normalizedType = strtolower($type);

        abort_unless(in_array($normalizedType, ['hitting', 'pitching'], true), 404);

        $stats = collect();

        if ($currentSeason) {
            $stats = SeasonStat::query()
                ->with('player')
                ->where('season', $currentSeason->year)
                ->get();

            $stats = $normalizedType === 'hitting'
                ? $stats->filter(fn (SeasonStat $stat) => $stat->AB > 0)->sortByDesc(fn (SeasonStat $stat) => (float) $stat->batting_average)->values()
                : $stats->filter(fn (SeasonStat $stat) => (float) $stat->IP > 0)->sortBy(fn (SeasonStat $stat) => (float) $stat->earned_run_average)->values();
        }

        return view('public.stats.section', [
            'currentSeason' => $currentSeason,
            'stats' => $stats,
            'title' => ucfirst($normalizedType).' Statistics',
            'type' => $normalizedType,
        ]);
    }

    public function leaders(): View
    {
        $currentSeason = $this->seasonContext->current();

        $leaders = [
            'average' => collect(),
            'home_runs' => collect(),
            'era' => collect(),
            'strikeouts' => collect(),
        ];

        if ($currentSeason) {
            $baseQuery = SeasonStat::query()->with('player')->where('season', $currentSeason->year);

            $leaders['average'] = (clone $baseQuery)->orderByDesc('H')->orderByDesc('AB')->get()->filter(fn (SeasonStat $stat) => $stat->AB >= 10)->sortByDesc(fn (SeasonStat $stat) => (float) $stat->batting_average)->take(10)->values();
            $leaders['home_runs'] = (clone $baseQuery)->orderByDesc('HR')->limit(10)->get();
            $leaders['era'] = (clone $baseQuery)->get()->filter(fn (SeasonStat $stat) => (float) $stat->IP > 0)->sortBy(fn (SeasonStat $stat) => (float) $stat->earned_run_average)->take(10)->values();
            $leaders['strikeouts'] = (clone $baseQuery)->orderByDesc('SO_Pitched')->limit(10)->get();
        }

        return view('public.stats.index', [
            'currentSeason' => $currentSeason,
            'leaders' => $leaders,
            'title' => 'Leaders',
        ]);
    }

    public function playerRecords(): View
    {
        $currentSeason = $this->seasonContext->current();
        $records = collect();

        if ($currentSeason) {
            $stats = SeasonStat::query()->with('player')->where('season', $currentSeason->year)->get();

            $records = collect([
                ['label' => 'Batting Average', 'value' => $stats->filter(fn (SeasonStat $stat) => $stat->AB >= 10)->sortByDesc(fn (SeasonStat $stat) => (float) $stat->batting_average)->first(), 'display' => fn (SeasonStat $stat) => $stat->batting_average],
                ['label' => 'Home Runs', 'value' => $stats->sortByDesc('HR')->first(), 'display' => fn (SeasonStat $stat) => $stat->HR],
                ['label' => 'RBIs', 'value' => $stats->sortByDesc('RBI')->first(), 'display' => fn (SeasonStat $stat) => $stat->RBI],
                ['label' => 'Strikeouts', 'value' => $stats->sortByDesc('SO_Pitched')->first(), 'display' => fn (SeasonStat $stat) => $stat->SO_Pitched],
            ]);
        }

        return view('public.stats.player-records', [
            'currentSeason' => $currentSeason,
            'records' => $records,
            'title' => 'Player Records',
        ]);
    }

    public function teamRecords(): View
    {
        $currentSeason = $this->seasonContext->current();
        $records = collect();

        if ($currentSeason) {
            $records = TeamStatRegular::query()
                ->with('club')
                ->where('season', $currentSeason->year)
                ->orderByDesc('wins')
                ->get();
        }

        return view('public.stats.team-records', [
            'currentSeason' => $currentSeason,
            'records' => $records,
            'title' => 'Team Records',
        ]);
    }
}