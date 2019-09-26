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
    public function store() {

      // Store menu item
      $item = MenuItem::create(request()->all());

      // Convert type
      if(substr(request()->url, 0, 4) === "http") {
        $item->type = 'link';
      }

      if(substr(request()->url, 0, 1) === "#") {
        $item->type = 'scroll';
      }

      if(!empty(request()->url)) {
        $item->type = 'route';
      }

      $item->save();

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
     * Delete
     *
     */
    public function destroy(MenuItem $item) {

      $item->delete();

      session()->flash('notify', array(
          'type'  => 'warning',
          'title' => __('hotcoffee::admin.success').'!',
          'message' => __('hotcoffee::admin.suc_deleted')
      ));

      return back();

    }
}
