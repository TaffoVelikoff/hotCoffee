<?php

namespace App\Http\Controllers\Admin;

use Cache;
use App\Models\User;
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
        $userCount = $users->count();

        // Latest user
        $latestUser = $users->first();

        // Get auth history
        if(config('hotcoffee.auth_log') == true) {
            view()->share('authHistory', 
                Login::orderBy('id', 'desc')
                ->limit(config('hotcoffee.auth_log_count'))
                ->get()
            );
        }
        
        // Display Template
        $customPageName = __('hotcoffee::admin.dashboard');
        return View('admin.dashboard', compact('customPageName', 'latestUser', 'userCount'));
    }
}