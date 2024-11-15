<?php

namespace App\Http\Controllers;
class LoginController
{
    public function login()
    {
        return view('login.login');
    }

    public function actionLogin()
    {
        $login = request('login');
        $password = request('password');

        if (!auth()->attempt(['login' => $login, 'password' => $password])) {
            return redirect()->back();
        }

        return redirect()->route('dashboard');
    }

    public function username()
    {
        return 'login';
    }
}
