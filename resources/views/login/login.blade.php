<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Register now</h1>
<form action={{ url('/login/auth') }} method="POST">
    @csrf
    @method("POST")
    Enter mail: <input name="login" type="email">
    Enter password: <input name="password" type="password">
    <button type="submit" id="confirm">Confirm</button>
</form>
</body>
</html>
