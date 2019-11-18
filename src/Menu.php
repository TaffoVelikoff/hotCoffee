<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Bnb\Laravel\Attachments\HasAttachment;

class Menu extends Model
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
    public function items() {
        return $this->hasMany('TaffoVelikoff\HotCoffee\MenuItem')->orderBy('ord', 'asc');
    }

    /**
     * Get only root items
     */
    public function getRootItems() {
        return $this->items->where('parent', 0);
    }

    /**
     * Delete event
     */
    public static function boot() {
        parent::boot();

        // DELETING Menu
        static::deleting(function($info) {

            //

        });
    }
}
