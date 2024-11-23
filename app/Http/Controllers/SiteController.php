<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Tournament;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Ensure this is imported


class SiteController extends Controller
{

    public function index(): View | RedirectResponse
    {
        if (Auth::check())
        {
            return redirect()->route('dashboard');
        }

        return view('site.index');
    }

    public function dashboard(): View | RedirectResponse
    {
        if (Auth::check())
        {
            $user = Auth::user();
            if ($user->new_account and $user->club_id == null)
            {
                $user->new_account = false;
                $user->save();
                return redirect()->route('chooseClub');
            }
            if ($user->role == 'coordinator')
            {
                $tournaments = Tournament::where('coordinator_id', $user->id)->get();
            }
            else $tournaments = [];
            return view('site.dashboard', ['user' => $user, 'club' => $user->club, 'tournaments' => $tournaments]);
        }

        return redirect()->route('login')->with('error', 'Please log in to access the dashboard.');
    }

}
