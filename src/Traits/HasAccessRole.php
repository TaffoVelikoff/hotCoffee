<?php

namespace TaffoVelikoff\HotCoffee\Traits;

trait HasAccessRole
{
	/**
     * Get the user roles that should have access to the element
     */
    public function access_roles() {
        return $this->morphToMany(\TaffoVelikoff\HotCoffee\Role::class, 'model', 'access_roles');
    }

    /**
     * Authorize the user
     */
    public function authorizeAccess() {

        $names = $this->access_roles->map(function ($role) {
            return $role->name;
        })->toArray();

        // If model has no access roles all users (including non registered and logged in) have access
        if(!$this->access_roles->isEmpty()) {

            // If model has some access roles, that means non signed in users does not have access
            if(!auth()->user())
                abort(401, 'This action is unauthorized.');

            // Check if user has any of the assigned access roles (excluding admin role - admins always have access)
            if(auth()->user()->roles->first()->id != 1) {
                auth()->user()->authorizeRoles($names);
            }
        }
    }
}