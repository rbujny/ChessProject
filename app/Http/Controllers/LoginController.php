<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController
{
    public function login(): View | RedirectResponse
    {
        if (Auth::check())
        {
            return redirect()->route('dashboard');
        }
        return view('login.login');
    }

    public function actionLogin(): RedirectResponse
    {
        $login = request('login');
        $password = request('password');

        if (!auth()->attempt(['login' => $login, 'password' => $password])) {
            return redirect()->back()->withErrors(['error' => 'Invalid login or password']);
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function username()
    {
        return 'login';
    }
}
