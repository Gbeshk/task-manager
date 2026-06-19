<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Setting;
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

        if ($this->isAttemptingPasswordChange($request)) {
            $error = $this->validatePasswordChange($request, $user);

            if ($error) {
                return back()->withInput()->withErrors($error);
            }

            $user->update(['password' => Hash::make($request->new_password)]);
        }

        $this->handleProfilePicture($request, $user);
        $this->handleProfilePicture($request, $user);
        $this->handleCoverPicture($request);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }

    private function isAttemptingPasswordChange(UpdateProfileRequest $request): bool
    {
        return $request->filled('current_password')
            || $request->filled('new_password')
            || $request->filled('new_password_confirmation');
    }
    private function validatePasswordChange(UpdateProfileRequest $request, $user): ?array
    {
        $msg = $request->passwordErrors();

        if (!$request->filled('current_password')) {
            return ['current_password' => $msg['current_missing']];
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return ['current_password' => $msg['current_incorrect']];
        }

        if (!$request->filled('new_password')) {
            return [
                'new_password'              => $msg['new_missing'],
                'new_password_confirmation' => ' ',
            ];
        }

        if (strlen($request->new_password) < 3) {
            return [
                'new_password'              => $msg['new_too_short'],
                'new_password_confirmation' => ' ',
            ];
        }

        if (Hash::check($request->new_password, $user->password)) {
            return [
                'new_password'              => $msg['new_same'],
                'new_password_confirmation' => ' ',
            ];
        }

        if ($request->new_password !== $request->new_password_confirmation) {
            return [
                'new_password'              => ' ',
                'new_password_confirmation' => $msg['no_match'],
            ];
        }

        return null;
    }

    private function handleProfilePicture(UpdateProfileRequest $request, $user): void
    {
        if ($request->boolean('delete_profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->update(['profile_picture' => null]);
            return;
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->update(['profile_picture' => $path]);
        }
    }
    private function handleCoverPicture(UpdateProfileRequest $request): void
    {
        if ($request->boolean('delete_cover_picture')) {
            $current = Setting::get('cover_picture');
            if ($current) {
                Storage::disk('public')->delete($current);
            }
            Setting::set('cover_picture', null);
            return;
        }

        if ($request->hasFile('cover_picture')) {
            $current = Setting::get('cover_picture');
            if ($current) {
                Storage::disk('public')->delete($current);
            }
            $path = $request->file('cover_picture')->store('cover_pictures', 'public');
            Setting::set('cover_picture', $path);
        }
    }
}
