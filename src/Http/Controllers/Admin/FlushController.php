<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlushController extends Controller
{
    /**
     * Flush cache
     */
    public function index() {
    	Cache::flush();

    	// Flash success message
        session()->flash('notify', array(
            'type'      => 'info',
            'message'   => __('hotcoffee::admin.cache_cleared')
        ));

    	return back();
    }
}
