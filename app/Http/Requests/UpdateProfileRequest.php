<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
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

            'profile_picture' => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:2048'],
            'cover_picture'   => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:2048'],

            'current_password' => [
                'bail',
                'nullable',
                'string',
                'required_with:new_password,new_password_confirmation',
                'current_password',
            ],
            'new_password' => [
                'bail',
                'nullable',
                'string',
                'required_with:current_password,new_password_confirmation',
                'min:3',
                'different:current_password',
                'confirmed',
            ],
            'new_password_confirmation' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'profile_picture.mimes' => 'Profile picture must be an image',
            'profile_picture.max'   => 'Profile picture must be less than 2MB',
            'cover_picture.mimes'   => 'Cover picture must be an image',
            'cover_picture.max'     => 'Cover picture must be less than 2MB',

            'current_password.required_with'    => 'Please enter your current password',
            'current_password.current_password' => 'Current password is incorrect',

            'new_password.required_with' => 'Please enter a new password',
            'new_password.min'           => 'Password must be at least 3 characters',
            'new_password.different'     => 'New password must be different from current password',
            'new_password.confirmed'     => 'Passwords do not match',
        ];
    }
}
