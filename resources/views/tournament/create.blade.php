@extends('layout')

@section('title', 'Create Tournament')

@section('header', 'Create Tournament')


@section('content')
    <form action="{{ url('/tournament/actionCreate') }}" method="POST">
        @csrf
        <label for="name">Tournament Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>

        <label for="start_date">Start Date:</label>
        <input type="datetime-local" id="start_date" name="start_date" required>

        <button type="submit" id="confirm">Create Tournament</button>
    </form>
@endsection
