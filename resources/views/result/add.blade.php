<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Result</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<h1>Add New Result for {{ $tournament["name"] }}</h1>

<form action="{{ url('/result/actionAdd') }}" method="POST">
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

    <input type="hidden" name="tournament_id" value="{{ $tournament['id'] }}">

    <label for="player">Player:</label>
    <select id="player" name="player_id" required>
        @foreach($players as $player)
            <option value="{{ $player->id }}">{{ $player->name }}</option>
        @endforeach
    </select>

    <button type="submit" id="confirm" disabled>Confirm</button>
</form>
<a href="{{url("/dashboard")}}">Back to dashboard</a>
<script>
    const gamesField = document.getElementById('games');
    const winsField = document.getElementById('wins');
    const drawsField = document.getElementById('draws');
    const lossesField = document.getElementById('losses');
    const confirmButton = document.getElementById('confirm');

    function validate() {
        const games = parseInt(gamesField.value || 0);
        const wins = parseInt(winsField.value || 0);
        const draws = parseInt(drawsField.value || 0);
        const losses = parseInt(lossesField.value || 0);
        confirmButton.disabled = (wins + draws + losses !== games);
    }

    gamesField.addEventListener('input', () => {
        const games = parseInt(gamesField.value);
        if (games > 0) {
            winsField.disabled = false;
            drawsField.disabled = false;
            lossesField.disabled = false;
        } else {
            winsField.disabled = true;
            drawsField.disabled = true;
            lossesField.disabled = true;
            confirmButton.disabled = true;
        }
    });

    [winsField, drawsField, lossesField].forEach(field => field.addEventListener('input', validate));
</script>
</body>
</html>
