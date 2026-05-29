@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Completed Games</p>
        <h1 class="section-title mt-3">Results</h1>
        <p class="mt-3 max-w-3xl text-slate-600">
            Final scores from the active season, grouped by date for a fast scoreboard-style scan.
        </p>
    </section>

    <section class="space-y-6">
        @forelse ($games as $dateLabel => $dateGames)
            <article class="card-panel p-6">
                <div class="border-b border-slate-200 pb-4">
                    <p class="eyebrow">Final Board</p>
                    <h2 class="font-display text-3xl uppercase text-ink">{{ $dateLabel }}</h2>
                </div>

                <div class="mt-5 space-y-4">
                    @foreach ($dateGames as $game)
                        <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-5 py-4">
                            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                                <div>
                                    <p class="font-display text-2xl uppercase text-ink">
                                        {{ $game->clubOne?->short_name ?? $game->clubOne?->name ?? 'Club 1' }}
                                        <span class="text-copper">{{ $game->team_1_score }}</span>
                                        <span class="mx-2 text-slate-400">-</span>
                                        <span class="text-copper">{{ $game->team_2_score }}</span>
                                        {{ $game->clubTwo?->short_name ?? $game->clubTwo?->name ?? 'Club 2' }}
                                    </p>
                                    <p class="text-sm text-slate-600">
                                        {{ $game->game_date?->format('g:i A') ?: 'TBD' }}
                                        @if ($game->parkField)
                                            · {{ $game->parkField->park?->name ? $game->parkField->park->name.' / ' : '' }}{{ $game->parkField->field_name }}
                                        @endif
                                    </p>
                                </div>
                                <span class="stat-pill bg-field/10 text-field">{{ $game->status_label }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </article>
        @empty
            <div class="card-panel px-6 py-8 text-sm text-slate-600">
                No completed games are available for the active season.
            </div>
        @endforelse
    </section>
@endsection