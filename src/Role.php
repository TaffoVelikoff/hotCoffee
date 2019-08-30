<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	/**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

    /**
     * Relations
     */
    public function users() {
    	return $this->belongsToMany('App\User');
	}

    /**
     * Delete event
     */
    public static function boot() {
        parent::boot();

        // DELETING USER
        static::deleting(function($role) {

            $role->users()->detach();

        });
    }
}
