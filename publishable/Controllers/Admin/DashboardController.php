<?php

namespace App\Http\Controllers\Admin;

use Cache;
use App\User;
use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Login;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // Admin Dashboard
    public function index() {

    	// Get all users
    	$users = User::orderBy('id', 'desc')->get();

    	// Count users
    	view()->share('userCount', $users->count());

    	// Latest user
    	view()->share('latestUser', $users->first());

    	// Get auth history
    	if(config('hotcoffee.auth_log') == true) {
			view()->share('authHistory', 
				Login::orderBy('id', 'desc')
				->limit(config('hotcoffee.auth_log_count'))
				->get()
			);
		}
    	
		// Display Template
		view()->share('customPageName', __('hotcoffee::admin.dashboard'));
		return View('admin.dashboard');
    }
}
