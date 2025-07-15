<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceModeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_MAINTENANCE') === 'true') {
            return response()->view('maintenance.maintenance');
        }

        return $next($request);
    }
}
