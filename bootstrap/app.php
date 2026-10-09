<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;   // 👈 ADD THIS LINE at the top


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

        using: function () {

            Route::aliasMiddleware('adminauth', AdminAuth::class);
  
            // ✅ Normal website routes (sessions, CSRF, views)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // ✅ CCAvenue routes (NO middleware, NO CSRF)
            Route::middleware([])
                ->group(base_path('routes/ccavenue.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
          $middleware->redirectGuestsTo(fn (Request $request) => route('admin.login'));

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
