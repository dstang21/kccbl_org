@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Player Directory</p>
        <h1 class="section-title mt-3">Players</h1>
        <p class="mt-3 max-w-3xl text-slate-600">Current-season roster memberships across the league, grouped in a searchable-style directory layout.</p>
    </section>

    <section class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($memberships as $membership)
            <article class="card-panel p-5">
                <div class="flex items-center gap-4">
                    @if ($membership->player?->activeImage?->image_url)
                        <img src="{{ $membership->player->activeImage->image_url }}" alt="{{ $membership->player->full_name }} headshot" class="h-16 w-16 rounded-full object-cover">
                    @else
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 font-display text-2xl uppercase text-ink">
                            {{ \Illuminate\Support\Str::of($membership->player?->first_name)->substr(0, 1) }}{{ \Illuminate\Support\Str::of($membership->player?->last_name)->substr(0, 1) }}
                        </div>
                    @endif
                    <div>
                        <h2 class="font-display text-3xl uppercase text-ink">{{ $membership->player?->full_name ?? 'Unknown Player' }}</h2>
                        <p class="text-sm text-slate-600">{{ $membership->club?->name ?? 'Unassigned Club' }}</p>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-3 text-sm text-slate-600">
                    <div class="rounded-[1.25rem] bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Position</p>
                        <p class="mt-2 font-semibold text-ink">{{ $membership->player?->primary_position ?: '—' }}</p>
                    </div>
                    <div class="rounded-[1.25rem] bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Jersey</p>
                        <p class="mt-2 font-semibold text-ink">{{ $membership->jersey_num ?: '—' }}</p>
                    </div>
                </div>

                <a href="{{ route('players.show', $membership->player_id) }}" class="mt-5 inline-flex items-center justify-center rounded-full bg-ink px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
                    View Profile
                </a>
            </article>
        @empty
            <div class="card-panel px-6 py-8 text-sm text-slate-600">
                No player memberships are available for the active season.
            </div>
        @endforelse
    </section>
@endsection