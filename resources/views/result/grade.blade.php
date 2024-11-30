@extends('layout')

@section('title', 'Add Grade')

@section('header', 'Add Grade for Result')

@section('content')
    <form action="{{ url('/result/setGrade') }}" method="POST">
        @csrf
        @method("POST")

        <label for="grade">Grade:</label>
        <input type="number" id="grade" name="grade" min="1" max="10" step="1" required>

        <input type="hidden" name="result_id" value="{{ $result_id }}">

        <button type="submit" id="confirm">Confirm</button>
    </form>
    <a href="{{url("/dashboard")}}">Back to dashboard</a>
@endsection
