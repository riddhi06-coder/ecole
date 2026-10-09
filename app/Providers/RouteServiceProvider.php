<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    public function boot(): void
    {
        // 🚫 DO NOT call parent::boot()

        // CCAvenue callbacks – NO middleware AT ALL
        Route::group([], base_path('routes/ccavenue.php'));

        // Load normal Laravel routes
        Route::middleware('web')->group(base_path('routes/web.php'));
        Route::middleware('api')->prefix('api')->group(base_path('routes/api.php'));
    }
}
