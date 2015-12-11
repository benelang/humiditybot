<?php

namespace Humiditybot\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class SentinelAuth
{
    public function handle($request, Closure $next)
    {
        if (!Sentinel::check()) {
          return Redirect::route('login');
        }

        return $next($request);
    }
}
