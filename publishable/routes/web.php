<?php

/**
 * ADMIN
 * Below are all custom admin routes for your application.
 */
HotCoffee::routes();

Route::group(['prefix' => config('hotcoffee.prefix'), 'middleware' => ['hotcoffee']], function () {

    // ===== ANY CUSTOM ROUTES FOR YOUR ADMIN ZONE SHOULD GO HERE ===== //

    // Dashboard
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('hotcoffee.admin.dashboard');
});

/**
 * FRONT
 * Below are the routes for your application. The part visible to your users/visitors (front-end).
 */

// ===== ADD YOUR ROUTES HERE ===== //
Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('/internal_page', 'Front\HomeController@internal')->name('internal');

/**
 * For models with the HasSef trait. Read more on https://github.com/TaffoVelikoff/laravel-sef
 */
Route::get('{keyword}', '\TaffoVelikoff\LaravelSef\Http\Controllers\SefController@viaProperty')->name('sef');