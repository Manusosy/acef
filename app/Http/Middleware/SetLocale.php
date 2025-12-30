<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale') ?? $request->cookie('locale');

        if ($locale && array_key_exists($locale, config('languages'))) {
            App::setLocale($locale);
            if (!Session::has('locale')) {
                Session::put('locale', $locale);
            }
        }

        return $next($request);
    }
}
