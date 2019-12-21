<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use App\User;
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
        $users = User::paginate(settings('paginate'));
        view()->share('users', $users);

    	// Display view
        return view((new User)->index_view);

    }

    /**
     * Create
     */
    public function create() {

        // Get all user address fields
        view()->share('userAddressFields', config('hotcoffee.custom_user_address_namespace')::fields());

    	// Get all roles
        view()->share('roles', Role::all());

        // Display view
        view()->share('customPageName', __('hotcoffee::admin.user_create'));
        return view((new User)->edit_view);

    }

    /**
     * Edit
     */
    public function edit(User $user) {

        // Get all user address fields
        view()->share('userAddressFields', config('hotcoffee.custom_user_address_namespace')::fields());

        // Send user view
        view()->share('edit', $user);

    	// Get profile pic
    	$avatar = $user->attachmentsGroup('avatar')->first();
    	view()->share('avatar', $avatar);

        // Get all roles
        view()->share('roles', Role::all());

		// Display view
		view()->share('customPageName', __('hotcoffee::admin.user_edit'));
		return view($user->edit_view);

    }

    /**
     * Store
     *
     * @param  StoreUser  $request
     */
    public function store(StoreUser $request) {

        // Store user
        $user = User::create($request->only('name', 'email', 'password', 'locale'));
        $user->address()->create(array_merge(
            ['user_id' => $user->id],
            $request->only(array_keys(config('hotcoffee.custom_user_address_namespace')::fields()))
        ));

        // Set role
        if(isset($request->role) && $user->id != 1) {
            $user->roles()->sync($request->role);
        }

        // Attach avatar
        if($request->file || $user->attachmentsGroup('avatar')->isEmpty() == false) {
            $user->croppieAttach($request->imagebase64, 'avatar', $user->avatar_size);
        }

        // Verify user
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
    public function update(User $user, StoreUser $request) {
        
        // Update user
        (empty($request->get('password'))) ? $user->update($request->only('name', 'email', 'locale')) : $user->update($request->only('name', 'email', 'password', 'locale'));
        $user->address->update($request->only(array_keys(config('hotcoffee.custom_user_address_namespace')::fields())));

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
