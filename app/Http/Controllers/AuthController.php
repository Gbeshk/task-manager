<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
	public function showLogin(): View
	{
		$coverPicturePath = Setting::get('cover_picture');

		$coverPhotoUrl = $coverPicturePath
			? Storage::url($coverPicturePath)
			: asset('images/defaultCover.png');

		return view('auth.login', compact('coverPhotoUrl'));
	}

	public function login(LoginRequest $request): RedirectResponse
	{
		if (!Auth::attempt($request->validated(), $request->boolean('remember'))) {
			throw ValidationException::withMessages([
				'email'    => ' ',
				'password' => __('validation.failed_login'),
			]);
		}
		$request->session()->regenerate();

		return redirect()->intended(route('tasks.index'));
	}

	public function logout(Request $request): RedirectResponse
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->route('login');
	}
}
