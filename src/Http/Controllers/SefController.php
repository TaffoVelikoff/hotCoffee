<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers;

use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Sef;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\InfoPage;
use Illuminate\Support\Facades\URL;

class SefController extends Controller
{

    // Redirect to right controller and method
    public function sef(Request $request, $locale = null, $keyword = null) {
        
        if(!isset($request->route()->parameters['keyword']))
            return app()->call('App\Http\Controllers\Front\HomeController@index');

        // If prefix is one of the language acronyms, redirect to home
        if(array_key_exists($request->route()->parameters['keyword'], config('hotcoffee.languages')))
            return app()->call('App\Http\Controllers\Front\HomeController@index');

        $sef = Sef::where('keyword', $request->route()->parameters['keyword'])->first();

        // Check if url exists
        if(!$sef) abort(404);

        $id = $sef->model_id;
        $model = $sef->model_type;

        $sefModels = config('hotcoffee.sefs');

        if(array_key_exists($model, $sefModels)) {
            return app()->call($sefModels[$model]['controller'].'@'.$sefModels[$model]['method'], ['id' => $id]);
        } else {
            abort(404);
        }
        
    }

}