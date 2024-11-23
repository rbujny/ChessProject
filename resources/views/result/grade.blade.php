<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tournament</title>
</head>
<body>
<h1>Add grade</h1>
<form action={{ url('/result/setGrade') }} method="POST">
    @csrf
    @method("POST")

    <label for="grade">Grade:</label>
    <input type="number" id="grade" name="grade" min="1" max="10" step="1" required>
    <input type="hidden" name="result_id" value="{{ $result_id }}">
    <button type="submit" id="confirm">Confirm</button>
</form>
</body>
</html>
