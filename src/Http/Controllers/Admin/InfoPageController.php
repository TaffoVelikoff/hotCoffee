<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Image;
use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Role;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\Events\InfoPageCreated;
use TaffoVelikoff\HotCoffee\Events\InfoPageUpdated;
use TaffoVelikoff\HotCoffee\Events\InfoPageDeleted;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreInfoPage;
use TaffoVelikoff\HotCoffee\InfoPage;

class InfoPageController extends Controller
{

	// Info page model in use
	public $model_name;

	public function __construct() {
		$this->model_name = config('hotcoffee.infopages.model');
	}

	/**
	 * Show all
	 */
	public function index() {

		$infos = $this->model_name::orderBy('id', 'desc')
			->paginate(settings('paginate'));

		// Display view
		return view('hotcoffee::admin.infopages', [
			'infos' => $infos,
			'customPageName' => __('hotcoffee::admin.infopages')
		]);

	}

	/**
	 * Create
	 */
	public function create() {

		// Display view
		return view('hotcoffee::admin.infopage', [
			'customPageName' => __('hotcoffee::admin.page_create')
		]);

	}

	/**
	 * Edit
	 */
	public function edit($id) {

		$info = InfoPage::findOrFail($id);

		// Display view
		return view('hotcoffee::admin.infopage', [
			'edit' => $info,
			'customPageName' => __('hotcoffee::admin.page_edit')
		]);

	}

	/**
	 * Store
	 *
	 */
	public function store(StoreInfoPage $request) {

		// Store info page
		$info = $this->model_name::create(
			prepare_request($request, ['title', 'content'])
		);

		// Save custom url (SEF)
		$info->createSef($request->keyword);

		// Attach pictures
		if($request->file('images')) {
			foreach($request->file('images') as $file) {
				$info->attach($file, ['group' => 'images']); 
			}
		}

		// Flash success message
		session()->flash('notify', array(
			'type'      => 'success',
			'message'   => __('hotcoffee::admin.page_create_suc')
		));

		// Trigger event
		event(new InfoPageCreated($info));

		return redirect()->route('hotcoffee.admin.infopages.index');

	}

	/**
	 * Update
	 */
	public function update($id, StoreInfoPage $request) {

		$info = InfoPage::findOrFail($id);

		// Update info page
		$info->update(
			prepare_request($request, ['title', 'content', 'meta_desc'])
		);

		// Attach access roles
		$info->access_roles()->attach($request->roles);

		// Save custom url (SEF)
		$info->updateSef($request->keyword);

		// Attach pictures
		if($request->file('images')) {
			foreach($request->file('images') as $file) {
				$info->attach($file, ['group' => 'images']); 
			}
		}

		// Flash success message
		session()->flash('notify', array(
			'type'		=> 'success',
			'message'	=> __('hotcoffee::admin.page_update_suc')
		));

		// Trigger event
		event(new InfoPageUpdated($info));

		return redirect()->route('hotcoffee.admin.infopages.index');

	}

	/**
	 * Delete
	 *
	 */
	public function destroy($id) {

		$info = InfoPage::findOrFail($id);

		$info->delete();

		// Trigger event
		event(new InfoPageDeleted);

		return array(
			'type'  => 'warning',
			'title' => __('hotcoffee::admin.success').'!',
			'message' => __('hotcoffee::admin.suc_deleted')
		);

	}

}
