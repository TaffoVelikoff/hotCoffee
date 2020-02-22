<?php

/*
|--------------------------------------------------------------------------
| Info Pages
|--------------------------------------------------------------------------
| Configuration concerning the info pages.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Page groups
    |--------------------------------------------------------------------------
    |
    | Also called page key. You can use this to group your info pages.
    | For example you might want to create a submenu somewhere in your website,
    | like for a FAQ. You can then search for the related info page by key.
    |
    */

    'groups' => [
        'default' => 'default group',
    ],

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    | This allows to extend the model.
    |
    */
    'model' => \TaffoVelikoff\HotCoffee\InfoPage::class,

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
];