<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { margin-bottom: 20px; }
    </style>
</head>
<body>
<h1>Tournament Report</h1>
@foreach ($reportData as $tournament)
    <div class="tournament">
        <h2>{{ $tournament['name'] }}</h2>
        <p>{{ $tournament['description'] }}</p>
        <p><strong>Start date:</strong> {{ $tournament['start_date'] }}</p>
        <p><strong>Average grade:</strong> {{ number_format($tournament['average_grade'], 2) }}</p>

        <table>
            <thead>
            <tr>
                <th>Player</th>
                <th>Games</th>
                <th>Wins</th>
                <th>Draws</th>
                <th>Losses</th>
                <th>Grade</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tournament['results'] as $result)
                <tr>
                    <td>{{ $result['player_name'] }}</td>
                    <td>{{ $result['games'] }}</td>
                    <td>{{ $result['wins'] }}</td>
                    <td>{{ $result['draws'] }}</td>
                    <td>{{ $result['losses'] }}</td>
                    <td>{{ $result['grade'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endforeach
</body>
</html>
