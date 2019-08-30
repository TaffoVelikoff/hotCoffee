<?php

namespace TaffoVelikoff\HotCoffee\Http\Middleware;

use Closure;

class Locale
{
    /**
     * This will change the locale of the app based on the url
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $prefix = substr($request->route()->getPrefix(), 1);

        ($prefix === '') ? app()->setLocale(config('app.locale')) : app()->setLocale($prefix);
        
        return $next($request);
    }
}
