<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
    // sementara disable schema dulu biar artisan bisa jalan
    // Schema::defaultStringLength(191);

    if (app()->environment('production')) {
        URL::forceScheme('https');
    }

    if (env('APP_MAINTENANCE') === 'true') {
        if (!$request->is('admin*')) {
            abort(response()->view('maintenance.maintenance', [], 503));
        }
    }
}

