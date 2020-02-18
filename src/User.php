<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use TaffoVelikoff\HotCoffee\Traits\HasAttachment;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasAttachment;

    protected $fillable = ['name', 'email', 'password', 'locale'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Admin views for model
     * The $edit_view is used when you create or adit a user.
     * The $list_view is used for listing all users.
     * You are free to overwrite these in the extended model (usually App/Users) if you
     * would like to use custom made views for the user module.
     *
     */
    public static $edit_view = 'hotcoffee::admin.user';
    public static $list_view = 'hotcoffee::admin.users';

    /**

    //===== ROLES =====//

    /**
    * Throws 401 if user doesn't have any of the roles.
    *
    * @param string|array $roles
    */
    public function authorizeRoles($roles) {

        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        }

        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    /**
    * Check multiple roles
    *
    * @param array $roles
    */
    public function hasAnyRole($roles) {
        return null !== $this->roles->whereIn('name', $roles)->first();
    }

    /**
    * Check one role
    *
    * @param string $role
    */
    public function hasRole($role) {
        return null !== $this->roles->where('name', $role)->first();
    }

    //===== RELATIONS =====//

    /**
     * Roles
     *
     */
    public function roles() {
        return $this->belongsToMany('TaffoVelikoff\HotCoffee\Role');
    }

    /**
     * User Address
     *
     */
    public function address() {
        return $this->hasOne(config('hotcoffee.custom_user_address_namespace'));
    }

    //===== SETTERS =====//

    /**
     * Password hasher
     *
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Attach avatar
     */
    public function attachAvatar($request, $dimensions = [600, 600]) {
        if($request->file || $this->attachmentsGroup('avatar')->isEmpty() == false) {
            $this->croppieAttach($request->imagebase64, 'avatar', $dimensions);
        }
    }

    /**
     * Update user role
     */
    public function updateRole($request) {
        if(isset($request->role) && $this->id != 1) {
            $this->roles()->sync($request->role);
        }
    }

    /**
     * Delete event
     */
    public static function boot() {
        parent::boot();

        // DELETING USER
        static::deleting(function($user) {

            // Detach roles
            $user->roles()->detach();

            // Remove attachments
            $user->attachments()->delete();

            // Delete user addres
            $user->address()->delete();

        });
    }
}
