@extends('layout')

@section('title', 'Send Message')

@section('header', 'Send a Message')


@section('content')
    <form action="{{ url('/message/sendMessage') }}" method="POST">
        @csrf
        <label for="subject">Subject</label>
        <input name="subject" id="subject" type="text" placeholder="Enter message subject" required>

        <label for="send_to_all">Send to all players</label>
        <input type="checkbox" id="send_to_all" name="send_to_all">

        <div id="player_select">
            <label for="receiver">Receiver</label>
            <select name="receiver" id="receiver">
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
        </div>

        <label for="message">Message</label>
        <textarea name="message" id="message" rows="5" placeholder="Enter your message" required></textarea>

        <button type="submit">Send Message</button>
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
@endsection
