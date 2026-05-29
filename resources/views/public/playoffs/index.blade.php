@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Postseason</p>
        <h1 class="section-title mt-3">Playoffs</h1>
        <p class="mt-3 max-w-3xl text-slate-600">Bracket structure, rounds, matchups, and seeds powered by the playoff tables in the legacy schema.</p>
    </section>

    <section class="space-y-6">
        @forelse ($brackets as $bracket)
            <article class="card-panel p-6">
                <div class="flex flex-col gap-3 border-b border-slate-200 pb-4 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="eyebrow">{{ $bracket->division }}</p>
                        <h2 class="font-display text-3xl uppercase text-ink">{{ $bracket->name }}</h2>
                    </div>
                    <p class="text-sm text-slate-600">{{ $bracket->structure }} · {{ $bracket->teams_count }} teams</p>
                </div>

                <div class="mt-6 grid gap-6 xl:grid-cols-[0.35fr_1fr]">
                    <div>
                        <h3 class="font-display text-2xl uppercase text-ink">Seeds</h3>
                        <div class="mt-4 space-y-3">
                            @foreach ($bracket->seeds->sortBy('seed') as $seed)
                                <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-4 py-3">
                                    <p class="font-semibold text-ink">#{{ $seed->seed }} {{ $seed->club?->name ?? 'TBD' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-4">
                        @foreach ($bracket->rounds as $round)
                            <div class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-5">
                                <div class="flex items-center justify-between gap-4 border-b border-slate-200 pb-4">
                                    <div>
                                        <p class="eyebrow">Round {{ $round->round_number }}</p>
                                        <h3 class="font-display text-2xl uppercase text-ink">{{ $round->round_name }}</h3>
                                    </div>
                                    <p class="text-sm text-slate-600">{{ $round->series_format }}</p>
                                </div>
                                <div class="mt-4 space-y-3">
                                    @foreach ($round->matchups as $matchup)
                                        <div class="rounded-[1.5rem] border border-slate-200 bg-white px-4 py-4">
                                            <p class="font-semibold text-ink">{{ $matchup->teamOne?->name ?? 'TBD' }} vs {{ $matchup->teamTwo?->name ?? 'TBD' }}</p>
                                            <p class="mt-1 text-sm text-slate-600">Series: {{ $matchup->team1_wins }}-{{ $matchup->team2_wins }} · {{ ucfirst($matchup->status) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </article>
        @empty
            <div class="card-panel px-6 py-8 text-sm text-slate-600">No playoff bracket data is available for the active season.</div>
        @endforelse
    </section>
@endsection