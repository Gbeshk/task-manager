<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
	Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
	Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
	Route::get('/tasks/due', [TaskController::class, 'due'])->name('tasks.due');
	Route::delete('/tasks/old', [TaskController::class, 'destroyOld'])->name('tasks.destroyOld');
	Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
	Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
});
