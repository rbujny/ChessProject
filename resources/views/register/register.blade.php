@extends('layout')

@section('title', 'Register')

@section('header', 'Register now')


@section('content')
    <form action="{{ url('/register/create') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input name="name" id="name" type="text" placeholder="Enter your name" required>

        <label for="email">Email</label>
        <input name="login" id="email" type="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <input name="password" id="password" type="password" placeholder="Enter your password" minlength="8" required onchange="validatePassword(this.value)">
        <span id="passwordError" class="error-message"></span>

        <label for="repeat-password">Repeat Password</label>
        <input name="repeat" id="repeat-password" type="password" placeholder="Repeat your password" minlength="8" required onchange="checkPassword(this.value)">
        <span id="repeatPasswordError" class="error-message"></span>

        <label for="role">Role</label>
        <select name="role" id="role" onchange="showClubOption(this.value)">
            <option value="player" selected>Player</option>
            <option value="coordinator">Coordinator</option>
        </select>

        <div id="clubOption" style="display: none">
            <label for="club">Name of Club</label>
            <input name="club" id="club" type="text" placeholder="Enter club name">
        </div>

        <button type="submit" id="confirm">Confirm</button>
    </form>

    <script>
        function showClubOption(role) {
            let clubOption = document.querySelector("#clubOption");
            clubOption.style.display = role === "coordinator" ? "block" : "none";
        }

        function validatePassword(password) {
            let passwordError = document.querySelector("#passwordError");
            let confirmButton = document.querySelector("#confirm");

            const hasNumber = /\d/;
            const hasSpecialChar = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            const hasCapitalLetter = /[A-Z]/;

            if (password.length < 8) {
                passwordError.innerText = "Password must be at least 8 characters long.";
                confirmButton.disabled = true;
            } else if (!hasNumber.test(password) || !hasSpecialChar.test(password) || !hasCapitalLetter.test(password)) {
                passwordError.innerText = "Password must include a number, special character, and a capital letter.";
                confirmButton.disabled = true;
            } else {
                passwordError.innerText = "";
                confirmButton.disabled = false;
            }
        }

        function checkPassword(repeat) {
            let password = document.querySelector("#password").value;
            let repeatPasswordError = document.querySelector("#repeatPasswordError");
            let confirmButton = document.querySelector("#confirm");

            if (password !== repeat) {
                repeatPasswordError.innerText = "Passwords do not match.";
                confirmButton.disabled = true;
            } else {
                repeatPasswordError.innerText = "";
                confirmButton.disabled = false;
            }
        }
    </script>
@endsection
