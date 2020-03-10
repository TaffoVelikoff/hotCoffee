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
        
        // Display view
        return view('front.article', [
            'article'   => $article,
            'metaTitle' => $article->title,
            'metaDesc'  => $article->meta_desc
        ]);

    }
}