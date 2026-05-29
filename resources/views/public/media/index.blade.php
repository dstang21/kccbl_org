@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">League Gallery</p>
        <h1 class="section-title mt-3">Media</h1>
    </section>

    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($items as $item)
            <article class="card-panel overflow-hidden">
                @if ($item->media_url)
                    <img src="{{ $item->media_url }}" alt="{{ $item->caption ?: 'Media item' }}" class="h-60 w-full object-cover">
                @endif
                <div class="space-y-3 p-6">
                    <p class="eyebrow">{{ $item->media_type }}</p>
                    <h2 class="font-display text-2xl uppercase text-ink">{{ $item->caption ?: 'League Media Item' }}</h2>
                    <p class="text-sm text-slate-600">Uploaded {{ $item->uploaded_at?->format('M j, Y') ?: 'recently' }}</p>
                </div>
            </article>
        @endforeach
    </section>

    <div class="mt-8">{{ $items->links() }}</div>
@endsection