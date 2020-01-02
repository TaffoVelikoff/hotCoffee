<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Validation\Rule;
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

    // Views
    public $edit_view = 'hotcoffee::admin.user';
    public $index_view = 'hotcoffee::admin.users';

    // Messages
    public $update_success_message = 'hotcoffee::admin.user_update_suc';
    public $create_success_message = 'hotcoffee::admin.user_create_suc';

    //===== ROLES =====//

    /**
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
    * @param array $roles
    */
    public function hasAnyRole($roles) {
        return null !== $this->roles->whereIn('name', $roles)->first();
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role) {
        return null !== $this->roles->where('name', $role)->first();
    }

    //===== RELATIONS =====//

    /**
     * Roles
     */
    public function roles() {
        return $this->belongsToMany('TaffoVelikoff\HotCoffee\Role');
    }

    /**
     * User Address
     */
    public function address() {
        return $this->hasOne(config('hotcoffee.custom_user_address_namespace'));
    }

    //===== SETTERS =====//

    /**
     * Password hasher
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    //===== VALIDATIONS ====//
    public static function validationRulesForAdmin() {
        $rules = [
            'name'      => 'required|min:3|max:18',
            'email'     => 'required|without_spaces|email',
            'city'      => 'max:32',
            'country'   => 'max:32',
            'company'   => 'max:48',
            'bio'       => 'max:64',
            'role'      => 'required',
        ];

        if(request()->edit && request()->edit == 1) {
            $rules['role'] = '';
        }

        if(request()->edit) {
            $rules['password'] = 'sometimes|nullable|confirmed|min:6';
        }

        if(!request()->edit) {
             $rules['password'] = 'required|confirmed|min:6';
        }

        if(!request()->edit) {
            $rules['email'] = 'unique:users,email|required|without_spaces|email';
        }

        if(request()->edit) {
            $rules['email'] = Rule::unique('users')->ignore(request()->edit).'|email';
        }

        return $rules;
    }

    public static function validationMessagesForAdmin() {
        return [];
    }

    //===== SAVE & UPDATE MODEL VIA ADMIN =====//

    /**
     *
     *
     */
    public function additionalCreatesViaAdmin($request) {

        // Update roles
        $this->updateRole($request);

        // Attach avatar
        $this->attachAvatar($request);

        // Verify user
        $this->markEmailAsVerified();

    }

    /**
     * You can re-define this method in your App/User model if you need some additional custom logic
     * to be executed while updating the model via admin.
     */
    public function additionalUpdatesViaAdmin($request) {

        // Update roles
        $this->updateRole($request);

        // Attach avatar
        $this->attachAvatar($request);

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
