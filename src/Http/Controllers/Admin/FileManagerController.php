<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileManagerController extends Controller
{
    /**
     * Flush cache
     */
    public function index() {

    	// Custom page name
		view()->share('customPageName', __('hotcoffee::admin.filemanager'));

        // Display view
        return view('hotcoffee::admin.filemanager');

    }
}
