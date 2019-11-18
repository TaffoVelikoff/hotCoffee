<?php

namespace App\Http\Controllers\Front;

use URL;
use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Menu;
use TaffoVelikoff\HotCoffee\Article;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Demo front page
     */
    public function index() {
    	// Get the menu. You should move this into a Middleware so you can show your main menu on all pages.
    	view()->share('menu', Menu::where('keyword', 'main_menu')->first());

    	// Get latest 3 articles
    	view()->share('articles', Article::orderBy('id')->limit(3)->get());

    	// Display view
    	return view('front.home');
    }

    public function about() {
        dump('about');
    }
}