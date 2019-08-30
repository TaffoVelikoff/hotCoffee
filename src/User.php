<?php

namespace TaffoVelikoff\HotCoffee;

use TaffoVelikoff\HotCoffee\Traits\HasCroppieAttachment;
use Illuminate\Notifications\Notifiable;
use Bnb\Laravel\Attachments\HasAttachment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasCroppieAttachment, HasAttachment;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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
        return $this->hasOne('TaffoVelikoff\HotCoffee\UserAddress');
    }

    //===== SETTERS =====//

    /**
     * Password hasher
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
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
