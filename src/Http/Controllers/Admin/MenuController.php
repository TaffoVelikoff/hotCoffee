<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Menu;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreMenu;

class MenuController extends Controller
{

    /**
     * Show all
     */
    public function index() {

      // Grab all
      $menus = Menu::orderBy('id', 'desc')->paginate(settings('paginate'));
      view()->share('menus', $menus);

      // Display view
      return view('hotcoffee::admin.menus');

    }

    /**
     * Create
     */
    public function create() {

      // Display view
      return view('hotcoffee::admin.menu');

    }

    /**
     * Edit
     */
    public function edit(Menu $menu) {

      // Get menu items
      view()->share('items', $menu->items);

      // Send menu to view
      view()->share('edit', $menu);

      // Display view
      return view('hotcoffee::admin.menu');

    }

    /**
     * Store
     *
     */
    public function store(StoreMenu $request) {

	    // Store menu
      $menu = Menu::create($request->all());

      // Flash success message
      session()->flash('notify', array(
          'type'      => 'success',
          'message'   => __('hotcoffee::admin.menu_create_suc')
      ));

      return redirect()->route('hotcoffee.admin.menus.index');

    }

    /**
     * Update
     */
    public function update(Menu $Menu, StoreMenu $request) {

      // Get the order
      parse_str($request->order, $items);

      dd($items);

      // Update info page
      //$menu->update($request->all());

      // Flash success message
      session()->flash('notify', array(
          'type'      => 'success',
          'message'   => __('hotcoffee::admin.menu_update_suc')
      ));

      return redirect()->route('hotcoffee.admin.menus.index');

    }

    /**
     * Delete
     *
     */
    public function destroy(Menu $menu) {

      $menu->delete();

      return array(
            'type'  => 'warning',
            'title' => __('hotcoffee::admin.success').'!',
            'message' => __('hotcoffee::admin.suc_deleted')
        );

    }

     // Order menu
    public function order() {
      $i = 0;

        // Re-order items and re-assign parents
        foreach ($_POST['item'] as $value=>$key) {
          
          if($key == 'null') {
            $key = 0;
          }

            DB::table('menus')->where('id', $value)->update(['ord' => $i]);
            DB::table('menus')->where('id', $value)->update(['parent' => $key]);
            $i++;
        }
    }

}
