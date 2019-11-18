<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocaleController extends Controller
{

    /**
     * Switch language
     */
    public function switch($locale) {

      	if(array_key_exists($locale, config('hotcoffee.admin_languages'))){
        	session()->put('locale', $locale);
        	auth()->user()->locale = $locale;
        	auth()->user()->save();
    	}
      
      	return back();

    }

}