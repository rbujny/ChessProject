<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Choose your club</h1>
@foreach($tournaments as $tournament)

    <h2>{{ $tournament["name"] }}</h2>
    <p>{{ $tournament["description"] }}</p>
    <p>Start date: {{ date('j F Y, H:i', strtotime($tournament["start_date"])) }}</p>
    <a href={{ url('/result/add/' . $tournament["id"]) }} method="POST">Add result</a>
    <a href={{ url('/result/show/' . $tournament["id"]) }} method="POST">Show results</a>

@endforeach
<p>Or choose your club <a href="{{url("/dashboard")}}"> later </a> </p>
</body>
</html>
