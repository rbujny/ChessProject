<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tournament</title>
</head>
<body>
<h1>Create new tournament</h1>
<form action={{ url('/tournament/actionCreate') }} method="POST">
    @csrf
    @method("POST")

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" required>

    <label for="start_date">Start Date:</label>
    <input type="datetime-local" id="start_date" name="start_date" required>

    <button type="submit" id="confirm">Confirm</button>
</form>
</body>
</html>
