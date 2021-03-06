<?php

namespace TaffoVelikoff\HotCoffee\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Auth extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('hotcoffee.admin.login');
        }
        
        return $next($request);
    }
}
