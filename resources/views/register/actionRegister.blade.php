@extends('layout')

@section('title', 'Registration Confirmation')

@section('header', 'Registration Successful')


@section('content')
    <div class="container">
        <p>You can now <a href="{{ url('/login') }}">login</a> to your account.</p>
    </div>
@endsection
