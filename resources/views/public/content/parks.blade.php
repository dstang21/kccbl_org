@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Fields & Venues</p>
        <h1 class="section-title mt-3">Parks</h1>
    </section>

    <section class="grid gap-6 xl:grid-cols-2">
        @foreach ($parks as $park)
            <article class="card-panel overflow-hidden">
                @if ($park->image_url)
                    <img src="{{ $park->image_url }}" alt="{{ $park->name }} image" class="h-56 w-full object-cover">
                @endif
                <div class="p-6">
                    <h2 class="font-display text-3xl uppercase text-ink">{{ $park->name }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ $park->street ?: 'Address not listed' }}</p>

                    <div class="mt-5 space-y-3">
                        @foreach ($park->fields as $field)
                            <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-4 py-4">
                                <p class="font-semibold text-ink">{{ $field->field_name }}</p>
                                <p class="text-sm text-slate-600">LF {{ $field->lf ?: '—' }} · CF {{ $field->cf ?: '—' }} · RF {{ $field->rf ?: '—' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </article>
        @endforeach
    </section>
@endsection