@extends('layouts.app')

@section('content')
    @php
        $primary = $club->color_primary ?: '#0b1e33';
        $secondary = $club->color_secondary ?: '#d97706';
    @endphp

    <section class="overflow-hidden rounded-[2rem] shadow-2xl shadow-slate-300/40">
        <div class="px-7 py-8 text-white" style="background: linear-gradient(135deg, {{ $primary }}, {{ $secondary }});">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="flex items-start gap-5">
                    @if ($club->logo_url)
                        <img src="{{ $club->logo_url }}" alt="{{ $club->name }} logo" class="h-20 w-20 rounded-full border border-white/20 bg-white/90 object-contain p-3 shadow-lg shadow-slate-900/20">
                    @endif
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/75">Team Page</p>
                        <h1 class="font-display text-5xl uppercase tracking-wide">{{ $club->name }}</h1>
                        <p class="mt-2 max-w-2xl text-sm text-white/85 sm:text-base">
                            {{ $currentSeason?->year }} season profile with roster, staff, recent results, and schedule context built directly from the legacy KCCBL schema.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('teams.schedule.print', $club) }}" class="rounded-full border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur hover:bg-white/20">
                        Printable Schedule
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white px-7 py-6">
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-[1.5rem] bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Record</p>
                    <p class="mt-2 font-display text-4xl uppercase text-ink">{{ $seasonEntry?->record ?? '0-0-0' }}</p>
                </div>
                <div class="rounded-[1.5rem] bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Division</p>
                    <p class="mt-2 font-display text-4xl uppercase text-ink">{{ $seasonEntry?->division ?: 'League' }}</p>
                </div>
                <div class="rounded-[1.5rem] bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Runs</p>
                    <p class="mt-2 font-display text-4xl uppercase text-ink">{{ $seasonEntry?->runs_scored ?? 0 }}</p>
                </div>
                <div class="rounded-[1.5rem] bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Runs Allowed</p>
                    <p class="mt-2 font-display text-4xl uppercase text-ink">{{ $seasonEntry?->runs_allowed ?? 0 }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-8 grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
        <div class="card-panel p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="eyebrow">Roster</p>
                    <h2 class="section-title mt-2 text-2xl">Current Season Players</h2>
                </div>
                <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">{{ $roster->count() }} players</span>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="data-table min-w-[40rem]">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Player</th>
                            <th>Position</th>
                            <th>B/T</th>
                            <th>School</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roster as $membership)
                            <tr>
                                <td class="font-semibold text-ink">{{ $membership->jersey_num ?: '—' }}</td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        @if ($membership->player?->activeImage?->image_url)
                                            <img src="{{ $membership->player->activeImage->image_url }}" alt="{{ $membership->player->full_name }} headshot" class="h-10 w-10 rounded-full object-cover">
                                        @else
                                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold text-slate-600">{{ \Illuminate\Support\Str::of($membership->player?->first_name)->substr(0, 1) }}{{ \Illuminate\Support\Str::of($membership->player?->last_name)->substr(0, 1) }}</div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-ink">{{ $membership->player?->full_name ?? 'Unknown Player' }}</p>
                                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Player ID {{ $membership->player_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $membership->player?->primary_position ?: '—' }}</td>
                                <td>{{ $membership->player?->bat_hand ?: '—' }}/{{ $membership->player?->throw_hand ?: '—' }}</td>
                                <td>{{ $membership->player?->high_school ?: $membership->player?->college_name ?: '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-sm text-slate-500">Roster data is not available for this season.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="card-panel p-6">
                <p class="eyebrow">Staff</p>
                <h2 class="section-title mt-2 text-2xl">Club Staff</h2>
                <div class="mt-5 space-y-3">
                    @forelse ($staff as $assignment)
                        <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-4 py-4">
                            <p class="font-display text-2xl uppercase text-ink">{{ $assignment->staff?->full_name ?? 'Unknown Staff' }}</p>
                            <p class="text-sm text-slate-600">{{ $assignment->staff?->title ?: $assignment->staff?->organization_title ?: 'Coach' }}</p>
                        </article>
                    @empty
                        <p class="text-sm text-slate-600">No team staff assignments were found for this season.</p>
                    @endforelse
                </div>
            </div>

            <div class="card-panel p-6">
                <p class="eyebrow">Season History</p>
                <h2 class="section-title mt-2 text-2xl">Historical Views</h2>
                <div class="mt-5 space-y-3">
                    @foreach ($seasonHistory as $history)
                        <a href="{{ route('teams.season', [$club, $history->season]) }}" class="flex items-center justify-between rounded-[1.5rem] border border-slate-200 bg-slate-50 px-4 py-4 text-sm font-semibold text-ink transition hover:border-copper hover:text-copper">
                            <span>{{ $history->season }} season</span>
                            <span>{{ $history->record }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="mt-8 grid gap-6 xl:grid-cols-2">
        <div class="card-panel p-6">
            <p class="eyebrow">On Deck</p>
            <h2 class="section-title mt-2 text-2xl">Upcoming Games</h2>

            <div class="mt-5 space-y-4">
                @forelse ($upcomingGames as $game)
                    <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-5 py-4">
                        <p class="font-display text-2xl uppercase text-ink">{{ $game->matchup_label }}</p>
                        <p class="mt-2 text-sm text-slate-600">
                            {{ $game->game_date?->format('D, M j · g:i A') ?: 'TBD' }}
                            @if ($game->parkField)
                                · {{ $game->parkField->park?->name ? $game->parkField->park->name.' / ' : '' }}{{ $game->parkField->field_name }}
                            @endif
                        </p>
                    </article>
                @empty
                    <p class="text-sm text-slate-600">No upcoming games are scheduled for this club yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card-panel p-6">
            <p class="eyebrow">Recent Form</p>
            <h2 class="section-title mt-2 text-2xl">Recent Results</h2>

            <div class="mt-5 space-y-4">
                @forelse ($recentResults as $game)
                    <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-5 py-4">
                        <p class="font-display text-2xl uppercase text-ink">
                            {{ $game->clubOne?->short_name ?? $game->clubOne?->name ?? 'Club 1' }}
                            <span class="text-copper">{{ $game->team_1_score }}</span>
                            <span class="mx-2 text-slate-400">-</span>
                            <span class="text-copper">{{ $game->team_2_score }}</span>
                            {{ $game->clubTwo?->short_name ?? $game->clubTwo?->name ?? 'Club 2' }}
                        </p>
                        <p class="mt-2 text-sm text-slate-600">{{ $game->game_date?->format('D, M j') ?: 'TBD' }}</p>
                    </article>
                @empty
                    <p class="text-sm text-slate-600">No completed games were found for this season.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection