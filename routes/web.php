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
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

	Route::prefix('tasks')->name('tasks.')->group(function () {
		Route::get('/', [TaskController::class, 'index'])->name('index');
		Route::get('/due', [TaskController::class, 'due'])->name('due');
		Route::get('/create', [TaskController::class, 'create'])->name('create');
		Route::post('/', [TaskController::class, 'store'])->name('store');
		Route::delete('/old', [TaskController::class, 'destroyDue'])->name('destroy-due');
		Route::get('/{task}', [TaskController::class, 'show'])->name('show');
		Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
	});
});
