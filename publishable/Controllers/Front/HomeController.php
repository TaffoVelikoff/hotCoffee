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
        // Get latest 3 articles
        $articles = Article::orderBy('id')->limit(3)->get();

        // Display view
        return view('front.home', compact('articles'));
    }

    /**
     * Demo internal page
     */
    public function internal() {
        return view('front.internal');
    }
}