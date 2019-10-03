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
     * Set the correct type while storing or updating
     */
    public function setType() {

        if(!empty(request()->url)) {
            $this->type = 'route';
        }

        if(substr(request()->url, 0, 4) === "http") {
            $this->type = 'link';
        }

        if(substr(request()->url, 0, 1) === "#") {
            $this->type = 'scroll';
        }

        if(request()->page_id > 0) {
            $this->type = 'page';
        }

        $this->save();
    }

    /**
     * Delete event
     */
    public static function boot() {
        parent::boot();

        // DELETING Menu item
        static::deleting(function($item) {

            // Delete children
            foreach($item->children() as $child) {
                $child->delete();
            }

        });
    }
}
