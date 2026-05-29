@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Race Table</p>
        <h1 class="section-title mt-3">Standings</h1>
        <p class="mt-3 max-w-3xl text-slate-600">
            Division and league race tracking sourced from the season_teams table, preserving the season-aware standings model instead of flattening it into clubs.
        </p>
    </section>

    <section class="space-y-6">
        @forelse ($standings as $division => $teams)
            <article class="card-panel p-6">
                <div class="border-b border-slate-200 pb-4">
                    <p class="eyebrow">Division</p>
                    <h2 class="font-display text-3xl uppercase text-ink">{{ $division }}</h2>
                </div>

                <div class="mt-5 overflow-x-auto">
                    <table class="data-table min-w-[48rem]">
                        <thead>
                            <tr>
                                <th>Club</th>
                                <th>W-L-T</th>
                                <th>Pct</th>
                                <th>RS</th>
                                <th>RA</th>
                                <th>Last 10</th>
                                <th>Streak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                                <tr>
                                    <td>
                                        <a href="{{ route('teams.show', $team->club) }}" class="font-semibold text-ink hover:text-copper">
                                            {{ $team->club?->name ?? 'Unknown Club' }}
                                        </a>
                                    </td>
                                    <td>{{ $team->record }}</td>
                                    <td>{{ number_format($team->win_percentage, 3) }}</td>
                                    <td>{{ $team->runs_scored }}</td>
                                    <td>{{ $team->runs_allowed }}</td>
                                    <td>{{ $team->last_ten }}</td>
                                    <td>{{ $team->streak ?: '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </article>
        @empty
            <div class="card-panel px-6 py-8 text-sm text-slate-600">
                Standings are not yet available for the active season.
            </div>
        @endforelse
    </section>
@endsection