<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Menu relation
     */
    public function menu() {
        return $this->belongsToOne('TaffoVelikoff\HotCoffee\Menu');
    }

    /**
     * Children
     */
    public function children() {
        return MenuItem::where('parent', $this->id)->get();
    }

    /**
     * Delete event
     */
    public static function boot() {
        parent::boot();

        // DELETING Menu item
        static::deleting(function($info) {

            //

        });
    }
}
