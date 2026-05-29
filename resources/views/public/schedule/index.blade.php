@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">League Calendar</p>
        <h1 class="section-title mt-3">Schedule</h1>
        <p class="mt-3 max-w-3xl text-slate-600">
            Full season schedule grouped by date, with opponent pairing and park context pulled from the existing games and field tables.
        </p>
    </section>

    <section class="space-y-6">
        @forelse ($games as $dateLabel => $dateGames)
            <article class="card-panel p-6">
                <div class="flex items-center justify-between gap-4 border-b border-slate-200 pb-4">
                    <div>
                        <p class="eyebrow">Game Day</p>
                        <h2 class="font-display text-3xl uppercase text-ink">{{ $dateLabel }}</h2>
                    </div>
                    <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">{{ $dateGames->count() }} games</span>
                </div>

                <div class="mt-5 space-y-4">
                    @foreach ($dateGames as $game)
                        <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-5 py-4">
                            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                                <div>
                                    <p class="font-display text-2xl uppercase text-ink">{{ $game->matchup_label }}</p>
                                    <p class="text-sm text-slate-600">
                                        {{ $game->game_date?->format('g:i A') ?: 'TBD' }}
                                        @if ($game->parkField)
                                            · {{ $game->parkField->park?->name ? $game->parkField->park->name.' / ' : '' }}{{ $game->parkField->field_name }}
                                        @endif
                                    </p>
                                </div>
                                <span class="stat-pill">{{ $game->status_label }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </article>
        @empty
            <div class="card-panel px-6 py-8 text-sm text-slate-600">
                No games are available for the active season.
            </div>
        @endforelse
    </section>
@endsection