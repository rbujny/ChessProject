<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add result</title>
</head>
<body>
<h1>Add new result for tournament {{ $tournament["name"] }}</h1>
<form action={{ url('/result/actionAdd') }} method="POST">
    @csrf
    @method("POST")

    <label for="games">Games:</label>
    <input type="number" id="games" name="games" required>

    <label for="wins">Wins:</label>
    <input type="number" id="wins" name="wins" disabled required>

    <label for="draws">Draws:</label>
    <input type="number" id="draws" name="draws" disabled required>

    <label for="losses">Losses:</label>
    <input type="number" id="losses" name="losses" disabled required>

    <input type="hidden" name="tournament_id" value="{{ $tournament["id"] }}">

    <label for="player">Player:</label>
    <select id="player" name="player_id" required>
        @foreach($players as $player)
            <option value="{{ $player->id }}">{{ $player->name }}</option>
        @endforeach
    </select>

    <button type="submit" id="confirm" disabled>Confirm</button>
</form>

<script>
    document.getElementById('games').addEventListener('input', function() {
        const games = parseInt(this.value);
        const wins = document.getElementById('wins');
        const draws = document.getElementById('draws');
        const losses = document.getElementById('losses');
        const confirmButton = document.getElementById('confirm');

        if (games > 0) {
            wins.disabled = false;
            draws.disabled = false;
            losses.disabled = false;
        } else {
            wins.disabled = true;
            draws.disabled = true;
            losses.disabled = true;
            confirmButton.disabled = true;
        }

        wins.addEventListener('input', validate);
        draws.addEventListener('input', validate);
        losses.addEventListener('input', validate);

        function validate() {
            const total = parseInt(wins.value || 0) + parseInt(draws.value || 0) + parseInt(losses.value || 0);
            if (total === games) {
                confirmButton.disabled = false;
            } else {
                confirmButton.disabled = true;
            }
        }
    });
</script>
</body>
</html>
