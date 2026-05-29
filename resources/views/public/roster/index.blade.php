@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">League Directory</p>
        <h1 class="section-title mt-3">League Roster</h1>
        <p class="mt-3 max-w-3xl text-slate-600">Complete active-season roster groupings across the league, organized by club.</p>
    </section>

    <section class="space-y-6">
        @forelse ($roster as $clubName => $memberships)
            <article class="card-panel p-6">
                <div class="border-b border-slate-200 pb-4">
                    <h2 class="font-display text-3xl uppercase text-ink">{{ $clubName }}</h2>
                </div>
                <div class="mt-5 overflow-x-auto">
                    <table class="data-table min-w-[40rem]">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Player</th>
                                <th>Position</th>
                                <th>School</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($memberships as $membership)
                                <tr>
                                    <td>{{ $membership->jersey_num ?: '—' }}</td>
                                    <td>
                                        <a href="{{ route('players.show', $membership->player_id) }}" class="font-semibold text-ink hover:text-copper">
                                            {{ $membership->player?->full_name ?? 'Unknown Player' }}
                                        </a>
                                    </td>
                                    <td>{{ $membership->player?->primary_position ?: '—' }}</td>
                                    <td>{{ $membership->player?->high_school ?: $membership->player?->college_name ?: '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </article>
        @empty
            <div class="card-panel px-6 py-8 text-sm text-slate-600">No roster data is available for the active season.</div>
        @endforelse
    </section>
@endsection