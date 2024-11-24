<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TournamentController
{
    public function create(): View | RedirectResponse
    {

        if (Auth::check() and Auth::user()->role == 'coordinator')
        {
            return view('tournament.create', ['coordinator' => Auth::user()]);
        }
        return redirect()->route('login')->with('error', "You are not allowed to create a tournament.");
    }

    public function actionCreate()
    {
        if (request()->validate([
            'name' => 'required|unique:tournaments',
            'description' => 'required',
            'start_date' => 'required|date',
        ]));
        {
            $data = request()->all();
            $tournament = new Tournament();
            $tournament->fill($data);
            $tournament->coordinator_id = Auth::user()->id;
            if ($tournament->save())
            {
                return redirect('tournament/index')->with('success', 'Tournament created successfully.');
            }
            else
            {
                return redirect('tournament/create')->with('error', 'Failed to create tournament.');
            }
        }
    }

    public function index()
    {
        if (Auth::check() and Auth::user())
        {
            $tournaments = Tournament::where('coordinator_id', Auth::user()->id)->get();
            return view('tournament.index', ['tournaments' => $tournaments]);
        }
        return redirect()->route('login')->with('error', "You are not allowed to index a tournament.");
    }

    public function generateReport()
    {
        $tournaments = Tournament::with(['results', 'results.player'])->get();

        $reportData = $tournaments->map(function ($tournament) {
            $averageGrade = $tournament->results->avg('grade'); // Średnia ocena
            return [
                'name' => $tournament->name,
                'description' => $tournament->description,
                'start_date' => $tournament->start_date,
                'results' => $tournament->results->map(function ($result) {
                    return [
                        'player_name' => $result->player->name,
                        'games' => $result->games,
                        'wins' => $result->wins,
                        'draws' => $result->draws,
                        'losses' => $result->losses,
                        'grade' => $result->grade,
                    ];
                }),
                'average_grade' => $averageGrade,
            ];
        });

        $pdf = Pdf::loadView('tournament.report', ['reportData' => $reportData]);

        return $pdf->download('tournament_report.pdf');
    }
}
