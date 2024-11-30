@extends('layout')

@section('title', 'Upload Photo')

@section('header', 'Upload Photo')


@section('content')
    <form action="{{ url('/player/uploadPhoto') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="photo">Choose a photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
    <a href="{{url("/dashboard")}}">Back to dashboard</a>
@endsection
