<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Support\Str;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use TaffoVelikoff\HotCoffee\Traits\HasSef;
use Bnb\Laravel\Attachments\HasAttachment;

class Article extends Model
{
    use HasTranslations, HasAttachment, HasSef, Taggable;

    public $translatable = ['title', 'content', 'meta_desc'];

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'meta_desc'
    ];

    /**
     * The controller 
     *
     * @var array
     */
    public static $sef_method = 'App\Http\Controllers\Front\ArticleController@index';
}