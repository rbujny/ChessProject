<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Ensure this is imported


class SiteController extends Controller
{

    public function index(): View
    {
        return view('site.index');
    }

    public function dashboard(): View | RedirectResponse
    {
        if (Auth::guest()) {
            return redirect()->route('login')->with('error', 'Please log in to access the dashboard.');
        }

        if (Auth::check())
        {
            echo 'You are logged in!';
        }

        return view('site.dashboard');
    }

}
