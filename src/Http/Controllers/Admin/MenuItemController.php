<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\MenuItem;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreMenuItem;

class MenuItemController extends Controller
{

	/**
	 * Store
	 *
	 */
	public function store(StoreMenuItem $request) {

		// Store menu item
		$item = MenuItem::create($request->all());

		// Convert type
		$item->setType(request());

		// Flash success message
		return [
			'type'      => 'success',
			'message'   => __('hotcoffee::admin.menu_create_suc'),
			'id'        => $item->id,
			'name'      => $item->name,
			'del'       => route('hotcoffee.admin.menuitems.destroy', $item)
		];

	}

	/**
	 * Edit
	 *
	 */
	public function edit($item) {
		
		return [
			'id'          => $item->id,
			'name'        => $item->getTranslations('name'),
			'url'         => $item->url,
			'icon'        => $item->icon,
			'page_id'     => $item->page_id,
			'new_window'  => $item->new_window
		];
		
	}

	/**
	 * Update
	 *
	 */
	public function update($item, StoreMenuItem $request) {
	  
		// Update item
		$item->update($request->all());

		// Disable checkbox
		if(!request()->has('new_window')) {
			$item->new_window = 0;
			$item->save();
		}

		// Convert type
		$item->setType(request());

		// Flash success message
		return [
			'type'      => 'success',
			'message'   => __('hotcoffee::admin.menu_update_suc'),
			'id'        => $item->id,
			'name'      => $item->name
		];

	}

	/**
	 * Delete
	 *
	 */
	public function destroy($item) {

		$item->delete();

		return [
			'type'  => 'warning',
			'title' => __('hotcoffee::admin.success').'!',
			'message' => __('hotcoffee::admin.suc_deleted'),
			'id'    => $item->id
		];

	}
}
