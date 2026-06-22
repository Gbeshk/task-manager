<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{

    public function __invoke(string $locale): RedirectResponse
    {
        if (! in_array($locale, ['en', 'ka'])) {
            abort(400);
        }

        session(['locale' => $locale]);

        return back();
    }
}
