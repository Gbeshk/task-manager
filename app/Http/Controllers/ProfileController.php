<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $coverPicturePath = Setting::get('cover_picture');

        $coverSrc = $coverPicturePath
            ? Storage::url($coverPicturePath)
            : asset('images/defaultCover.png');

        return view('profile.edit', compact('coverSrc'));
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = auth()->user();

        if ($request->filled('new_password')) {
            $user->update(['password' => $request->new_password]);
        }

        $this->handleImageUpload(
            $request,
            'profile_picture',
            'profile_pictures',
            fn() => $user->profile_picture,
            fn($path) => $user->update(['profile_picture' => $path])
        );

        $this->handleImageUpload(
            $request,
            'cover_picture',
            'cover_pictures',
            fn() => Setting::get('cover_picture'),
            fn($path) => Setting::set('cover_picture', $path)
        );

        return redirect()->route('profile.edit')->with('success', __('messages.profile_updated_success'));
    }


    private function handleImageUpload(
        UpdateProfileRequest $request,
        string $inputName,
        string $storageDir,
        callable $getCurrentPath,
        callable $savePath
    ): void {
        if ($request->boolean("delete_{$inputName}")) {
            $currentPath = $getCurrentPath();
            if ($currentPath) {
                Storage::disk('public')->delete($currentPath);
            }
            $savePath(null);
            return;
        }

        if ($request->hasFile($inputName)) {
            $currentPath = $getCurrentPath();
            if ($currentPath) {
                Storage::disk('public')->delete($currentPath);
            }
            $newPath = $request->file($inputName)->store($storageDir, 'public');
            $savePath($newPath);
        }
    }
}
