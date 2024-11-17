<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TournamentController
{
    public function create(): View
    {
        return view('tournament.create', ['coordinator' => Auth::user()]);
    }

    public function actionCreate()
    {
        // @TODO
    }

    public function index()
    {
        // @TODO
    }

}
