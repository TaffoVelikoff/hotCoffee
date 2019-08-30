<?php

namespace TaffoVelikoff\HotCoffee\Http\Middleware;

use Closure;

class DisabledControllers
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
