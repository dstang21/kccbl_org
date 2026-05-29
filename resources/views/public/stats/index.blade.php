@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Statistics Hub</p>
        <h1 class="section-title mt-3">Statistics</h1>
        <p class="mt-3 max-w-3xl text-slate-600">League leaders and entry points into hitting and pitching tables sourced from season aggregate stats.</p>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ route('statistics.section', 'hitting') }}" class="rounded-full bg-ink px-5 py-3 text-sm font-semibold text-white hover:bg-slate-900">Hitting Stats</a>
            <a href="{{ route('statistics.section', 'pitching') }}" class="rounded-full bg-slate-200 px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-300">Pitching Stats</a>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-2">
        @foreach (['average' => 'Batting Average', 'home_runs' => 'Home Runs', 'era' => 'ERA', 'strikeouts' => 'Strikeouts'] as $key => $label)
            <article class="card-panel p-6">
                <p class="eyebrow">Leader Board</p>
                <h2 class="section-title mt-2 text-2xl">{{ $label }}</h2>
                <div class="mt-5 overflow-x-auto">
                    <table class="data-table min-w-[32rem]">
                        <thead>
                            <tr>
                                <th>Player</th>
                                <th>Metric</th>
                                <th>Season</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaders[$key] as $stat)
                                <tr>
                                    <td class="font-semibold text-ink">{{ $stat->player?->full_name ?? 'Unknown Player' }}</td>
                                    <td>
                                        @if ($key === 'average')
                                            {{ $stat->batting_average }}
                                        @elseif ($key === 'home_runs')
                                            {{ $stat->HR }}
                                        @elseif ($key === 'era')
                                            {{ $stat->earned_run_average }}
                                        @else
                                            {{ $stat->SO_Pitched }}
                                        @endif
                                    </td>
                                    <td>{{ $stat->season }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-sm text-slate-500">No data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </article>
        @endforeach
    </section>
@endsection