<?php

/*
|--------------------------------------------------------------------------
| Article
|--------------------------------------------------------------------------
| Configuration concerning the articles.
|
*/


return [

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    | This allows to extend the model.
    |
    */
    'model' => \TaffoVelikoff\HotCoffee\Article::class,

    /*
    |--------------------------------------------------------------------------
    | Attachable images
    |--------------------------------------------------------------------------
    | When creating or editing info page you can use the WYSIWYG editor to upload 
    | images and other files (if that is enabled). However, if you have a
    | special section in yout template (for example a slider with photos)
    | the WYSIWYG becomes absolite. In this case a better way would be to use the 
    | "ATTACH IMAGES" section and create dedicated attachments. By default this 
    | option is enabled, but if you think you rather only use the WYSIWYG editor to
    | add files to an article or an info page you can disable it bellow.
    |
    */

    'image_attachments' => true,

    /*
    |--------------------------------------------------------------------------
    | Additional validation rules
    |--------------------------------------------------------------------------
    | Any additional validation rules and messages when updating or creating an
    | article. You can also overwrite the defaults.
    */

    'validations' => [
        'normal'    => [
            //'myfield' => 'required', //- this will add a new validation for "myfield".
        ],
        'translatable'  => [
            //'title' => 'max:96'// - this will overwrite the title validations.
        ],
    ],

    'messages' => [
        'normal'    => [
            //'myfield.required' => 'My custom message.',
        ],
        'translatable'  => [
            //'title.max' => 'The title for one of the languages is too long.',
        ],
    ],

];