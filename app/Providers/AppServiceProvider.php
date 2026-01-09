<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production') && !file_exists(public_path('hot'))) {
            // Only force HTTPS if we are not on a local development server or using a loopback host
            $host = request()->getHost();
            $isLocal = in_array($host, ['localhost', '127.0.0.1', '[::1]']) || str_starts_with($host, '192.168.') || str_starts_with($host, '10.');
            if (!$isLocal) {
                \Illuminate\Support\Facades\URL::forceScheme('https');
            }
        }

        \Illuminate\Validation\Rules\Password::defaults(function () {
            return \Illuminate\Validation\Rules\Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }
}
