@extends('layout')

@section('title', 'Welcome')

@section('header', 'Welcome to the Tournament System')


@section('content')
    <div class="container">
        <p><a href="{{ url('/login') }}">Login</a> to access your dashboard.</p>
        <p>Don't have an account? <a href="{{ url('/register') }}">Register here</a>.</p>
    </div>
@endsection
