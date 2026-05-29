@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">League Partners</p>
        <h1 class="section-title mt-3">Sponsors</h1>
    </section>

    <section class="space-y-6">
        @foreach ($sponsors as $level => $items)
            <article class="card-panel p-6">
                <h2 class="font-display text-3xl uppercase text-ink">{{ $level }}</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($items as $sponsor)
                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-4 py-4">
                            <p class="font-display text-2xl uppercase text-ink">{{ $sponsor->name }}</p>
                            <p class="text-sm text-slate-600">{{ $sponsor->website ?: 'Community supporter' }}</p>
                        </div>
                    @endforeach
                </div>
            </article>
        @endforeach
    </section>
@endsection