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

        $sef = Sef::where('keyword', $request->route()->parameters['keyword'])->first();

        // Check if url exists
        if(!$sef) abort(404);

        if(!isset($sef->model_type::$sef_method))
            abort(404);

        return app()->call($sef->model_type::$sef_method, ['id' => $sef->model_id]);
        
    }

}