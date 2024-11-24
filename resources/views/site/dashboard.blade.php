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
    <p>You last results:
        <table class="table">
            <thead>
            <tr>
                <th>Tournament</th>
                <th>Games</th>
                <th>Wins</th>
                <th>Draws</th>
                <th>Losses</th>
                <th>Grade</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->tournament->name }}</td>
                    <td>{{ $result->games }}</td>
                    <td>{{ $result->wins }}</td>
                    <td>{{ $result->draws }}</td>
                    <td>{{ $result->losses }}</td>
                    @if($result->grade == 0)
                        <td>-</td>
                    @else
                        <td>{{ $result->grade }}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </p>
    <p>
        All <a href="{{url('/result/show/player/personal')}}">results</a>
    </p>
    @if($user->photo != null)
        <img src="{{ asset($user->photo) }}" alt="photo" width="100" height="100">
    @else
        <p>
            Upload <a href="{{url('/player/photo')}}">photo</a>
        </p>
    @endif

    <p>
        Add <a href="{{url('/result/photo')}}">result</a>
    </p>
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
            <a href="{{url("/result/show/player/coordinator")."/".$player->id}}"><li>{{ $player->name }}</li></a>
        @endforeach
    </ul>
    <p>Your last tournaments</p>
    <ul>
        @foreach($tournaments as $tournament)
            <li><a>{{ $tournament->name }} </a></li>
        @endforeach
    </ul>
        <p>
            Add <a href="{{url('/tournament/create')}}">tournament</a>
        </p>
        <p>
            Show <a href="{{url('/tournament/index')}}">tournament</a>
        </p>
@endif
<p>Logout <a href={{ url('/logout') }}>Logout</a></p>
</body>
</html>
