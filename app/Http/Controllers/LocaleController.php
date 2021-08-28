<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function setLocale($locale)
    {
        if (!in_array($locale, config('language.lang', ['en']))) {
            return response(null, 400);
        }

        session()->put('my_locale', $locale);

        return redirect()->back();
    }
}
