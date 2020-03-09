<?php

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
| Configuration concerning the users.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | User Address Model
    |--------------------------------------------------------------------------
    | This allows to extend the model.
    |
    */

    'model'    => \TaffoVelikoff\HotCoffee\UserAddress::class, // \App\UserAddress

    /**
    | UI
    | You can hide parts of the original template.
    |
    */

    'sidebar'       => true,
    'contact_info'  => true,

    /*
    |--------------------------------------------------------------------------
    | Additional validation rules
    |--------------------------------------------------------------------------
    | Any additional validation rules and messages when updating or creating
    | user. You can also overwrite the defaults.
    */

    'validations' => [
        'normal'    => [
            //'myfield' => 'required', //- this will add a new validation for "myfield".
        ],
        'translatable'  => [],
    ],

    'messages' => [
        'normal'    => [
            //'myfield.required' => 'My custom message.',
        ],
        'translatable'  => [],
    ],
];