@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">League Coverage</p>
        <h1 class="section-title mt-3">News</h1>
    </section>

    <section class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">
        @foreach ($posts as $post)
            <article class="card-panel overflow-hidden">
                <div class="border-b border-slate-200 bg-slate-900 px-5 py-3 text-xs font-semibold uppercase tracking-[0.3em] text-amber-300">
                    {{ $post->pinned ? 'Featured' : 'News' }}
                </div>
                <div class="space-y-4 p-6">
                    <h2 class="font-display text-3xl uppercase text-ink">{{ $post->title }}</h2>
                    <p class="text-sm text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags($post->sub_header ?: $post->content), 160) }}</p>
                    <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center justify-center rounded-full bg-ink px-5 py-3 text-sm font-semibold text-white hover:bg-slate-900">Read Story</a>
                </div>
            </article>
        @endforeach
    </section>

    <div class="mt-8">{{ $posts->links() }}</div>
@endsection