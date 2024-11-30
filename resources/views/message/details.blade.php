@extends('layout')

@section('title', 'Message Details')

@section('header', 'Message Details')


@section('content')
    <div class="container">

        @if($message)
            <p><strong>Subject:</strong> {{ $message->subject }}</p>
            <p><strong>Message:</strong> {{ $message->message }}</p>
            <p><strong>Sender:</strong> {{ $message->sender->name }}</p>
            <p><strong>Receiver:</strong> {{ $message->receiver->name }}</p>
            <p><strong>Read:</strong> {{ $message->read ? 'Yes' : 'No' }}</p>
        @else
            <p>Message not found.</p>
        @endif

        <div class="actions">
            <a href="{{ route('listMessage') }}">Back to Messages</a>
        </div>
    </div>
@endsection
