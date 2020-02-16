<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use TaffoVelikoff\HotCoffee\Traits\HasSef;
use TaffoVelikoff\HotCoffee\Traits\HasAccessRole;
use TaffoVelikoff\HotCoffee\Traits\HasAttachment;

class InfoPage extends Model
{

	use HasTranslations, HasAttachment, HasSef, HasAccessRole;
	
	public $translatable = ['title', 'content', 'meta_desc'];

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'key', 'roles', 'meta_desc'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'roles' => 'array',
    ];

    /**
     * Boot
     */
    public static function boot() {
        parent::boot();

        // Saving page
        static::saved(function ($info) {
            $info->access_roles()->detach();
        });

        // Deleting page
        static::deleting(function($info) {

            // Remove access roles
            $info->access_roles()->detach();

            // Remove attachments
            $info->attachments()->delete();

            // Remove sef
            $info->sef()->delete();

        });
    }
}
