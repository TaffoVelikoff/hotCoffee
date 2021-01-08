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
    | User Model
    |--------------------------------------------------------------------------
    | Older versions of Laravel did not ship with a "models" folder.
    | If your models are in the root of "app" and not in "app/models" you
    | can change this to "\App\User::class"
    |
    */

    'model'            => \App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | User Address Model
    |--------------------------------------------------------------------------
    | This allows to extend the user address model.
    |
    */

    'address_model'    => \TaffoVelikoff\HotCoffee\UserAddress::class, // \App\UserAddress

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