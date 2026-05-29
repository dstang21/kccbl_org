<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #111827;
                margin: 24px;
            }

            h1,
            h2 {
                margin: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                border: 1px solid #d1d5db;
                padding: 10px;
                text-align: left;
                font-size: 14px;
            }

            th {
                background: #f3f4f6;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                font-size: 11px;
            }

            @media print {
                body {
                    margin: 0;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <h1>{{ $club->name }}</h1>
            <p>{{ $season->year }} Printable Schedule</p>
        </header>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Opponent</th>
                    <th>Location</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($games as $game)
                    @php
                        $opponent = $game->club_1_id === $club->id ? $game->clubTwo : $game->clubOne;
                    @endphp
                    <tr>
                        <td>{{ $game->game_date?->format('D, M j g:i A') ?: 'TBD' }}</td>
                        <td>{{ $opponent?->name ?? 'TBD' }}</td>
                        <td>
                            @if ($game->parkField)
                                {{ $game->parkField->park?->name ? $game->parkField->park->name.' / ' : '' }}{{ $game->parkField->field_name }}
                            @else
                                TBD
                            @endif
                        </td>
                        <td>{{ $game->status_label }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>