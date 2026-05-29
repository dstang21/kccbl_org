@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Player Video Directory</p>
        <h1 class="section-title mt-3">Scouting Videos</h1>
    </section>

    <section class="space-y-4">
        @foreach ($videos as $video)
            <article class="card-panel p-6">
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="eyebrow">{{ $video->featured ? 'Featured Clip' : 'Scouting Clip' }}</p>
                        <h2 class="mt-2 font-display text-3xl uppercase text-ink">{{ $video->player?->full_name ?? 'Player Video' }}</h2>
                        <p class="mt-2 text-sm text-slate-600">{{ $video->description ?: 'Player scouting media entry.' }}</p>
                    </div>
                    <a href="{{ $video->tweet_url }}" target="_blank" rel="noreferrer" class="rounded-full bg-ink px-5 py-3 text-sm font-semibold text-white hover:bg-slate-900">Open Video</a>
                </div>
            </article>
        @endforeach
    </section>

    <div class="mt-8">{{ $videos->links() }}</div>
@endsection