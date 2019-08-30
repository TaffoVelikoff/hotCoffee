<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use TaffoVelikoff\HotCoffee\Role;
use App\Http\Controllers\Controller;
use TaffoVelikoff\HotCoffee\UserAddress;
use TaffoVelikoff\HotCoffee\Http\Requests\Admin\StoreUser;

class UserController extends Controller
{
    /**
     * Show all
     */
    public function index() {

        // All users
        $users = User::paginate(settings('paginate'));
        view()->share('users', $users);

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
    public function edit(User $user) {

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
        $user = User::create($request->all());
        $user->address()->create([
            'user_id' => $user->id,
        ]);

        // Set role
        if(isset($request->role) && $user->id != 1) {
            $user->roles()->sync($request->role);
        }

        // Attach avatar
        if($request->file || $user->attachmentsGroup('avatar')->isEmpty() == false) {
            $user->croppieAttach($request->imagebase64, 'avatar', [600, 600]);
        }

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
    public function update(User $user, StoreUser $request) {

        // Update user
        (empty($request->get('password'))) ? $user->update($request->except('password')) : $user->update($request->all());
        $user->address->update($request->all());

        // Update role
        if(isset($request->role) && $user->id != 1) {
            $user->roles()->sync($request->role);
        }

        // Attach avatar
        if($request->file || $user->attachmentsGroup('avatar')->isEmpty() == false) {
            $user->croppieAttach($request->imagebase64, 'avatar', [600, 600]);
        }

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
    public function destroy(User $user) {

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
