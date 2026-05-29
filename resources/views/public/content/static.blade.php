@extends('layouts.app')

@section('content')
    <section class="card-panel p-7">
        <p class="eyebrow">Public Information</p>
        <h1 class="section-title mt-3">{{ $heading }}</h1>
        <p class="mt-4 max-w-3xl text-slate-600">{{ $intro }}</p>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            @foreach ($bullets as $bullet)
                <article class="rounded-[1.75rem] border border-slate-200 bg-slate-50 px-5 py-5 text-sm text-slate-600">
                    {{ $bullet }}
                </article>
            @endforeach
        </div>
    </section>
@endsection