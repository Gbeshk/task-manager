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
            'delete_profile_picture'    => ['nullable', 'boolean'],
            'current_password'          => ['nullable', 'string'],
            'new_password'              => ['nullable', 'string'],
            'new_password_confirmation' => ['nullable', 'string'],
            'profile_picture'           => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:2048'],
        ];
    }
}
