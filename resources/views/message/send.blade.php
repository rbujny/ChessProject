<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send message</title>
</head>
<body>
<h1>Send message</h1>
<form action={{ url('/message/sendMessage') }} method="POST">
    @csrf
    @method("POST")

    <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" required>

    <label for="message">Message</label>
    <textarea id="message" name="message" required></textarea>

    <label for="send_to_all">Send to all players</label>
    <input type="checkbox" id="send_to_all" name="send_to_all">

    <div id="player_select">
        <label for="player">Player</label>
        <select id="player" name="receiver_id">
            @foreach($players as $player)
                <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" id="confirm">Confirm</button>
</form>

<script>
    document.getElementById('send_to_all').addEventListener('change', function() {
        const playerSelect = document.getElementById('player_select');
        if (this.checked) {
            playerSelect.style.display = 'none';
        } else {
            playerSelect.style.display = 'block';
        }
    });
</script>
</body>
</html>
