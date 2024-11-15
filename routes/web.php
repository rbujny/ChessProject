<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard')->middleware('auth');;
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register/create', [RegisterController::class, 'actionRegister'])->name('register');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/auth', [LoginController::class, 'actionLogin'])->name('actionLogin');
