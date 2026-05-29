@extends('layouts.app')

@section('content')
    <section class="mb-8 rounded-[2rem] border border-white/70 bg-white/85 px-7 py-8 shadow-lg shadow-slate-200/60 backdrop-blur">
        <p class="eyebrow">Franchise Record Book</p>
        <h1 class="section-title mt-3">Team Records</h1>
    </section>

    <section class="card-panel p-6">
        <div class="overflow-x-auto">
            <table class="data-table min-w-[48rem]">
                <thead>
                    <tr>
                        <th>Club</th>
                        <th>Wins</th>
                        <th>Losses</th>
                        <th>Pct</th>
                        <th>R</th>
                        <th>HR</th>
                        <th>SO Pitched</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td class="font-semibold text-ink">{{ $record->club?->name ?? 'Unknown Club' }}</td>
                            <td>{{ $record->wins }}</td>
                            <td>{{ $record->losses }}</td>
                            <td>{{ $record->winning_percentage }}</td>
                            <td>{{ $record->R }}</td>
                            <td>{{ $record->HR }}</td>
                            <td>{{ $record->SO_Pitched }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection