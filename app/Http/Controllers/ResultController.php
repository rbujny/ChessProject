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
        ]))
        {
            $data = request()->all();
            $result = new Result();
            $result->fill($data);
            if ($result->save())
            {
                return redirect('result/show/'.$data["tournament_id"])->with('success', 'Result added successfully.');
            }
            else
            {
                return redirect('result/add')->with('error', 'Failed to add result.');
            }
        }
        return redirect('result/add')->with('error', 'Failed to add result.');
    }

    public function show(int $tournament_id)
    {
        if (Auth::check())
        {
            $results = Result::where('tournament_id', $tournament_id)->get();
            return view('result.show', ['results' => $results, 'tournament_id' => $tournament_id]);
        }
        else
        {
            return redirect()->route('index')->with('error', 'You need to be logged in to view results.');
        }
    }

    public function showByPlayer()
    {
        if (Auth::check())
        {
            $user = Auth::user();
            $results = $user->results;
            return view('result.showByPlayer', ['results' => $results]);
        }
        else
        {
            return redirect()->route('index');
        }
    }

    public function showByPlayerForCoordinator(int $player_id)
    {
        if (Auth::check() and Auth::user()->role == 'coordinator')
        {
            $player = User::where('id', $player_id)->first();
            $results = Result::where('player_id', $player_id)->get();
            return view('result.showForCoordinator', ['player' => $player, 'results' => $results]);
        }
        else
        {
            return redirect()->route('index');
        }
    }

    public function edit(int $id)
    {
        if (Auth::check() and Auth::User()->role == 'coordinator') {
            $result = Result::where('id', $id)->first();
            return view('result.edit', ['result' => $result]);
        }
        else
        {
            return redirect()->route('index');
        }
    }

    public function update(int $id)
    {
        if (request()->validate([
            'games' => 'required|integer',
            'wins' => 'required|integer',
            'draws' => 'required|integer',
            'losses' => 'required|integer',
            'tournament_id' => 'required|integer',
            'grade' => 'nullable|integer',
        ]));
        {
            $data = request()->all();
            $result = Result::where('id', $id)->first();
            $result->fill($data);
            if ($result->save())
            {
                return redirect('result/show/'.$data["tournament_id"])->with('success', 'Result updated successfully.');
            }
            else
            {
                return redirect('result/edit/'.$data['result_id'])->withErrors(['error' => 'Failed to update result.']);
            }
        }
    }

    public function grade(int $id)
    {
        if (Auth::check() and Auth::User()->role == 'coordinator') {
            return view('result.grade', ['result_id' => $id]);
        }
        else
        {
            return redirect()->route('dashboard')->withErrors(['error' => 'You are not allowed to grade results.']);
        }
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
                return redirect('result/grade/'.$data['result_id'])->withErrors(['error' => 'Failed to set grade.']);
            }
        }
    }


}
