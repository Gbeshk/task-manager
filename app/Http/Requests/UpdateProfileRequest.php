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
            'new_password_confirmation' => ['nullable', 'string'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password'     => ['nullable', 'min:3', 'confirmed', 'different:current_password'],
            'profile_picture'  => ['nullable', 'image', 'max:2048'],
        ];
    }
}
