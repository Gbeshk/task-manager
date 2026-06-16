<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', fn () => view('auth.login'))->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', fn () => 'dashboard')->middleware('auth');
