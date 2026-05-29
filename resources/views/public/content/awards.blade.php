@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Recognition</p>
        <h1 class="section-title mt-3">{{ $title }}</h1>
    </section>

    <section class="space-y-6">
        @foreach ($awards as $award)
            <article class="card-panel p-6">
                <h2 class="font-display text-3xl uppercase text-ink">{{ $award->award_name }}</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($award->awardedPlayers as $winner)
                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-4 py-4">
                            <p class="font-display text-2xl uppercase text-ink">{{ $winner->player?->full_name ?? 'Unknown Player' }}</p>
                            <p class="text-sm text-slate-600">{{ $winner->date_awarded?->format('M j, Y') ?: 'Awarded' }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-600">No winners recorded.</p>
                    @endforelse
                </div>
            </article>
        @endforeach
    </section>
@endsection