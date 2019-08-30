<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Role;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreRole;

class RoleController extends Controller
{
    /**
     * Show all
     */
    public function index() {

    	// Get all roles
    	$roles = Role::paginate(settings('paginate'));
    	view()->share('roles', $roles);

    	// Display template
    	view()->share('customPageName', 'User Roles');
    	return view('hotcoffee::admin.roles');

    }

    /**
     * Create
     */
    public function create() {

        // Display template
        view()->share('customPageName', __('hotcoffee::admin.create_role'));
        return view('hotcoffee::admin.role');

    }

    /**
     * Edit
     */
    public function edit(Role $role) {

        // Find item
        view()->share('edit', $role);

        // Display template
        view()->share('customPageName', __('hotcoffee.admin.role_edit'));
        return view('hotcoffee::admin.role');

    }

    /**
     * Store
     *
     * @param  StoreRole  $request
     */
    public function store(StoreRole $request) {

        // Create the item
        Role::create($request->validated());

        // Flash success message
        session()->flash('notify', array(
            'type'      => 'success',
            'message'   => __('hotcoffee::admin.suc_added')
        )); 

        // Redirect back
        return redirect()->route('hotcoffee.admin.roles.index');

    }

    /**
     * Update
     *
     * @param  StoreRole  $request
     */
    public function update(Role $role, StoreRole $request) {

        // Create the item
        $role->update($request->except('name'));

        // Flash success message
        session()->flash('notify', array(
            'type'      => 'success',
            'message'   => __('hotcoffee::admin.suc_updated')
        )); 

        // Redirect back
        return redirect()->route('hotcoffee.admin.roles.index');

    }

    /**
     * Delete
     *
     * @param int $id
     * @return array
     */
    public function destroy(Role $role) {

        // Admin role can't be deleted
        if($role->id == 1) {
            return array(
                'type'  => 'danger',
                'title' => __('hotcoffee::admin.error').'!',
                'message' => __('hotcoffee::admin.err_root_del')
            );
        }

        // Delete role
        $role->delete();

        return array(
            'type'  => 'warning',
            'title' => __('hotcoffee::admin.success').'!',
            'message' => __('hotcoffee::admin.suc_deleted')
        );
    }
}
