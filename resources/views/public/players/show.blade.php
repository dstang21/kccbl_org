@extends('layouts.app')

@section('content')
    <section class="card-panel overflow-hidden">
        <div class="grid gap-6 bg-gradient-to-r from-ink via-slate-900 to-field px-7 py-8 text-white lg:grid-cols-[0.42fr_1fr]">
            <div>
                @if ($player->activeImage?->image_url)
                    <img src="{{ $player->activeImage->image_url }}" alt="{{ $player->full_name }} headshot" class="aspect-square w-full rounded-[2rem] object-cover shadow-xl shadow-slate-950/30">
                @else
                    <div class="flex aspect-square w-full items-center justify-center rounded-[2rem] bg-white/10 font-display text-7xl uppercase text-white/75">
                        {{ \Illuminate\Support\Str::of($player->first_name)->substr(0, 1) }}{{ \Illuminate\Support\Str::of($player->last_name)->substr(0, 1) }}
                    </div>
                @endif
            </div>
            <div>
                <p class="eyebrow !text-amber-300">Player Profile</p>
                <h1 class="mt-3 font-display text-5xl uppercase tracking-wide">{{ $player->full_name }}</h1>
                <p class="mt-4 max-w-3xl text-sm text-slate-200 sm:text-base">
                    {{ $player->bio ?: 'Public player profile reconstructed from the legacy roster and statistics tables.' }}
                </p>
                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-[1.5rem] bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-300">Position</p>
                        <p class="mt-2 font-semibold">{{ $player->primary_position ?: '—' }}</p>
                    </div>
                    <div class="rounded-[1.5rem] bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-300">B/T</p>
                        <p class="mt-2 font-semibold">{{ $player->bat_hand ?: '—' }}/{{ $player->throw_hand ?: '—' }}</p>
                    </div>
                    <div class="rounded-[1.5rem] bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-300">School</p>
                        <p class="mt-2 font-semibold">{{ $player->high_school ?: '—' }}</p>
                    </div>
                    <div class="rounded-[1.5rem] bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-300">College</p>
                        <p class="mt-2 font-semibold">{{ $player->college_name ?: '—' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-8 grid gap-6 xl:grid-cols-2">
        <div class="card-panel p-6">
            <p class="eyebrow">Team History</p>
            <h2 class="section-title mt-2 text-2xl">Season Memberships</h2>
            <div class="mt-5 overflow-x-auto">
                <table class="data-table min-w-[32rem]">
                    <thead>
                        <tr>
                            <th>Season</th>
                            <th>Club</th>
                            <th>Jersey</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $membership)
                            <tr>
                                <td>{{ $membership->season }}</td>
                                <td>{{ $membership->club?->name ?? 'Unknown Club' }}</td>
                                <td>{{ $membership->jersey_num ?: '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-panel p-6">
            <p class="eyebrow">Stat Profile</p>
            <h2 class="section-title mt-2 text-2xl">Season Totals</h2>
            <div class="mt-5 overflow-x-auto">
                <table class="data-table min-w-[36rem]">
                    <thead>
                        <tr>
                            <th>Season</th>
                            <th>AVG</th>
                            <th>HR</th>
                            <th>RBI</th>
                            <th>ERA</th>
                            <th>SO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seasonStats as $stat)
                            <tr>
                                <td>{{ $stat->season }}</td>
                                <td>{{ $stat->batting_average }}</td>
                                <td>{{ $stat->HR }}</td>
                                <td>{{ $stat->RBI }}</td>
                                <td>{{ $stat->earned_run_average }}</td>
                                <td>{{ $stat->SO_Pitched }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="mt-8 card-panel p-6">
        <p class="eyebrow">Scouting Media</p>
        <h2 class="section-title mt-2 text-2xl">Videos</h2>
        <div class="mt-5 space-y-4">
            @forelse ($videos as $video)
                <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-5 py-4">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="font-display text-2xl uppercase text-ink">{{ $video->description ?: 'Scouting Video' }}</p>
                            <p class="text-sm text-slate-600">{{ $video->post_date?->format('M j, Y') ?: 'Posted' }}</p>
                        </div>
                        <a href="{{ $video->tweet_url }}" target="_blank" rel="noreferrer" class="rounded-full bg-ink px-5 py-3 text-sm font-semibold text-white hover:bg-slate-900">Open Video</a>
                    </div>
                </article>
            @empty
                <p class="text-sm text-slate-600">No scouting videos are attached to this player yet.</p>
            @endforelse
        </div>
    </section>
@endsection