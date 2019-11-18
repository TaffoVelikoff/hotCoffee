<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileManagerController extends Controller
{
    /**
     * Flush cache
     */
    public function index() {

        // Display view
        return view('hotcoffee::admin.filemanager');

    }
}
