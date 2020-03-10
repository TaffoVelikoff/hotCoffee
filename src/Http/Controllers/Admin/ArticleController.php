<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\Sef;
use TaffoVelikoff\HotCoffee\Events\ArticleCreated;
use TaffoVelikoff\HotCoffee\Events\ArticleUpdated;
use TaffoVelikoff\HotCoffee\Events\ArticleDeleted;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreArticle;


class ArticleController extends Controller
{

	// Article model in use
	public $model_name;

	public function __construct() {
		$this->model_name = config('hotcoffee.articles.model');
	}

	/**
	 * Show all
	 */
	public function index() {

		// Get articles
		$articles = $this->model_name::orderBy('id', 'desc');

		if(isset(request()->tag))
			$articles->withAnyTag(request()->tag);

		$articles = $articles->paginate(settings('paginate'));

		// Display view
		return view('hotcoffee::admin.articles', [
			'customPageName' =>  __('hotcoffee::admin.articles'),
			'articles' => $articles
		]);

	}

	/**
	 * Create
	 */
	public function create() {

		// Display view
		return view('hotcoffee::admin.article', [
			'customPageName' => __('hotcoffee::admin.article_create')
		]);

	}

	/**
	 * Edit
	 */
	public function edit($id) {

		$article = $this->model_name::findOrFail($id);

		// Display view
		return view('hotcoffee::admin.article', [
			'customPageName' => __('hotcoffee::admin.article_edit'),
			'edit'	=> $article,
			'tags'	=> implode(',', $article->tagNames())
		]);

	}

	/**
	 * Store
	 *
	 */
	public function store(StoreArticle $request) {

		// Store article
		$article = $this->model_name::create(
			prepare_request($request, ['title', 'content'])
		);

		// Save tags
		$article->tag($request->tags);

		// Save custom url (SEF)
		$article->createSef($request->keyword);
		
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

		// Trigger event
		event(new ArticleCreated($article));

		return redirect()->route('hotcoffee.admin.articles.index');

	}

	/**
	 * Update
	 */
	public function update($id, StoreArticle $request) {

		$article = $this->model_name::findOrFail($id);

		// Update article page
		$article->update(
			prepare_request(
				$request, ['title', 'content', 'meta_desc']
			)
		);

		// Save custom url (SEF)
		$article->updateSef($request->keyword);

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

		// Trigger event
		event(new ArticleUpdated($article));

		return redirect()->route('hotcoffee.admin.articles.index');

	}

	/**
	 * Delete
	 *
	 */
	public function destroy($id) {

		$article = $this->model_name::findOrFail($id);
		$article->delete();

		// Trigger event
		event(new ArticleDeleted);
		
		return array(
			'type'  => 'warning',
			'title' => __('hotcoffee::admin.success').'!',
			'message' => __('hotcoffee::admin.suc_deleted')
		);
	}

}