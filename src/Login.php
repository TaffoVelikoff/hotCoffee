<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'user_name', 'user_email', 'ip'];

    /**
     * User relationship
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
