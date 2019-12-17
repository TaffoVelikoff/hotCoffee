<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use TaffoVelikoff\HotCoffee\Traits\HasSef;
use TaffoVelikoff\HotCoffee\Traits\HasAttachment;

class InfoPage extends Model
{

	use HasTranslations, HasAttachment, HasSef;
	
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
     * Delete event
     */
    public static function boot() {
        parent::boot();

        // DELETING USER
        static::deleting(function($info) {

            // Remove attachments
            $info->attachments()->delete();

            // Remove sef
            $info->sef()->delete();

        });
    }
}
