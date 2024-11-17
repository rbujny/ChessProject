<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PlayerController extends Controller
{
    public function chooseClub(): View | RedirectResponse
    {
        if (Auth::check() and Auth::user()->role == 'player' and Auth::user()->club_id == null)
        {
            $clubs = Club::all();
            $models = [];
            foreach ($clubs as $club)
            {
                $models[$club->name] =
                    [
                        "name" => $club->coordinator->name,
                        "club_id" => $club->coordinator->id,
                    ];
            }
            return view('player.chooseClub', ['clubs' => $models]);
        }
        return Redirect::route('dashboard')->with('error', 'You are not allowed to choose a club.');
    }

    public function joinClub(): RedirectResponse
    {
        $user = Auth::user();
        $user->club_id = request('club');
        if ($user->save())
        {
            return Redirect::route('dashboard');
        }
        return Redirect::route('chooseClub')->with('error', 'Failed to join club.');
    }

    public function leaveClub(): RedirectResponse
    {
        $user = Auth::user();
        $user->club_id = null;
        if ($user->save())
        {
            return Redirect::route('dashboard');
        }
        return Redirect::route('dashboard')->with('error', 'Failed to leave club.');
    }

}
