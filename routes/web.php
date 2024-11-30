<?php

use App\Http\Controllers\{
    LoginController,
    PlayerController,
    SiteController,
    RegisterController,
    TournamentController,
    MessageController,
    ResultController
};
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register/create', [RegisterController::class, 'actionRegister'])->name('register');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/auth', [LoginController::class, 'actionLogin'])->name('actionLogin');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('player')->name('player.')->group(function () {
        Route::get('chooseClub', [PlayerController::class, 'chooseClub'])->name('chooseClub');
        Route::post('joinClub', [PlayerController::class, 'joinClub'])->name('joinClub');
        Route::post('leaveClub', [PlayerController::class, 'leaveClub'])->name('leaveClub');
        Route::get('photo', [PlayerController::class, 'photo'])->name('photo');
        Route::post('uploadPhoto', [PlayerController::class, 'uploadPhoto'])->name('uploadPhoto');
    });

    Route::prefix('tournament')->name('tournament.')->group(function () {
        Route::get('create', [TournamentController::class, 'create'])->name('create');
        Route::post('actionCreate', [TournamentController::class, 'actionCreate'])->name('actionCreate');
        Route::get('index', [TournamentController::class, 'index'])->name('index');
        Route::get('generateReport', [TournamentController::class, 'generateReport'])->name('generateReport');
    });

    Route::prefix('result')->name('result.')->group(function () {
        Route::get('add/{tournament_id}', [ResultController::class, 'add'])->name('add');
        Route::post('actionAdd', [ResultController::class, 'actionAdd'])->name('actionAdd');
        Route::get('show/{tournament_id}', [ResultController::class, 'show'])->name('show');
        Route::get('show/player/personal', [ResultController::class, 'showByPlayer'])->name('showByPlayer');
        Route::get('show/player/coordinator/{player_id}', [ResultController::class, 'showByPlayerForCoordinator'])->name('showByPlayerForCoordinator');
        Route::get('grade/{id}', [ResultController::class, 'grade'])->name('addGrade');
        Route::post('setGrade', [ResultController::class, 'setGrade'])->name('setGrade');
        Route::get('edit/{id}', [ResultController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ResultController::class, 'update'])->name('update');
    });

    Route::prefix('message')->name('message.')->group(function () {
        Route::get('send', [MessageController::class, 'send'])->name('send');
        Route::post('sendMessage', [MessageController::class, 'sendMessage'])->name('sendMessage');
        Route::get('list', [MessageController::class, 'listMessage'])->name('list');
        Route::get('details/{id}', [MessageController::class, 'detailsMessage'])->name('details');
    });
});
