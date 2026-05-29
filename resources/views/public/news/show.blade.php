@extends('layouts.app')

@section('content')
    <article class="card-panel overflow-hidden">
        <div class="bg-gradient-to-r from-ink via-slate-900 to-field px-7 py-8 text-white">
            <p class="eyebrow !text-amber-300">League Story</p>
            <h1 class="mt-3 font-display text-5xl uppercase tracking-wide">{{ $post->title }}</h1>
            <p class="mt-4 max-w-4xl text-base text-slate-200">{{ $post->sub_header }}</p>
        </div>
        <div class="p-7">
            <div class="prose prose-slate max-w-none">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </article>
@endsection