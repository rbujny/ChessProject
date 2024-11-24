<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add result</title>
</head>
<body>
<h1>Results for Tournament</h1>
@if($results->isEmpty())
    <p>No results found for this tournament.</p>
@else
    <table class="table">
        <thead>
        <tr>
            <th>Player</th>
            <th>Games</th>
            <th>Wins</th>
            <th>Draws</th>
            <th>Losses</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr>
                <td>{{ $result->player->name }}</td>
                <td>{{ $result->games }}</td>
                <td>{{ $result->wins }}</td>
                <td>{{ $result->draws }}</td>
                <td>{{ $result->losses }}</td>
                @if($result->grade == 0)
                    <td>-</td>
                @else
                    <td>{{ $result->grade }}</td>
                @endif
                <td>
                    @if($result->player->club_id == Auth::user()->club_id)
                        @if($result->grade == 0)
                            <a href="{{ url('/result/grade/' . $result->id) }}">Add grade</a>
                        @endif
                        <a href="{{ url('/result/edit/' . $result->id) }}">Edit result</a>
                    @else
                        Player left the club.
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ url("/tournament/generateReport") }}">Generate report</a>
@endif
</body>
</html>
