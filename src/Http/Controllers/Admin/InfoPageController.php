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

      $infos = $this->model_name::orderBy('id', 'desc')->paginate(settings('paginate'));
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
    public function edit($info) {

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
      $info = $this->model_name::create(
          prepare_request(
            $request, ['title', 'content']
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

      // Trigger event
      event(new InfoPageCreated($info));

      return redirect()->route('hotcoffee.admin.infopages.index');

    }

    /**
     * Update
     */
    public function update($info, StoreInfoPage $request) {

      // Update info page
      $info->update(
          prepare_request(
            $request, ['title', 'content', 'meta_desc']
          )
      );

      // Attach access roles
      $info->access_roles()->attach($request->roles);

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

      // Trigger event
      event(new InfoPageUpdated($info));

      return redirect()->route('hotcoffee.admin.infopages.index');

    }

    /**
     * Delete
     *
     */
    public function destroy($info) {

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
