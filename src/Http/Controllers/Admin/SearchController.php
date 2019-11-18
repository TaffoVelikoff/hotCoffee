<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use DB;
use View;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    /*
     * Display login page
     */
    public function index() {

    	$results = [];

    	$searchables = config('hotcoffee.searchables');
    	view()->share('searchables', $searchables);

    	foreach($searchables as $key=>$searchable) {
    		$query = DB::table($key);

    		foreach($searchable['fields'] as $fieldKey=>$field) {
    			if($fieldKey == 0){
    				$query = $query->where($field, 'like', '%'.request()->keyword.'%');
    			} else {
    				$query = $query->orWhere($field, 'like', '%'.request()->keyword.'%');
    			}
    		}

    		$results[$key] = $query->get();
    	}

    	// Share results to template
		view()->share('results', $results);

    	// Display template
    	return View('hotcoffee::admin.search');
    }
}