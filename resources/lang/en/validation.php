<?php

return [
    'required'         => 'The :attribute field is required.',
    'email'            => 'The :attribute must be a valid email address.',
    'mimes'            => 'The :attribute must be an image.',
    'date'             => 'Please enter a valid :attribute.',
    'after'            => 'The :attribute must be a date in the future.',
    'regex'            => 'The :attribute must only contain valid characters.',

    'max'              => [
        'file'   => 'The :attribute must be less than :max kilobytes (2MB).',
        'string' => 'The :attribute must not be greater than :max characters.',
    ],
    'required_with'    => 'Please enter your :attribute.',
    'current_password' => 'Current password is incorrect.',
    'min'              => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'different'        => 'The :attribute must be different from current password.',
    'confirmed'        => 'Passwords do not match.',
    'failed_login' => 'These credentials do not match our records.',
    'custom' => [
        'title' => [
            'en' => [
                'regex' => 'English title must only contain English characters.',
            ],
            'ka' => [
                'regex' => 'Georgian title must only contain Georgian characters.',
            ],
        ],
        'description' => [
            'en' => [
                'regex' => 'English description must only contain English characters.',
            ],
            'ka' => [
                'regex' => 'Georgian description must only contain Georgian characters.',
            ],
        ],
    ],

    'attributes' => [
        'email'            => 'email',
        'password'         => 'password',
        'profile_picture'  => 'profile picture',
        'cover_picture'    => 'cover picture',
        'current_password' => 'current password',
        'new_password'     => 'new password',
        'title.en'         => 'English title',
        'title.ka'         => 'Georgian title',
        'description.en'   => 'English description',
        'description.ka'   => 'Georgian description',
        'due_date'         => 'due date',
    ],
];
