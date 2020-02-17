<?php

/**
 * ADMIN
 * Below are all admin routes of your application.
 */

HotCoffee::routes();

Route::group(['prefix' => config('hotcoffee.prefix'), 'middleware' => ['hotcoffee']], function () {

	// ===== ANY CUSTOM ROUTES FOR YOUR ADMIN ZONE SHOULD GO HERE ===== //

	// Dashboard
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('hotcoffee.admin.dashboard');

});

/**
 * FRONT
 * Below are the routes for the front-end of your application. The part visible to your visitors.
 */

// ===== ADD YOUR ROUTES HERE ===== //
Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('/about', 'Front\HomeController@about')->name('about');
Route::get('{keyword?}', '\TaffoVelikoff\HotCoffee\Http\Controllers\SefController@sef')->name('sef');