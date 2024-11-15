<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Register now</h1>
<form action={{ url('/register/create') }} method="POST">
    @csrf
    @method("POST")
    Enter mail: <input name="login" type="email">
    Enter password: <input name="password" type="password" minlength="8" onchange="validatePassword(this.value)">
    <span id="passwordError" style="color: red"></span>
    Repeat password: <input name="repeat" type="password" minlength="8" onchange="checkPassword(this.value)">
    <span id="repeatPasswordError" style="color: red"></span>
    Role: <select name="role" onchange="showClubOption(this.value)">
        <option value="player" selected >Player</option>
        <option value="coordinator">Coordinator</option>
    </select>
    <span id="clubOption" style="display: none"> Name of Club: <input name="club" type="text"> </span>
    <button type="submit" id="confirm">Confirm</button>
</form>

<script>
    function showClubOption(role)
    {
        let clubOption = document.querySelector("#clubOption");
        if(role === "coordinator")
        {
            clubOption.style.display = "inline";
        }
        else
        {
            clubOption.style.display = "none";
        }
    }

    function validatePassword(password)
    {
        let passwordError = document.querySelector("#passwordError");
        let confirmButton = document.querySelector("#confirm");

        const hasNumber = /\d/;
        const hasSpecialChar = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        const hasCapitalLetter = /[A-Z]/;

        if(password.length < 8)
        {
            document.querySelector("#passwordError").innerText = "Password must be at least 8 characters long";
            document.querySelector("#confirm").disabled = true;
        }
        else if (!hasNumber.test(password) || !hasSpecialChar.test(password) || !hasCapitalLetter.test(password))
        {
            document.querySelector("#passwordError").innerText = "Password must contain at least one number, one special character and one capital letter";
            document.querySelector("#confirm").disabled = true;
        }
        else
        {
            document.querySelector("#passwordError").innerText = "";
            document.querySelector("#confirm").disabled = false;
        }
    }

    function checkPassword(repeat)
    {
        let password = document.querySelector("input[name='password']").value;
        if(password !== repeat)
        {
            document.querySelector("#repeatPasswordError").innerText = "Passwords do not match";
            document.querySelector("#confirm").disabled = true;
        }
        else
        {
            document.querySelector("#repeatPasswordError").innerText = "";
            document.querySelector("#confirm").disabled = false;
        }
    }
</script>
</body>
</html>
