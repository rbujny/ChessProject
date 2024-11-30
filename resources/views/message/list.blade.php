@extends('layout')

@section('title', 'Your Messages')

@section('header', 'Your Messages')


@section('content')
    <div class="container">
        @foreach($messages as $message)
            <div class="message">
                @if ($role == "coordinator")
                    <p><strong>Subject:</strong> {{ $message->subject }}</p>
                    <p><strong>Message:</strong> {{ $message->message }}</p>
                    <p><strong>Sender:</strong> {{ $message->sender->name }}</p>
                    <p><strong>Receiver:</strong> {{ $message->receiver->name }}</p>
                    <p><strong>Read:</strong> {{ $message->read ? 'Yes' : 'No' }}</p>
                @else
                    <h3>{{ $message["subject"] }}</h3>
                    <a href="{{ url('/message/details/' . $message["id"]) }}">See Details</a>
                @endif
            </div>
            <hr>
        @endforeach
        <a href="{{url("/dashboard")}}">Back to dashboard</a>
    </div>
@endsection
