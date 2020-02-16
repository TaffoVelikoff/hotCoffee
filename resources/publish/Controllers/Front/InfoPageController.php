<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\InfoPage;
use App\Http\Controllers\Controller;

class InfoPageController extends Controller
{
    // Display an info page
    public function index($id) {

		// Find page
		$page = InfoPage::find($id);

		// Check if exists
		if(!$page) 
			abort(404);

		// Authorize users
		$page->authorizeAccess();

		// Pass to view
		view()->share('page', $page);
		
		// Display view
		return view('front.infopage');

    }
}