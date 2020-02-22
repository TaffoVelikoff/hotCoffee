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
];