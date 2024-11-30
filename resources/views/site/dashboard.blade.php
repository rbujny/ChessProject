@extends('layout')

@section('title', 'Dashboard')

@section('header', 'Dashboard')


@section('content')
<a href="{{ url('/logout') }}" class="logout-link">Logout</a>
<div class="container">
    <p>Welcome to your dashboard, <strong>{{ $user->name }}</strong>.</p>

    @if($user->role == 'player')
        @if($user->photo)
            <img src="{{ asset($user->photo) }}" alt="Profile Photo" width="100" height="100">
        @else
            <p><a href="{{ url('/player/photo') }}">Upload photo</a></p>
        @endif
        @if($user->club == null)
            <p>You are not a member of any club.</p>
            <a href="{{ url('/player/chooseClub') }}">Join a club</a>
        @else
            <p>Your club: <strong>{{ $club->name }}</strong></p>
            <p>Club Coordinator: <strong>{{ $club->coordinator->name }}</strong></p>
            <h2>Your Last Results:</h2>
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
                        <td>{{ $result->grade ?: '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>See all <a href="{{ url('/result/show/player/personal') }}">results</a>.</p>

            @if($messages > 0)
                <p>You have <strong>{{ $messages }} unread</strong> <a href="{{ url('/message/list') }}">messages</a>.</p>
            @else
                <p>You're up-to-date! View <a href="{{ url('/message/list') }}">read messages</a>.</p>
            @endif

            <form action="{{ url('/player/leaveClub') }}" method="POST">
                @csrf
                <button type="submit">Leave Club</button>
            </form>
        @endif
    @else
        <p>Your Club: <strong>{{ $club->name }}</strong></p>
        <h2>Your Players:</h2>
        <ul style="list-style-type: none">
            @foreach($club->players as $player)
                <li><a href="{{ url('/result/show/player/coordinator/' . $player->id) }}">{{ $player->name }}</a></li>
            @endforeach
        </ul>
        <p><a href="{{ url('/message/send') }}">Send message</a> to players</p>
        <p><a href="{{ url('/message/list') }}">View sent messages</a></p>

        <h2>Your Last Tournaments:</h2>
        <ul style="list-style-type: none">
            @foreach($tournaments as $tournament)
                <li>{{ $tournament->name }}</li>
            @endforeach
        </ul>
        <p><a href="{{ url('/tournament/create') }}">Add a new tournament</a></p>
        <p><a href="{{ url('/tournament/index') }}">View all tournaments</a></p>
    @endif
@endsection
