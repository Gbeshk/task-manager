<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'delete_profile_picture' => ['nullable', 'boolean'],
            'delete_cover_picture'   => ['nullable', 'boolean'],
            'current_password'          => ['nullable', 'string'],
            'new_password'              => ['nullable', 'string'],
            'new_password_confirmation' => ['nullable', 'string'],
            'profile_picture' => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:2048'],
            'cover_picture'   => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'profile_picture.mimes' => 'Profile picture must be an image',
            'profile_picture.max'   => 'Profile picture must be less than 2MB',
            'cover_picture.mimes'   => 'Cover picture must be an image',
            'cover_picture.max'     => 'Cover picture must be less than 2MB',
        ];
    }

    public function passwordErrors(): array
    {
        return [
            'current_missing'   => 'Please enter your current password',
            'current_incorrect' => 'Current password is incorrect',
            'new_missing'       => 'Please enter a new password',
            'new_too_short'     => 'Password must be at least 3 characters',
            'new_same'          => 'New password must be different from current password',
            'no_match'          => 'Passwords do not match',
        ];
    }
}
