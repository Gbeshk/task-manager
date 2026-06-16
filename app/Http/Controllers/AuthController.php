<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function login(LoginRequest $request)
	{
		if (!Auth::attempt($request->validated(), $request->boolean('remember'))) {
			throw ValidationException::withMessages([
				'email' => __('auth.failed'),
			]);
		}

		$request->session()->regenerate();

		return redirect()->intended('/dashboard');
	}
}
