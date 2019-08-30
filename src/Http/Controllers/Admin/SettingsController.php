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
    	
    	// Display view
        return view('hotcoffee::admin.settings');
    }

    /**
     * Update settings
     */
    public function update(Settings $settings, StoreSettings $request) {
    	$settings->put([
    		'mail' 					=> $request->mail,
    		'support_mail'			=> $request->support_mail,
    		'website_name'			=> $request->website_name,
    		'website_description'	=> $request->website_description,
    		'paginate'				=> $request->paginate,
    		'date_format'			=> $request->date_format,
    		'timezone'				=> $request->timezone
    	]);

    	// Flash success message
        session()->flash('notify', array(
            'type'      => 'success',
            'message'   => __('hotcoffee::admin.suc_settings_saved')
        )); 

        // Redirect back
        return redirect()->route('hotcoffee.admin.settings.index');
    }
}
