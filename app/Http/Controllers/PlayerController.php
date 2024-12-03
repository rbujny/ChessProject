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
                        "club_id" => $club->coordinator->club_id,
                    ];
            }
            return view('player.chooseClub', ['clubs' => $models]);
        }
        return Redirect::route('dashboard')->withErrors(['error' => 'You are not allowed to choose a club.']);
    }

    public function joinClub(): RedirectResponse
    {
        $user = Auth::user();
        $user->club_id = request('club');
        if ($user->save())
        {
            return Redirect::route('dashboard')->with('success', 'You have joined the club.');
        }
        return Redirect::route('chooseClub')->withErrors(['error' => 'Failed to join the club.']);
    }

    public function leaveClub(): RedirectResponse
    {
        if (Auth::check())
        {
            $user = Auth::user();
            $user->club_id = null;
            if ($user->save())
            {
                return Redirect::route('dashboard');
            }
            return Redirect::route('dashboard')->withErrors(['error' => 'Failed to leave the club.']);
        }
        return Redirect::route('index')->withErrors(['error' => 'You are not allowed to leave the club.']);
    }

    public function photo()
    {
        if (Auth::check() and Auth::user()->role == 'player')
        {
            return view('player.photo');
        }
        else
        {
            return Redirect::route('index')->withErrors(['error' => 'You are not allowed to upload a photo.']);
        }
    }

    public function uploadPhoto()
    {
        $user = Auth::user();
        $photoName  = $user->name." ".$user->id . "." . request('photo')->getClientOriginalExtension();
        request('photo')->move(public_path('images'), $photoName);
        $user->photo = "images/".$photoName;
        if ($user->save())
        {
            return Redirect::route('dashboard');
        }
        return Redirect::route('photo')->withErrors(['error' => 'Failed to upload photo.']);
    }

}
