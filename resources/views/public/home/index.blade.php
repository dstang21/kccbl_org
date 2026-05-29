@extends('layouts.app')

@section('content')
    <section class="grid gap-6 lg:grid-cols-[1.4fr_0.9fr]">
        <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-gradient-to-br from-ink via-slate-900 to-field px-7 py-8 text-white shadow-2xl shadow-slate-300/40">
            <div class="max-w-3xl space-y-4">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">League Center</p>
                <h1 class="font-display text-5xl uppercase tracking-wide sm:text-6xl">
                    College summer baseball, built around the season.
                </h1>
                <p class="max-w-2xl text-base text-slate-200 sm:text-lg">
                    Follow clubs, weekly schedules, standings movement, roster changes, and the latest league stories from a site built directly on the existing KCCBL data model.
                </p>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-[1.75rem] border border-white/10 bg-white/10 p-5 backdrop-blur">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Active Clubs</p>
                    <p class="mt-3 font-display text-4xl uppercase">{{ $clubs->count() }}</p>
                </div>
                <div class="rounded-[1.75rem] border border-white/10 bg-white/10 p-5 backdrop-blur">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Upcoming Games</p>
                    <p class="mt-3 font-display text-4xl uppercase">{{ $upcomingGames->count() }}</p>
                </div>
                <div class="rounded-[1.75rem] border border-white/10 bg-white/10 p-5 backdrop-blur">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Recent Finals</p>
                    <p class="mt-3 font-display text-4xl uppercase">{{ $recentResults->count() }}</p>
                </div>
                <div class="rounded-[1.75rem] border border-white/10 bg-white/10 p-5 backdrop-blur">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Featured Sponsors</p>
                    <p class="mt-3 font-display text-4xl uppercase">{{ $sponsors->count() }}</p>
                </div>
            </div>
        </div>

        <aside class="card-panel p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="eyebrow">Current Snapshot</p>
                    <h2 class="section-title mt-2 text-2xl">Standings Lead</h2>
                </div>
                <a href="{{ route('standings.index') }}" class="text-sm font-semibold text-copper hover:text-amber-700">Full table</a>
            </div>

            @if ($standings->isEmpty())
                <p class="mt-6 text-sm text-slate-600">Standings will appear here when season records are available.</p>
            @else
                <div class="mt-6 overflow-hidden rounded-[1.5rem] border border-slate-200">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Club</th>
                                <th>Div</th>
                                <th>W-L-T</th>
                                <th>Pct</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($standings as $row)
                                <tr>
                                    <td>
                                        <a href="{{ route('teams.show', $row->club) }}" class="font-semibold text-ink hover:text-copper">
                                            {{ $row->club?->name ?? 'Unknown Club' }}
                                        </a>
                                    </td>
                                    <td>{{ $row->division ?: 'League' }}</td>
                                    <td>{{ $row->record }}</td>
                                    <td>{{ number_format($row->win_percentage, 3) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </aside>
    </section>

    <section class="mt-8 grid gap-6 xl:grid-cols-2">
        <div class="card-panel p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="eyebrow">On Deck</p>
                    <h2 class="section-title mt-2 text-2xl">Upcoming Games</h2>
                </div>
                <a href="{{ route('schedule.index') }}" class="text-sm font-semibold text-copper hover:text-amber-700">View schedule</a>
            </div>

            <div class="mt-6 space-y-4">
                @forelse ($upcomingGames as $game)
                    <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-5 py-4">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-display text-2xl uppercase text-ink">{{ $game->matchup_label }}</p>
                                <p class="text-sm text-slate-600">
                                    {{ $game->game_date?->format('D, M j · g:i A') ?: 'TBD' }}
                                    @if ($game->parkField)
                                        · {{ $game->parkField->park?->name ? $game->parkField->park->name.' / ' : '' }}{{ $game->parkField->field_name }}
                                    @endif
                                </p>
                            </div>
                            <span class="stat-pill">{{ $game->status_label }}</span>
                        </div>
                    </article>
                @empty
                    <p class="text-sm text-slate-600">No upcoming games are currently available for the active season.</p>
                @endforelse
            </div>
        </div>

        <div class="card-panel p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="eyebrow">Final Scores</p>
                    <h2 class="section-title mt-2 text-2xl">Recent Results</h2>
                </div>
                <a href="{{ route('results.index') }}" class="text-sm font-semibold text-copper hover:text-amber-700">All results</a>
            </div>

            <div class="mt-6 space-y-4">
                @forelse ($recentResults as $game)
                    <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-5 py-4">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-display text-2xl uppercase text-ink">
                                    {{ $game->clubOne?->short_name ?? $game->clubOne?->name ?? 'Club 1' }}
                                    <span class="text-copper">{{ $game->team_1_score }}</span>
                                    <span class="mx-2 text-slate-400">-</span>
                                    <span class="text-copper">{{ $game->team_2_score }}</span>
                                    {{ $game->clubTwo?->short_name ?? $game->clubTwo?->name ?? 'Club 2' }}
                                </p>
                                <p class="text-sm text-slate-600">{{ $game->game_date?->format('D, M j') ?: 'TBD' }}</p>
                            </div>
                            <span class="stat-pill bg-field/10 text-field">{{ $game->status_label }}</span>
                        </div>
                    </article>
                @empty
                    <p class="text-sm text-slate-600">No completed games are currently available for the active season.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="mt-8 grid gap-6 lg:grid-cols-[1.3fr_0.9fr]">
        <div class="card-panel p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="eyebrow">Latest Coverage</p>
                    <h2 class="section-title mt-2 text-2xl">League News</h2>
                </div>
                <span class="text-sm font-semibold text-slate-500">News routing lands next</span>
            </div>

            <div class="mt-6 grid gap-4 lg:grid-cols-3">
                @forelse ($featuredNews as $post)
                    <article class="overflow-hidden rounded-[1.5rem] border border-slate-200 bg-slate-50">
                        <div class="border-b border-slate-200 bg-slate-900/95 px-4 py-3 text-xs font-semibold uppercase tracking-[0.3em] text-amber-300">
                            {{ $post->pinned ? 'Featured Story' : 'League Update' }}
                        </div>
                        <div class="space-y-3 p-4">
                            <h3 class="font-display text-2xl uppercase text-ink">{{ $post->title }}</h3>
                            <p class="text-sm text-slate-600">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->sub_header ?: $post->content), 135) }}
                            </p>
                            <p class="text-xs uppercase tracking-[0.25em] text-slate-500">
                                {{ $post->created_at?->format('M j, Y') ?: 'Published' }}
                            </p>
                            @if ($post->slug)
                                <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center text-sm font-semibold text-copper hover:text-amber-700">Read story</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="text-sm text-slate-600">News stories will populate here once blog content is connected to the public pages.</p>
                @endforelse
            </div>
        </div>

        <div class="card-panel p-6">
            <div>
                <p class="eyebrow">League Partners</p>
                <h2 class="section-title mt-2 text-2xl">Sponsors</h2>
            </div>

            <div class="mt-6 space-y-3">
                @forelse ($sponsors as $sponsor)
                    <article class="rounded-[1.5rem] border border-slate-200 bg-slate-50 px-4 py-4">
                        <p class="font-display text-2xl uppercase text-ink">{{ $sponsor->name }}</p>
                        <div class="mt-1 flex items-center justify-between gap-3 text-sm text-slate-600">
                            <span>{{ $sponsor->sponsor_level }}</span>
                            @if ($sponsor->website)
                                <a href="{{ $sponsor->website }}" target="_blank" rel="noreferrer" class="font-semibold text-copper hover:text-amber-700">Visit</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="text-sm text-slate-600">Sponsor records will surface here when available.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection