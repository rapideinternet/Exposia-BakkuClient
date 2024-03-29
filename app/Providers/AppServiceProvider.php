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
        // Force HTTPS in production environment only for Docker + Caddy (uncomment if needed)
//        if ($this->app->environment('production')) {
//            \URL::forceScheme('https');
//        }
    }
}
