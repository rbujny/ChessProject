<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit result</title>
</head>
<body>
<h1>Edit result for tournament {{ $result->tournament->name }}</h1>
<form action={{ url('/result/update') . "/".$result->id }} method="POST">
    @csrf
    @method("POST")

    <label for="games">Games:</label>
    <input type="number" id="games" name="games" value="{{ $result->games }}" required>

    <label for="wins">Wins:</label>
    <input type="number" id="wins" name="wins" value="{{ $result->wins }}" required>

    <label for="draws">Draws:</label>
    <input type="number" id="draws" name="draws" value="{{ $result->draws }}" required>

    <label for="losses">Losses:</label>
    <input type="number" id="losses" name="losses" value="{{ $result->losses }}" required>

    <input type="hidden" name="tournament_id" value="{{ $result->tournament->id }}">
    <input type="hidden" name="result_id" value="{{ $result->id }}">

    @if($result->grade != 0)
        <label for="grade">Grade:</label>
        <input type="number" id="grade" name="grade" min="1" max="10" step="1" required value="{{ $result->grade }}">
    @endif

    <button type="submit" id="confirm">Confirm</button>
</form>

<script>
    document.getElementById('games').addEventListener('input', function() {
        const gamesCounter = parseInt(this.value);
        const games = document.getElementById('games');
        const wins = document.getElementById('wins');
        const draws = document.getElementById('draws');
        const losses = document.getElementById('losses');
        const confirmButton = document.getElementById('confirm');

        function validate() {
            const total = parseInt(wins.value || 0) + parseInt(draws.value || 0) + parseInt(losses.value || 0);
            if (total === gamesCounter) {
                confirmButton.disabled = false;
            } else {
                confirmButton.disabled = true;
            }
        }
        games.addEventListener('input', validate);
        wins.addEventListener('input', validate);
        draws.addEventListener('input', validate);
        losses.addEventListener('input', validate);
    });
</script>
</body>
</html>
