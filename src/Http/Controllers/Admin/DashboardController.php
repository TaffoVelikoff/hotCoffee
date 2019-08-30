<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // Admin Dashboard
    public function index() {
    	
		// Display Template
		//view()->share('customPageName', 'Custom Name');
		return View('hotcoffee::admin.dashboard');
    }
}
