<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        $hasRole = false;
        
        foreach ($roles as $role) {
            if ($role === 'admin') {
                if ($user->isAdmin()) {
                    $hasRole = true;
                    break;
                }
            } elseif ($role === 'country_coordinator' || $role === 'coordinator') {
                if ($user->isCoordinator()) {
                    $hasRole = true;
                    break;
                }
            } else {
                if ($user->role && $user->role->slug === $role) {
                    $hasRole = true;
                    break;
                }
            }
        }

        if (!$hasRole) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
