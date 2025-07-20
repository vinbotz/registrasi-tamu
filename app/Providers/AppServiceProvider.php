<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; // <- Tambahkan ini

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
    public function boot(Request $request): void
    {
        // Set default panjang string agar tidak error saat migration
        Schema::defaultStringLength(191); // <- Tambahkan ini

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        if (env('APP_MAINTENANCE') === 'true') {
            // Bolehkan akses ke halaman login atau admin tertentu (opsional)
            if (!$request->is('admin*')) {
                abort(response()->view('maintenance.maintenance', [], 503));
            }
        }
    }
}
