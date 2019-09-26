<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\InfoPage;

class SefController extends Controller
{
	public $path;

	public function __construct() {
		$this->path = 'TaffoVelikoff\HotCoffee\Http\Controllers';
	}

    // 
    public function index() {

    	$id = 900;
    	$model = 'App\\InfoPage';

    	$sefModels = array(
			'App\\InfoPage' => ['controller' => 'TaffoVelikoff\HotCoffee\Http\Controllers\TestController', 'method' => 'test2'],
			'App\\MusicRelease' => ['controller' => 'TaffoVelikoff\HotCoffee\Http\Controllers\TestController', 'method' => 'test3'],
    	);

    	if(array_key_exists($model, $sefModels)) {
    		return app()->call($sefModels[$model]['controller'].'@'.$sefModels[$model]['method'], ['id'	=> $id]);
    	} else {
    		abort(404);
    	}
    	
    }
}