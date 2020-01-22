<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;


use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\Settings;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreSettings;

class SettingsController extends Controller
{
    /**
     * Display the settings page
     */
    public function index() {

    	// Timezones
		view()->share('timezones', DateTimeZone::listIdentifiers(DateTimeZone::ALL));

        // Custom page name
        view()->share('customPageName', __('hotcoffee::admin.settings'));
    	
    	// Display view
        return view('hotcoffee::admin.settings');
    }

    /**
     * Update settings
     */
    public function update(Settings $settings, StoreSettings $request) {
        
    	$settings->put(array_merge($request->except('_token'), grab_empty_checkboxes()));

    	// Flash success message
        session()->flash('notify', array(
            'type'      => 'success',
            'message'   => __('hotcoffee::admin.suc_settings_saved')
        )); 

        // Redirect back
        return redirect()->route('hotcoffee.admin.settings.index');
    }
}
