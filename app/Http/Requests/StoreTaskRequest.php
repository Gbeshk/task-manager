<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $englishOnly = '/^[A-Za-z0-9\s.,!?\'\-:;()]+$/u';
        $georgianOnly = '/^[\x{10A0}-\x{10FF}0-9\s.,!?\'\-:;()]+$/u';

        return [
            'title_en' => ['required', 'string', 'min:3', 'max:255', 'regex:' . $englishOnly],
            'title_ka' => ['required', 'string', 'min:3', 'max:255', 'regex:' . $georgianOnly],

            'description_en' => ['required', 'string', 'min:3', 'regex:' . $englishOnly],
            'description_ka' => ['required', 'string', 'min:3', 'regex:' . $georgianOnly],

            'due_date' => ['required', 'date_format:d/m/y'],
        ];
    }

    public function messages(): array
    {
        return [
            'title_en.required' => 'English title is required.',
            'title_en.min' => 'English title must be at least 3 characters.',
            'title_en.regex' => 'English title must only contain English characters.',

            'title_ka.required' => 'Georgian title is required.',
            'title_ka.min' => 'Georgian title must be at least 3 characters.',
            'title_ka.regex' => 'Georgian title must only contain Georgian characters.',

            'description_en.required' => 'English description is required.',
            'description_en.min' => 'English description must be at least 3 characters.',
            'description_en.regex' => 'English description must only contain English characters.',

            'description_ka.required' => 'Georgian description is required.',
            'description_ka.min' => 'Georgian description must be at least 3 characters.',
            'description_ka.regex' => 'Georgian description must only contain Georgian characters.',

            'due_date.required' => 'Due date is required.',
            'due_date.date_format' => 'Due date must be in DD/MM/YY format.',
        ];
    }
    public function prepareForValidation(): void {}

    protected function passedValidation(): void
    {
        $this->merge([
            'due_date' => Carbon::createFromFormat('d/m/y', $this->input('due_date')),
        ]);
    }
}
