@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Season Table</p>
        <h1 class="section-title mt-3">{{ ucfirst($type) }} Statistics</h1>
    </section>

    <section class="card-panel p-6">
        <div class="overflow-x-auto">
            <table class="data-table min-w-[56rem]">
                <thead>
                    <tr>
                        <th>Player</th>
                        @if ($type === 'hitting')
                            <th>AVG</th>
                            <th>AB</th>
                            <th>H</th>
                            <th>R</th>
                            <th>RBI</th>
                            <th>HR</th>
                            <th>SB</th>
                        @else
                            <th>ERA</th>
                            <th>IP</th>
                            <th>HA</th>
                            <th>ER</th>
                            <th>BB</th>
                            <th>SO</th>
                            <th>WHIP</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stats as $stat)
                        <tr>
                            <td class="font-semibold text-ink">{{ $stat->player?->full_name ?? 'Unknown Player' }}</td>
                            @if ($type === 'hitting')
                                <td>{{ $stat->batting_average }}</td>
                                <td>{{ $stat->AB }}</td>
                                <td>{{ $stat->H }}</td>
                                <td>{{ $stat->R }}</td>
                                <td>{{ $stat->RBI }}</td>
                                <td>{{ $stat->HR }}</td>
                                <td>{{ $stat->SB }}</td>
                            @else
                                <td>{{ $stat->earned_run_average }}</td>
                                <td>{{ $stat->IP }}</td>
                                <td>{{ $stat->HA }}</td>
                                <td>{{ $stat->ER }}</td>
                                <td>{{ $stat->BB_Pitched }}</td>
                                <td>{{ $stat->SO_Pitched }}</td>
                                <td>{{ $stat->whip }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection