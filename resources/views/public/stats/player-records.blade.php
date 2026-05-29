@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Record Book</p>
        <h1 class="section-title mt-3">Player Records</h1>
    </section>

    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($records as $record)
            <article class="card-panel p-6">
                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">{{ $record['label'] }}</p>
                @if ($record['value'])
                    <h2 class="mt-3 font-display text-3xl uppercase text-ink">{{ $record['value']->player?->full_name ?? 'Unknown Player' }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ $record['value']->season }} season</p>
                    <p class="mt-4 font-display text-5xl uppercase text-copper">{{ $record['display']($record['value']) }}</p>
                @else
                    <p class="mt-3 text-sm text-slate-600">No record available.</p>
                @endif
            </article>
        @endforeach
    </section>
@endsection