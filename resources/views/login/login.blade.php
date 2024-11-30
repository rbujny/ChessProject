@extends('layout')

@section('title', 'Login')

@section('header', 'Log in to your account')


@section('content')
    <div class="container">
        <form action="{{ url('/login/auth') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input name="login" id="email" type="email" placeholder="Enter your email" required>
            <label for="password">Password</label>
            <input name="password" id="password" type="password" placeholder="Enter your password" required>
            <button type="submit">Confirm</button>
        </form>
    </div>
@endsection
