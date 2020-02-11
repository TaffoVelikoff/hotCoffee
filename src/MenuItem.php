<?php

namespace TaffoVelikoff\HotCoffee;

use TaffoVelikoff\HotCoffee\InfoPage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{

	use HasTranslations;

    public $childrenCount;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
	
	public $translatable = ['name'];

    /**
     * Menu relation
     */
    public function menu() {
        return $this->belongsToOne('TaffoVelikoff\HotCoffee\Menu');
    }

    /**
     * Get all children items
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
     * Get the route
     */
    public function getRoute() {
        switch ($this->type) {
            case 'nothing':
                return 'javascript:void(0);';
                break;

            case 'link':
            case 'scroll':
                return $this->url;

            case 'page':
                $page = InfoPage::find($this->page_id);
                return localeUrl($page->keyword());

            case 'route':
                return route($this->url);

            default:
                return '#';
                break;
        }
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
