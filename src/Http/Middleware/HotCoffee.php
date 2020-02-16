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

        // Verify admin
        $request->user()->authorizeRoles(['admin']);

        // Catch view name, default page name and auth user
        view()->composer('*', function($view){
            // Page name
            $pageName = explode('.', $view->getName());
            view()->share('pageName', end($pageName));

            // View name
            view()->share('viewName', $view->getName());
        });

        // Language
        if(session()->has('locale'))
            app()->setLocale(session('locale'));
        app()->setLocale(config('app.locale'));

        // Disabled controllers
        $action = $request->route()->getAction();
        $controller = explode('@', $action['controller']);

        if(in_array($controller[0], config('hotcoffee.disabled_controllers'))) {
            session()->flash('notify', array(
                'type'      => 'danger',
                'message'   => __('hotcoffee::admin.err_access_denied')
            )); 

            return back();
        }

        return $next($request);

    }
}
