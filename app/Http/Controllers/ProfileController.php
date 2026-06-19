<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit');
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = auth()->user();

        $anyPasswordFilled = $request->filled('current_password')
            || $request->filled('new_password')
            || $request->filled('new_password_confirmation');

        if ($anyPasswordFilled) {

            if (!$request->filled('current_password')) {
                return back()->withErrors([
                    'current_password' => 'Please enter your current password',
                ]);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Current password is incorrect',
                ]);
            }

            if (!$request->filled('new_password')) {
                return back()->withErrors([
                    'new_password'              => 'Please enter a new password',
                    'new_password_confirmation' => 'Please enter a new password',
                ]);
            }

            if (strlen($request->new_password) < 3) {
                return back()->withErrors([
                    'new_password'              => 'Password must be at least 3 characters',
                    'new_password_confirmation' => 'Password must be at least 3 characters',
                ]);
            }

            if (Hash::check($request->new_password, $user->password)) {
                return back()->withErrors([
                    'new_password'              => 'New password must be different from current password',
                    'new_password_confirmation' => 'New password must be different from current password',
                ]);
            }

            if ($request->new_password !== $request->new_password_confirmation) {
                return back()->withErrors([
                    'new_password'              => 'Passwords do not match',
                    'new_password_confirmation' => 'Passwords do not match',
                ]);
            }

            $user->update(['password' => Hash::make($request->new_password)]);
        }

        if ($request->boolean('delete_profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->update(['profile_picture' => null]);
        } elseif ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->update(['profile_picture' => $path]);
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }
}
