<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use View;
use App\User;
use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use TaffoVelikoff\HotCoffee\Facades\HotCoffee;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

    protected $activationService;

    use AuthenticatesUsers, RegistersUsers {
        AuthenticatesUsers::redirectPath insteadof RegistersUsers;
        AuthenticatesUsers::guard insteadof RegistersUsers;
    }

    /*
     * Display login page
     */
    public function index() {

    	if(auth()->user()) {
    		return redirect()->intended('admin/dashboard');
    	}

    	return View('hotcoffee::admin.login');
    }

    /**
     * Handle an authentication attempt.
     * @param  \Illuminate\Http\Request $request
     */
    public function authenticate(Request $request) {

        // Post to session
        session()->flash('post', $request->only('email', 'remember'));

        // Validate e-mail
        $request->validate([
            'email' => 'required|max:64|email',
        ]);

        // Check for too many login attempts
        if ($this->hasTooManyLoginAttempts(request())) {
            $this->fireLockoutEvent(request());
            session()->flash('notify', array(
                'type'      => 'danger',
                'message'   => trans('hotcoffee::admin.err_attempts')
            )); 
            return back();
        }

    	// Attempt to log in
		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials, request()->remember)) {

            // Set user language
            session()->put('locale', auth()->user()->locale);

            // Display hello message
            session()->flash('notify', array(
                'type'      => 'info',
                'message'   => __('hotcoffee::admin.welcome_msg', ['app_name' => config('app.name')])
            )); 

            // Log auth
            HotCoffee::recordAuth();

            // Redirect
			return redirect()->route(config('hotcoffee.start_route'));
		}

        $this->incrementLoginAttempts(request());

		// Flash error
		session()->flash('notify', array(
            'type'      => 'danger',
			'title'		=> trans('hotcoffee::admin.oops'),
			'message'	=> trans('hotcoffee::admin.err_credentials')
		));

        return back();
    }

    /*
     * Logging out
     */
    public function logout() {
        auth()->logout();
        return redirect()->route('hotcoffee.admin.login');
    }
}
