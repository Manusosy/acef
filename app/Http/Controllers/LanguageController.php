<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        if (array_key_exists($locale, config('languages'))) {
            Session::put('locale', $locale);
            // Also set a persistent cookie for 1 year
            cookie()->queue('locale', $locale, 60 * 24 * 365);
        }

        return Redirect::back();
    }
}
