<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Choose your club</h1>
@foreach($clubs as $club => $coordinator)

    <form action={{ url('/player/joinClub') }} method="POST">
        @csrf
        @method("POST")
        Club {{ $club }} is managed by {{ $coordinator["name"] }}.
        <input type="hidden" name="club" value={{ $coordinator["club_id"] }}>
        <button type="submit" id="confirm">Join club {{ $club }}</button>
    </form>

@endforeach
<p>Or choose your club <a href="{{url("/dashboard")}}"> later </a> </p>
</body>
</html>
