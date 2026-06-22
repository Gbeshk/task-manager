<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $englishOnly  = '/^[A-Za-z0-9\s.,!?\'\-:;()]+$/u';
        $georgianOnly = '/^[\x{10A0}-\x{10FF}0-9\s.,!?\'\-:;()]+$/u';

        return [
            'title.en'       => ['required', 'string', 'min:3', 'max:255', 'regex:' . $englishOnly],
            'title.ka'       => ['required', 'string', 'min:3', 'max:255', 'regex:' . $georgianOnly],
            'description.en' => ['required', 'string', 'min:3', 'regex:' . $englishOnly],
            'description.ka' => ['required', 'string', 'min:3', 'regex:' . $georgianOnly],
            'due_date'       => ['required', 'date', 'after:today'],
        ];
    }
}
