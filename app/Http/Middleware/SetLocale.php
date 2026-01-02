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
        // Get locale from session or cookie, fallback to app default
        $locale = Session::get('locale') ?? $request->cookie('locale') ?? config('app.locale');

        // Validate locale exists in languages config
        if ($locale && array_key_exists($locale, config('languages'))) {
            App::setLocale($locale);
            
            // Store in session if not already there
            if (!Session::has('locale')) {
                Session::put('locale', $locale);
            }
        } else {
            // If invalid locale, use app default
            $defaultLocale = config('app.locale');
            App::setLocale($defaultLocale);
            Session::put('locale', $defaultLocale);
        }

        return $next($request);
    }
}
