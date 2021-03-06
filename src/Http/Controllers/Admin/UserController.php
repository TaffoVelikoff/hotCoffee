<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Role;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreUser;

class UserController extends Controller
{
    /**
     * Show all
     */
    public function index() {

        // All users
        $users = config('hotcoffee.users.model')::paginate(settings('paginate'));
        view()->share('users', $users);

        // Custom page name
        view()->share('customPageName', __('hotcoffee::admin.users'));

    	// Display view
        return view('hotcoffee::admin.users');

    }

    /**
     * Create
     */
    public function create() {

    	// Get all roles
        view()->share('roles', Role::all());

        // Display view
        view()->share('customPageName', __('hotcoffee::admin.user_create'));
        return view('hotcoffee::admin.user');

    }

    /**
     * Edit
     */
    public function edit($id) {

        $user = config('hotcoffee.users.model')::findOrfail($id);

        // Send user view
        view()->share('edit', $user);

    	// Get profile pic
    	$avatar = $user->attachmentsGroup('avatar')->first();
    	view()->share('avatar', $avatar);

        // Get all roles
        view()->share('roles', Role::all());

		// Display view
		view()->share('customPageName', __('hotcoffee::admin.user_edit'));
		return view('hotcoffee::admin.user');

    }

    /**
     * Store
     *
     * @param  StoreUser  $request
     */
    public function store(StoreUser $request) {

        // Store user
        $user = config('hotcoffee.users.model')::create($request->all());

        $user->address()->create(array_merge(
            ['user_id' => $user->id],
            $request->all()
        ));

        // Update roles
        $user->updateRole($request);

        // Attach avatar
        $user->attachAvatar($request);

        $user->markEmailAsVerified();

        // Flash success message
        session()->flash('notify', array(
            'type'      => 'success',
            'message'   => __('hotcoffee::admin.user_create_suc')
        ));

        return redirect()->route('hotcoffee.admin.users.index');

    }

    /**
     * Update
     *
     * @param  StoreUser  $request
     */
    public function update($id, StoreUser $request) {

        $user = config('hotcoffee.users.model')::findOrfail($id);

        // Update user
        (empty($request->get('password'))) ? $user->update($request->except('password')) : $user->update($request->all());

        // Update user address
        $user->address->update($request->all());

        // Update roles
        $user->updateRole($request);

        // Attach avatar
        $user->attachAvatar($request);

        // Flash success message
        session()->flash('notify', array(
            'type'      => 'success',
            'message'   => __('hotcoffee::admin.user_update_suc')
        ));

        return back();

    }

    /**
     * Delete
     *
     * @param int $user
     * @return array
     */
    public function destroy($id) {

        $user = config('hotcoffee.users.model')::findOrfail($id);
        
        // Root admin can't be deleted
        if($user->id == 1) {
            return array(
                'type'  => 'danger',
                'title' => __('hotcoffee::admin.error').'!',
                'message' => __('hotcoffee::admin.err_root_del')
            );
        }

        // Delete user
        $user->delete();

        return array(
            'type'  => 'warning',
            'title' => __('hotcoffee::admin.success').'!',
            'message' => __('hotcoffee::admin.suc_deleted')
        );
    }
}