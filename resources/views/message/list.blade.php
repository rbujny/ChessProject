<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Your messages</h1>
@foreach($messages as $message)
    @if ($role == "coordinator")
        <p><strong>Subject:</strong> {{ $message->subject }}</p>
        <p><strong>Message:</strong> {{ $message->message }}</p>
        <p><strong>Sender:</strong> {{ $message->sender->name }}</p>
        <p><strong>Receiver:</strong> {{ $message->receiver->name }}</p>
        <p><strong>Read:</strong> {{ $message->read ? 'Yes' : 'No' }}</p>
        <hr>
    @else
        @if($message["read"] == 0)
            <h2>{{ $message["subject"] }}</h2>
        @else
            <p>{{ $message["subject"] }}</p>
        @endif
        <a href="{{url("/message/details") . "/".$message["id"]}}">See details</a>
    @endif
@endforeach
</body>
</html>
