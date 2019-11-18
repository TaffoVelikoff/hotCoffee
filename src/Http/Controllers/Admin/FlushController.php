<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Cache;
use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Login;
use App\Http\Controllers\Controller;

class FlushController extends Controller
{
    /**
     * Flush cache
     */
    public function cache() {
    	Cache::flush();

    	// Flash success message
        session()->flash('notify', array(
            'type'      => 'info',
            'message'   => __('hotcoffee::admin.cache_cleared')
        ));

    	return back();
    }

    /**
     * Clear history
     */
    public function history() {
        Login::truncate();

        // Flash success message
        session()->flash('notify', array(
            'type'      => 'info',
            'message'   => __('hotcoffee::admin.clear_auth_done')
        ));

        return back();
    }
}
