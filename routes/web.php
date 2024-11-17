<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TournamentController;
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
Route::get('/tournament/create', [TournamentController::class, 'create'])->name('createTournament');
Route::post('/tournament/actionCreate', [TournamentController::class, 'actionCreate'])->name('actionCreateTournament');
