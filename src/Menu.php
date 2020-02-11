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
     * Boot
     */
    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->removeFromCache();
        });

        static::deleted(function ($model) {
            $model->removeFromCache();
        });
    }

    /**
     * Menu relation
     */
    public function items() {
        return $this->hasMany('TaffoVelikoff\HotCoffee\MenuItem')->orderBy('ord', 'asc');
    }

    /**
     * Get only root items (parent items)
     */
    public function rootItems() {
        return $this->items->where('parent', 0);
    }

    /**
     * Remove a menu from application cache
     */
    public function removeFromCache() {
        \Cache::forget('hotcoffee_menu_'.$this->keyword);
    }
}
