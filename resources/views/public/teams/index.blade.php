@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Club Directory</p>
        <div class="mt-3 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h1 class="section-title">Teams</h1>
                <p class="mt-3 max-w-3xl text-slate-600">
                    Every active club in the league, with current-season records when the active season has been configured.
                </p>
            </div>
            @if ($currentSeason)
                <p class="rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-900">
                    {{ $currentSeason->year }} season context
                </p>
            @endif
        </div>
    </section>

    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($clubs as $club)
            @php($record = $seasonRecords->get($club->id))
            <article class="card-panel overflow-hidden">
                <div class="h-2" style="background: linear-gradient(90deg, {{ $club->color_primary ?: '#0b1e33' }}, {{ $club->color_secondary ?: '#d97706' }});"></div>
                <div class="space-y-5 p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">{{ $club->abbreviation }}</p>
                            <h2 class="font-display text-3xl uppercase text-ink">{{ $club->name }}</h2>
                            <p class="text-sm text-slate-500">{{ $club->short_name }}</p>
                        </div>
                        @if ($club->logo_url)
                            <img src="{{ $club->logo_url }}" alt="{{ $club->name }} logo" class="h-14 w-14 rounded-full border border-slate-200 bg-white object-contain p-2">
                        @else
                            <div class="flex h-14 w-14 items-center justify-center rounded-full border border-slate-200 bg-slate-100 font-display text-xl uppercase text-ink">
                                {{ $club->abbreviation ?: \Illuminate\Support\Str::substr($club->short_name, 0, 3) }}
                            </div>
                        @endif
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="rounded-[1.25rem] bg-slate-50 p-4">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Current Record</p>
                            <p class="mt-2 font-display text-3xl uppercase text-ink">{{ $record?->record ?? '0-0-0' }}</p>
                        </div>
                        <div class="rounded-[1.25rem] bg-slate-50 p-4">
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Division</p>
                            <p class="mt-2 font-display text-3xl uppercase text-ink">{{ $record?->division ?: 'League' }}</p>
                        </div>
                    </div>

                    <a href="{{ route('teams.show', $club) }}" class="inline-flex items-center justify-center rounded-full bg-ink px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
                        View Team Page
                    </a>
                </div>
            </article>
        @endforeach
    </section>
@endsection