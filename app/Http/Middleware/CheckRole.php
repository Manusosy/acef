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
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        $hasRole = false;
        
        if ($role === 'admin') {
            $hasRole = $user->isAdmin();
        } elseif ($role === 'country_coordinator' || $role === 'coordinator') {
            $hasRole = $user->isCoordinator();
        } else {
            $hasRole = $user->role && $user->role->slug === $role;
        }

        if (!$hasRole) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
