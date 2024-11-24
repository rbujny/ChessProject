<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard')->middleware('auth');;
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register/create', [RegisterController::class, 'actionRegister'])->name('register');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/auth', [LoginController::class, 'actionLogin'])->name('actionLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/player/chooseClub', [PlayerController::class, 'chooseClub'])->name('chooseClub');
Route::post('/player/joinClub', [PlayerController::class, 'joinClub'])->name('joinClub');
Route::post('/player/leaveClub', [PlayerController::class, 'leaveClub'])->name('leaveClub');
Route::get('/player/photo', [PlayerController::class, 'photo'])->name('photo');
Route::post('/player/uploadPhoto', [PlayerController::class, 'uploadPhoto'])->name('uploadPhoto');
Route::get('/tournament/create', [TournamentController::class, 'create'])->name('createTournament');
Route::post('/tournament/actionCreate', [TournamentController::class, 'actionCreate'])->name('actionCreateTournament');
Route::get('/tournament/index', [TournamentController::class, 'index'])->name('indexTournament');
Route::get('/tournament/generateReport', [TournamentController::class, 'generateReport'])->name('generateReport');
Route::get('/result/add/{tournament_id}', [ResultController::class, 'add'])->name('addResult');
Route::post('/result/actionAdd', [ResultController::class, 'actionAdd'])->name('actionAddResult');
Route::get('/result/show/{tournament_id}', [ResultController::class, 'show'])->name('showResults');
Route::get('/result/show/player/personal', [ResultController::class, 'showByPlayer'])->name('showByPlayer');
Route::get('/result/show/player/coordinator/{player_id}', [ResultController::class, 'showByPlayerForCoordinator'])->name('showByPlayerForCoordinator');
Route::get('/result/grade/{id}', [ResultController::class, 'grade'])->name('addGrade');
Route::post('/result/setGrade', [ResultController::class, 'setGrade'])->name('setGrade');
Route::get('/result/edit/{id}', [ResultController::class, 'edit'])->name('resultEdit');
Route::post('/result/update/{id}', [ResultController::class, 'update'])->name('resultUpdate');
