<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Details</title>
</head>
<body>
<h1>Message Details</h1>

@if($message)
    <p><strong>Subject:</strong> {{ $message->subject }}</p>
    <p><strong>Message:</strong> {{ $message->message }}</p>
    <p><strong>Sender:</strong> {{ $message->sender->name }}</p>
    <p><strong>Receiver:</strong> {{ $message->receiver->name }}</p>
    <p><strong>Read:</strong> {{ $message->read ? 'Yes' : 'No' }}</p>
@else
    <p>Message not found.</p>
@endif

<a href="{{ route('listMessage') }}">Back to Messages</a>
</body>
</html>
