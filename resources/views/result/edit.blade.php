@extends('layout')

@section('title', 'Edit Result')

@section('header', 'Edit Result for ' . $result->tournament->name )


@section('content')
    <form action="{{ url('/result/update/' . $result->id) }}" method="POST">
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

        @if($result->grade != 0)
            <label for="grade">Grade:</label>
            <input type="number" id="grade" name="grade" value="{{ $result->grade }}" min="1" max="10" step="1" required>
        @endif

        <button type="submit" id="confirm">Confirm</button>
    </form>
    <a href="{{url("/dashboard")}}">Back to dashboard</a>
@endsection
