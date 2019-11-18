<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    // Display an article
    public function index($id) {

		// Find article
		$article = Article::find($id);

		// Check if exists
		if(!$article) 
			abort(404);

		// Pass to view
		view()->share('article', $article);
		
		// Display view
		return view('front.article');

    }
}
