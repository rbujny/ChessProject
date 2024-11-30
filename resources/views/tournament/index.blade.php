@extends('layout')

@section('title', 'Tournaments')

@section('header', 'Available Tournaments')

@section('content')
    @foreach($tournaments as $tournament)
        <div class="tournament">
            <h2>{{ $tournament["name"] }}</h2>
            <p>{{ $tournament["description"] }}</p>
            <p>Start Date: {{ date('j F Y, H:i', strtotime($tournament["start_date"])) }}</p>
            <p>
                <a href="{{ url('/result/add/' . $tournament['id']) }}">Add Result</a> |
                <a href="{{ url('/result/show/' . $tournament['id']) }}">Show Results</a>
            </p>
        </div>
    @endforeach
    <a href="{{url("/dashboard")}}">Back to dashboard</a>
@endsection
