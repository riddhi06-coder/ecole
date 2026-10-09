<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        // If admin session missing → redirect to login
        if (!Session::has('admin')) {

            // destroy any old session
            Session::flush();

            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

