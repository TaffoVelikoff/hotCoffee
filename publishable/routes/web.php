<?php

use Illuminate\Support\Facades\Route;
use Http\Controllers\Front\HomeController;

/**
 * ADMIN
 * Below are all custom admin routes for your application.
 */
HotCoffee::routes();

Route::group(['prefix' => config('hotcoffee.prefix'), 'middleware' => ['hotcoffee']], function () {

    // ===== ANY CUSTOM ROUTES FOR YOUR ADMIN ZONE SHOULD GO HERE ===== //

    //Route::get('/example', [ExampleController::class, 'method'])->name('admin.example');

    // Alternatively you can run "php artisan hotcoffee:publish-routes" if you prefer or need to edit
    // any of the admin routes. Read more in the documentation.

});

/**
 * FRONT
 * Below are the routes for your application. The part visible to your users/visitors (front-end).
 */

// ===== ADD YOUR ROUTES HERE ===== //
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/internal_page', [HomeController::class, 'internal'])->name('internal');

/**
 * For models with the HasSef trait. Always keep on bottom. 
 * Read more on https://github.com/TaffoVelikoff/laravel-sef
 */
Route::get('{keyword}', [TaffoVelikoff\LaravelSef\Http\Controllers\SefController::class, 'viaProperty'])->name('sef');