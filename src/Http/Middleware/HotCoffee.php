<?php

namespace TaffoVelikoff\HotCoffee\Http\Middleware;

use Closure;

class HotCoffee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // hotCoffee info
        view()->share('hotcoffee',[
            'name'          => 'hotCoffee Admin',
            'author'        => 'Taffo Velikoff',
            'authorUrl'     => 'http://taffovelikoff.com',
            'description'   => 'A simple laravel admin panel to kick start your freelance projects.',
            'company'       => 'TAVVO Ltd',
            'version'       => '0.1'
        ]);

        // Catch view name, default page name and auth user
        view()->composer('*', function($view){
            // Page name
            $pageName = explode('.', $view->getName());
            view()->share('pageName', end($pageName));

            // View name
            view()->share('viewName', $view->getName());
        });

        return $next($request);

    }
}
