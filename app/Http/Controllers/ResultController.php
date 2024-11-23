<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Result;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ResultController
{

    public function add(int $tournament_id): View | RedirectResponse
    {
        $user = Auth::user();
        if (Auth::check() and $user->role == 'coordinator') {
            $tournament = Tournament::where('id', $tournament_id)->first();
            if ($tournament->coordinator_id != $user->id) {
                return redirect()->route('index');
            }
            $alreadyResults = Result::where('tournament_id', $tournament_id)->pluck('player_id')->toArray();
            $club = Club::where('coordinator_id', $user->id)->first();
            $players = User::where('club_id', $club->id)
                ->where('role', 'player')
                ->whereNotIn('id', $alreadyResults)
                ->get();
            return view('result.add', ['players' => $players, 'tournament' => $tournament]);
        }
        else
        {
            return redirect()->route('index');
        }

    }

    public function actionAdd()
    {
        if (request()->validate([
            'games' => 'required|integer',
            'wins' => 'required|integer',
            'draws' => 'required|integer',
            'losses' => 'required|integer',
            'player_id' => 'required|integer',
            'tournament_id' => 'required|integer',
        ]));
        {
            $data = request()->all();
            $result = new Result();
            $result->fill($data);
            $result->grade = 0; // @TODO przy nowej migracji do usuniecia
            if ($result->save())
            {
                return redirect('result/show/'.$data["tournament_id"])->with('success', 'Result added successfully.');
            }
            else
            {
                return redirect('result/add')->with('error', 'Failed to add result.');
            }
        }
    }

    public function show(int $tournament_id)
    {
        $results = Result::where('tournament_id', $tournament_id)->get();
        return view('result.show', ['results' => $results]);
    }

    public function edit(int $id)
    {
        //@TODO
    }

    public function grade(int $id)
    {
        return view('result.grade', ['result_id' => $id]);
    }

    public function setGrade()
    {
        if (request()->validate([
            'grade' => 'required|integer',
            'result_id' => 'required|integer',
        ]));
        {
            $data = request()->all();
            $result = Result::where('id', $data['result_id'])->first();
            $result->grade = $data['grade'];
            if ($result->save())
            {
                return redirect('result/show/'.$result->tournament_id)->with('success', 'Grade set successfully.');
            }
            else
            {
                return redirect('result/grade/'.$data['result_id'])->with('error', 'Failed to set grade.');
            }
        }
    }


}
