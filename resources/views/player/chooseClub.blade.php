@extends('layout')

@section('title', 'Choose club')

@section('header', 'Choose your club')


@section('content')
    @foreach($clubs as $club => $coordinator)

        <form action={{ url('/player/joinClub') }} method="POST">
            @csrf
            @method("POST")
            Club {{ $club }} is managed by {{ $coordinator["name"] }}.
            <input type="hidden" name="club" value={{ $coordinator["club_id"] }}>
            <button type="submit" id="confirm">Join club {{ $club }}</button>
        </form>

    @endforeach
    <p>Or choose your club <a href="{{url("/dashboard")}}"> later </a> </p>
@endsection
