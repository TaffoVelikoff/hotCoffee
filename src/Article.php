<?php

namespace TaffoVelikoff\HotCoffee;

use Illuminate\Support\Str;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Bnb\Laravel\Attachments\HasAttachment;
use TaffoVelikoff\LaravelSef\Traits\HasSef;

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
     * Where the SefController will redirect
     *
     * @var array
     */
    public static $sef_method = 'App\Http\Controllers\Front\ArticleController@index';

    /**
     * Boot
     */
    public static function boot() {
        parent::boot();

        // Deleting article
        static::deleting(function($article) {

            // Remove attachments
            $article->attachments()->delete();

            // Remove sef
            $article->sef()->delete();

            // Untag
            $article->untag();
        });
    }
}