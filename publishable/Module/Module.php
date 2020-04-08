<?php

namespace App;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Bnb\Laravel\Attachments\HasAttachment;
use TaffoVelikoff\LaravelSef\Traits\HasSef;

class Module extends Model
{
    use HasTranslations, HasAttachment, HasSef, Taggable;

    public $translatable = [''];
    protected $guarded = [''];
}