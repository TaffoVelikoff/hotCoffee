<?php

/**
 * FRONT
 * Below are the routes for your application. The part visible to your users/visitors (front-end).
 * If you don't want to use url prefixes to set the locale or you are not going to use more than one 
 * locale you can delete everything below and declare your routes as usual. The lines below are just
 * a recommendation.
 */

Route::group(['middleware' => ['web', 'hotcoffee']], function () {
	// You can re-declare any admin routes here
	//Route::get('admin/infopages', 'Admin\InfoPageController@index')->name('hotcoffee.admin.infopages.index');
});

$routes = function () {
	// ===== ADD YOUR ROUTES HERE ===== //
	Route::get('/about', 'Front\HomeController@about')->name('about');
	Route::get('{keyword?}', '\TaffoVelikoff\HotCoffee\Http\Controllers\SefController@sef')->name('sef');
};

/**
 * The lines bellow will make each route you declared in the $routes variable also available with a locale prefix for each language. Example:
 * Route::get('/about', 'Front\HomeController@about')->name('about') will generate these routes:
 * http://app.com/about - will open with the default locale (the first one in the languages array in hotcoffee.php config file)
 * http://app.com/en/about - will open with the English locale
 * http://app.com/bg/about - will open with the Bulgarian locale (if it exists in the languages array, otherwise it will throw 404 error)
 */

Route::group(['middleware' => ['web', 'hotcoffee.locale']], $routes);
Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => ['hotcoffee.locale', 'web']], $routes);

/**
 * ADMIN
 * Below are all custom admin routes for your application.
 */
Route::group(['prefix' => config('hotcoffee.prefix')], function () {
	Route::group(['middleware' => ['web', 'hotcoffee', 'hotcoffee.auth', 'hotcoffee.admin', 'hotcoffee.controllers', 'verified']], function () {

		// ===== ANY CUSTOM ROUTES FOR YOUR ADMIN ZONE SHOULD GO HERE ===== //

		// Dashboard
		Route::get('/dashboard', 'Admin\DashboardController@index')->name('hotcoffee.admin.dashboard');

	});
});