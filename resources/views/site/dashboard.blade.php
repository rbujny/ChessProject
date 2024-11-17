<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Dashboard</h1>
<p>Welcome to your dashboard {{ $user->name }}</p>
@if($user->role == 'player')
@if($user->club == null)
    <p>You are not a member of any club</p>
    <a href={{ url('/player/chooseClub') }}>Join a club</a>
@else
    <p>Your club {{ $club->name }}</p>
    <p>Club coordinator: {{ $club->coordinator->name }}</p>
    <form action={{ url('/player/leaveClub') }} method="POST">
        @csrf
        @method("POST")
        <button type="submit" id="confirm">Leave club</button>
    </form>
@endif
@else
    <p>Your club {{ $club->name }}</p>
    <p>Your players</p>
    <ul>
        @foreach($club->players as $player)
            <li>{{ $player->name }}</li>
        @endforeach
    </ul>
        <p>
            Add <a href="{{url('/tournament/create')}}">tournament</a>
        </p>
@endif
<p>Logout <a href={{ url('/logout') }}>Logout</a></p>
</body>
</html>
