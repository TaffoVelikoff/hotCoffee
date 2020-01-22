<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Image;
use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Role;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\InfoPage;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreInfoPage;


class InfoPageController extends Controller
{

    /**
     * Show all
     */
    public function index() {

      $infos = InfoPage::orderBy('id', 'desc')->paginate(settings('paginate'));
      view()->share('infos', $infos);

      // Custom page name
      view()->share('customPageName', __('hotcoffee::admin.infopages'));

    	// Display view
      return view('hotcoffee::admin.infopages');

    }

    /**
     * Create
     */
    public function create() {

      // All roles
      view()->share('roles', Role::all());

      // Custom page name
      view()->share('customPageName', __('hotcoffee::admin.page_create'));

    	// Display view
      return view('hotcoffee::admin.infopage');

    }

    /**
     * Edit
     */
    public function edit(InfoPage $info) {

      // All roles
      view()->share('roles', Role::all());
      
      // Send info page to view
      view()->share('edit', $info);

      // Custom page name
      view()->share('customPageName', __('hotcoffee::admin.page_edit'));

      // Display view
      return view('hotcoffee::admin.infopage');

    }

    /**
     * Store
     *
     */
    public function store(StoreInfoPage $request) {

	    // Store info page
      $info = InfoPage::create(
          prepare_request(
            $request, ['title', 'content'], 
            ($request->roles) ? ['roles' => $request->roles] : ['roles'  => null]
          )
      );

      // Save custom url (SEF)
      $info->saveSef($request->keyword);

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

      return redirect()->route('hotcoffee.admin.infopages.index');

    }

    /**
     * Update
     */
    public function update(InfoPage $info, StoreInfoPage $request) {

      // Update info page
      $info->update(
          prepare_request(
            $request, ['title', 'content', 'meta_desc'],
            ($request->roles) ? ['roles' => $request->roles] : ['roles'  => null]
          )
      );

      // Save custom url (SEF)
      $info->saveSef($request->keyword);

      // Attach pictures
      if($request->file('images')) {
          foreach($request->file('images') as $file) {
            $info->attach($file, ['group' => 'images']); 
          }
      }
      
      // Flash success message
      session()->flash('notify', array(
          'type'      => 'success',
          'message'   => __('hotcoffee::admin.page_update_suc')
      ));

      return redirect()->route('hotcoffee.admin.infopages.index');

    }

    /**
     * Delete
     *
     */
    public function destroy(InfoPage $info) {

        $info->delete();

        return array(
            'type'  => 'warning',
            'title' => __('hotcoffee::admin.success').'!',
            'message' => __('hotcoffee::admin.suc_deleted')
        );

    }

}
