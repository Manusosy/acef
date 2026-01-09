<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent clickjacking attacks
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Enable XSS protection (legacy browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Permissions Policy (formerly Feature-Policy)
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
        
        // Content Security Policy - Only enforce in real production without Vite dev server
        // In local development, these headers block Vite, Alpine, and Tailwind, causing a broken appearance.
        if (app()->environment('production') && !file_exists(public_path('hot'))) {
            // Only set HSTS in production with HTTPS
            if ($request->secure()) {
                $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
            }

            $scriptSrc = "'self' 'unsafe-inline' 'unsafe-eval' https://www.paypal.com https://www.paypalobjects.com https://translate.google.com https://translate.googleapis.com https://unpkg.com";
            $styleSrc = "'self' 'unsafe-inline' https://fonts.googleapis.com https://translate.googleapis.com https://unpkg.com";
            $connectSrc = "'self' https://www.paypal.com https://translate.googleapis.com";
            
            $csp = implode('; ', array_filter([
                "default-src 'self'",
                "script-src $scriptSrc",
                "style-src $styleSrc",
                "font-src 'self' https://fonts.gstatic.com data:",
                "img-src 'self' data: https: blob:",
                "connect-src $connectSrc",
                "frame-src 'self' https://www.paypal.com https://www.sandbox.paypal.com https://www.youtube.com https://www.youtube-nocookie.com",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
                "upgrade-insecure-requests"
            ]));
            
            $response->headers->set('Content-Security-Policy', $csp);
        }

        return $response;
    }
}
