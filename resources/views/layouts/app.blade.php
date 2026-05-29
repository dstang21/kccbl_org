<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ ($title ?? 'KCCBL').' | Kansas Collegiate Club Baseball League' }}</title>
        <meta name="description" content="Kansas Collegiate Club Baseball League schedule, standings, teams, and player coverage.">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-surface text-slate-900 antialiased">
        <div class="border-b border-white/10 bg-ink text-white shadow-2xl shadow-slate-950/20">
            <header class="mx-auto max-w-7xl px-6 py-6 lg:px-8">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-3xl space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-300">Kansas Collegiate Club Baseball League</p>
                        <a href="{{ route('home') }}" class="font-display text-5xl uppercase tracking-wide text-white sm:text-6xl">KCCBL</a>
                        <p class="max-w-2xl text-sm text-slate-200 sm:text-base">
                            Season-first baseball coverage with club branding, standings, schedules, roster context, and league news.
                        </p>
                    </div>

                    <nav class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                        <a href="{{ route('teams.index') }}" class="nav-link">Teams</a>
                        <a href="{{ route('schedule.index') }}" class="nav-link">Schedule</a>
                        <a href="{{ route('results.index') }}" class="nav-link">Results</a>
                        <a href="{{ route('standings.index') }}" class="nav-link">Standings</a>
                        <a href="{{ route('players.index') }}" class="nav-link">Players</a>
                        <a href="{{ route('statistics.index') }}" class="nav-link">Statistics</a>
                        <a href="{{ route('playoffs.index') }}" class="nav-link">Playoffs</a>
                        <a href="{{ route('news.index') }}" class="nav-link">News</a>
                    </nav>
                </div>

                @if (! empty($currentSeason))
                    <div class="mt-6 flex flex-col gap-4 rounded-[2rem] border border-white/10 bg-white/8 px-5 py-5 backdrop-blur sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-300">Active Season</p>
                            <p class="font-display text-3xl uppercase tracking-wide text-white">{{ $currentSeason->name ?: $currentSeason->year }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm text-slate-200 sm:grid-cols-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Start</p>
                                <p>{{ $currentSeason->start_date?->format('M j, Y') ?: 'TBD' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-400">End</p>
                                <p>{{ $currentSeason->end_date?->format('M j, Y') ?: 'TBD' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-400">League View</p>
                                <p>Season-aware public rebuild</p>
                            </div>
                        </div>
                    </div>
                @endif
            </header>
        </div>

        <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
            @yield('content')
        </main>

        <footer class="mx-auto max-w-7xl px-6 pb-10 text-sm text-slate-600 lg:px-8">
            <div class="rounded-[2rem] border border-white/70 bg-white/80 px-6 py-5 shadow-lg shadow-slate-200/60 backdrop-blur">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <p>Built on the legacy KCCBL database schema with Laravel Blade and season-aware routing.</p>
                    <p>{{ now()->year }} Kansas Collegiate Club Baseball League</p>
                </div>
            </div>
        </footer>
    </body>
</html>