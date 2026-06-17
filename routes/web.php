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
	Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

	Route::prefix('tasks')->name('tasks.')->group(function () {
		Route::get('/due', [TaskController::class, 'due'])->name('due');
		Route::delete('/old', [TaskController::class, 'destroyDue'])->name('destroy-old');
		Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
		Route::get('/{task}', [TaskController::class, 'show'])->name('show');
	});
});
