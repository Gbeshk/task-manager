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

    public function messages(): array
    {
        return [
            'title.en.required'       => 'English title is required.',
            'title.en.min'            => 'English title must be at least 3 characters.',
            'title.en.regex'          => 'English title must only contain English characters.',
            'title.ka.required'       => 'Georgian title is required.',
            'title.ka.min'            => 'Georgian title must be at least 3 characters.',
            'title.ka.regex'          => 'Georgian title must only contain Georgian characters.',
            'description.en.required' => 'English description is required.',
            'description.en.min'      => 'English description must be at least 3 characters.',
            'description.en.regex'    => 'English description must only contain English characters.',
            'description.ka.required' => 'Georgian description is required.',
            'description.ka.min'      => 'Georgian description must be at least 3 characters.',
            'description.ka.regex'    => 'Georgian description must only contain Georgian characters.',
            'due_date.required'       => 'Due date is required.',
            'due_date.date'           => 'Please enter a valid date.',
            'due_date.after'    => 'The due date must be a date in the future.',
        ];
    }
}
