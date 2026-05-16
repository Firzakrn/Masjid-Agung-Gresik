<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Ambil nama host yang sedang mengakses website
        $host = request()->getHost();

        // Paksa HTTPS HANYA jika URL di .env pakai HTTPS, 
        // DAN yang mengakses BUKAN localhost / 127.0.0.1
        if (str_contains(env('APP_URL'), 'https') && $host !== '127.0.0.1' && $host !== 'localhost') {
            URL::forceScheme('https');
        }
    }
}