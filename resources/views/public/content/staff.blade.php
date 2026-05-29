@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">League Personnel</p>
        <h1 class="section-title mt-3">Staff</h1>
    </section>

    <section class="space-y-6">
        @forelse ($staffAssignments as $clubName => $assignments)
            <article class="card-panel p-6">
                <h2 class="font-display text-3xl uppercase text-ink">{{ $clubName }}</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($assignments as $assignment)
                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-4 py-4">
                            <p class="font-display text-2xl uppercase text-ink">{{ $assignment->staff?->full_name ?? 'Unknown Staff' }}</p>
                            <p class="text-sm text-slate-600">{{ $assignment->staff?->title ?: $assignment->staff?->organization_title ?: 'Coach' }}</p>
                        </div>
                    @endforeach
                </div>
            </article>
        @empty
            <div class="card-panel px-6 py-8 text-sm text-slate-600">No staff assignments are available for the active season.</div>
        @endforelse
    </section>
@endsection