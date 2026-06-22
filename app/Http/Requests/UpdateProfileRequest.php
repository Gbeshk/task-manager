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
}
