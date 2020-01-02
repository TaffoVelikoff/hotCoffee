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
        $user = User::create($request->all());

        $user->address()->create(array_merge(
            ['user_id' => $user->id],
            $request->all()
        ));

        // Any additional logic
        $user->additionalCreatesViaAdmin($request);

        // Flash success message
        session()->flash('notify', array(
            'type'      => 'success',
            'message'   => __($user->create_success_message)
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

        // Update user address
        $user->address->update($request->all());

        // Any additional updates
        $user->additionalUpdatesViaAdmin($request);

        // Flash success message
        session()->flash('notify', array(
            'type'      => 'success',
            'message'   => __($user->update_success_message)
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
