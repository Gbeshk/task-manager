<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('auth.login'));

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', fn () => 'dashboard')->middleware('auth');
