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

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            if (Hash::check($request->new_password, $user->password)) {
                return back()->withErrors(['new_password' => 'New password must be different from current password']);
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
