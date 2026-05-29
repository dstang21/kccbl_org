@extends('layouts.app')

@section('content')
    <section class="mb-8 overflow-hidden rounded-[2rem] shadow-2xl shadow-slate-300/40">
        <div class="bg-gradient-to-r from-ink via-slate-900 to-field px-7 py-8 text-white">
            <p class="eyebrow !text-amber-300">Game Center</p>
            <h1 class="font-display text-5xl uppercase tracking-wide">{{ $game->matchup_label }}</h1>
            <p class="mt-3 text-sm text-slate-200">
                {{ $game->game_date?->format('l, F j, Y · g:i A') ?: 'TBD' }}
                @if ($game->parkField)
                    · {{ $game->parkField->park?->name ? $game->parkField->park->name.' / ' : '' }}{{ $game->parkField->field_name }}
                @endif
            </p>
        </div>

        <div class="bg-white px-7 py-6">
            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-[1.5rem] bg-slate-50 p-5 text-center">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">{{ $game->clubOne?->name ?? 'Club 1' }}</p>
                    <p class="mt-3 font-display text-6xl uppercase text-ink">{{ $game->team_1_score }}</p>
                </div>
                <div class="rounded-[1.5rem] bg-slate-50 p-5 text-center">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-500">{{ $game->clubTwo?->name ?? 'Club 2' }}</p>
                    <p class="mt-3 font-display text-6xl uppercase text-ink">{{ $game->team_2_score }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="card-panel p-6">
        <p class="eyebrow">Line Score</p>
        <h2 class="section-title mt-2 text-2xl">By Inning</h2>
        <div class="mt-5 overflow-x-auto">
            <table class="data-table min-w-[40rem]">
                <thead>
                    <tr>
                        <th>Club</th>
                        @foreach ($game->innings->sortBy('inning') as $inning)
                            <th>{{ $inning->inning }}</th>
                        @endforeach
                        <th>R</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-semibold text-ink">{{ $game->clubOne?->short_name ?? $game->clubOne?->name ?? 'Club 1' }}</td>
                        @foreach ($game->innings->sortBy('inning') as $inning)
                            <td>{{ $inning->team_1_score }}</td>
                        @endforeach
                        <td class="font-semibold text-copper">{{ $game->team_1_score }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-ink">{{ $game->clubTwo?->short_name ?? $game->clubTwo?->name ?? 'Club 2' }}</td>
                        @foreach ($game->innings->sortBy('inning') as $inning)
                            <td>{{ $inning->team_2_score }}</td>
                        @endforeach
                        <td class="font-semibold text-copper">{{ $game->team_2_score }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="mt-8 grid gap-6 xl:grid-cols-2">
        @foreach (['team1' => $game->clubOne, 'team2' => $game->clubTwo] as $key => $club)
            <div class="card-panel p-6">
                <p class="eyebrow">Batting</p>
                <h2 class="section-title mt-2 text-2xl">{{ $club?->name ?? 'Club' }}</h2>
                <div class="mt-5 overflow-x-auto">
                    <table class="data-table min-w-[36rem]">
                        <thead>
                            <tr>
                                <th>Player</th>
                                <th>AB</th>
                                <th>R</th>
                                <th>H</th>
                                <th>RBI</th>
                                <th>BB</th>
                                <th>SO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($batting[$key] as $stat)
                                <tr>
                                    <td class="font-semibold text-ink">{{ $stat->player?->full_name ?? 'Unknown Player' }}</td>
                                    <td>{{ $stat->AB }}</td>
                                    <td>{{ $stat->R }}</td>
                                    <td>{{ $stat->H }}</td>
                                    <td>{{ $stat->RBI }}</td>
                                    <td>{{ $stat->BB_batter }}</td>
                                    <td>{{ $stat->SO_batter }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-sm text-slate-500">No batting lines were found for this side.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </section>

    <section class="mt-8 grid gap-6 xl:grid-cols-2">
        @foreach (['team1' => $game->clubOne, 'team2' => $game->clubTwo] as $key => $club)
            <div class="card-panel p-6">
                <p class="eyebrow">Pitching</p>
                <h2 class="section-title mt-2 text-2xl">{{ $club?->name ?? 'Club' }}</h2>
                <div class="mt-5 overflow-x-auto">
                    <table class="data-table min-w-[36rem]">
                        <thead>
                            <tr>
                                <th>Player</th>
                                <th>IP</th>
                                <th>H</th>
                                <th>ER</th>
                                <th>BB</th>
                                <th>SO</th>
                                <th>NP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pitching[$key] as $stat)
                                <tr>
                                    <td class="font-semibold text-ink">{{ $stat->player?->full_name ?? 'Unknown Player' }}</td>
                                    <td>{{ $stat->IP }}</td>
                                    <td>{{ $stat->HA }}</td>
                                    <td>{{ $stat->ER }}</td>
                                    <td>{{ $stat->BB_Pitched }}</td>
                                    <td>{{ $stat->SO_Pitched }}</td>
                                    <td>{{ $stat->NP }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-sm text-slate-500">No pitching lines were found for this side.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </section>
@endsection