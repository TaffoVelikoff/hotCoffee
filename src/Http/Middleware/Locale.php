<?php

namespace TaffoVelikoff\HotCoffee\Http\Middleware;

use Route;
use Closure;
use Illuminate\Support\Facades\URL;

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
        //dump($request->route());

        if(!isset($request->route()->parameters['keyword']))
            URL::defaults(['locale' => '']);

        if(isset($request->route()->parameters['keyword']) && array_key_exists($request->route()->parameters['keyword'], config('hotcoffee.languages'))) {
            URL::defaults(['locale' => $request->route()->parameters['keyword']]);
            app()->setLocale($request->route()->parameters['keyword']);
        }

        if(isset($request->route()->parameters['locale']) && array_key_exists($request->route()->parameters['locale'], config('hotcoffee.languages'))) {
            app()->setLocale($request->route()->parameters['locale']);
            URL::defaults(['locale' => $request->route()->parameters['locale']]);
        }
        
        return $next($request);
    }
}
