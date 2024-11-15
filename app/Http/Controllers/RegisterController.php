<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use Illuminate\View\View;

class RegisterController extends Controller
{

    public function register(): View
    {
        return view('register.register');
    }

    public function actionRegister(): View
    {
        if (request()->validate([
            'login' => 'required',
            'password' => 'required|min:8',
            'repeat' => 'required|same:password',
            'role' => 'required|in:player,coordinator',
        ]))
        {
            $data = request()->all();
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['repeat_password']);
            $user = new User();
            $user->fill($data);
            $user->save();

            if ($user->role === 'coordinator')
            {
                $club = Club::factory()->make();
                if($data['club'] and $data['club'] !== '')
                {
                    $club->name = $data['club'];
                }
                $club->coordinator_id = $user->id;
                $club->save();
                $user->club_id = $club->id;
                $user->save();
            }

        }

        return view('register.actionRegister');
    }
}
