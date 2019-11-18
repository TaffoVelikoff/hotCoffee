<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\Article;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreArticle;


class ArticleController extends Controller
{

    /**
     * Show all
     */
    public function index() {

      // Get articles
      $articles = Article::orderBy('id', 'desc');

      if(isset(request()->tag))
        $articles->withAnyTag(request()->tag);

      $articles = $articles->paginate(settings('paginate'));
      view()->share('articles', $articles);

    	// Display view
      return view('hotcoffee::admin.articles');

    }

    /**
     * Create
     */
    public function create() {

      // Get all tags
      view()->share('allTags', Article::existingTags());

      // Display view
      return view('hotcoffee::admin.article');

    }

    /**
     * Edit
     */
    public function edit(Article $article) {
      
      // Get all tags
      view()->share('allTags', Article::existingTags());

      // Send article to view
      view()->share('edit', $article);

      // Get tags
      view()->share('tags', implode(',', $article->tagNames()));

      // Display view
      return view('hotcoffee::admin.article');

    }

    /**
     * Store
     *
     */
    public function store(StoreArticle $request) {

      // Store article
      $article = Article::create(
          prepare_request(
            $request, ['title', 'content']
          )
      );

      // Save tags
      $article->tag($request->tags);

      // Save custom url (SEF)
      $article->saveSef($request->keyword);
      
      // Attach pictures
      if($request->file('images')) {
          foreach($request->file('images') as $file) {
            $article->attach($file, ['group' => 'images']); 
          }
      }
      
      // Flash success message
      session()->flash('notify', array(
          'type'      => 'success',
          'message'   => __('hotcoffee::admin.article_create_suc')
      ));

      return redirect()->route('hotcoffee.admin.articles.index');

    }

    /**
     * Update
     */
    public function update(Article $article, StoreArticle $request) {

      // Update article page
      $article->update(
          prepare_request(
            $request, ['title', 'content', 'meta_desc']
          )
      );

      // Save custom url (SEF)
      $article->saveSef($request->keyword);

      // Retag
      $article->retag($request->tags);

      // Attach pictures
      if($request->file('images')) {
          foreach($request->file('images') as $file) {
            $article->attach($file, ['group' => 'images']); 
          }
      }
      
      // Flash success message
      session()->flash('notify', array(
          'type'      => 'success',
          'message'   => __('hotcoffee::admin.article_update_suc')
      ));

      return redirect()->route('hotcoffee.admin.articles.index');

    }

    /**
     * Delete
     *
     */
    public function destroy(Article $article) {

        $article->delete();

        return array(
            'type'  => 'warning',
            'title' => __('hotcoffee::admin.success').'!',
            'message' => __('hotcoffee::admin.suc_deleted')
        );
    }

}
