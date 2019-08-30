<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'TaffoVelikoff\HotCoffee\Http\Controllers'], function () {
	Route::group(['middleware' => ['web', 'hotcoffee']], function () {

		//===== RESOURRCES =====//
		Route::get('/coffee_assets/{asset}', 'ResourceController@resource')->where('asset', '.*')->name('hotcoffee.assets');

		//===== THUMBNAILER =====//
		Route::get('/img/{path}', 'ThumbnailController@show')->where('path', '.*')->name('hotcoffee.thumbnail');

		//===== ADMIN =====//
		Route::group(['prefix' => config('hotcoffee.prefix')], function () {

			// NO AUTH
			Route::get('/', 'Admin\SessionController@index');
			Route::get('/login', 'Admin\SessionController@index')->name('hotcoffee.admin.login');
			Route::post('/auth', 'Admin\SessionController@authenticate')->name('hotcoffee.admin.auth');

			// AUTH
			Route::group(['middleware' => array('hotcoffee.auth', 'hotcoffee.admin', 'hotcoffee.controllers', 'verified')], function () {

				// Dashboard
				Route::get('/dashboard', 'Admin\DashboardController@index')->name('hotcoffee.admin.dashboard');

				// Users
				Route::group(['prefix' => 'infopages'], function () {
					Route::get('/', 'Admin\InfoPageController@index')->name('hotcoffee.admin.infopages.index');

					Route::get('/create', 'Admin\InfoPageController@create')->name('hotcoffee.admin.infopages.create');
					Route::post('/', 'Admin\InfoPageController@store')->name('hotcoffee.admin.infopages.store');

					Route::get('/{info}', 'Admin\InfoPageController@edit')->name('hotcoffee.admin.infopages.edit');
					Route::post('/{info}', 'Admin\InfoPageController@update')->name('hotcoffee.admin.infopages.update');

					Route::delete('/{info}', 'Admin\InfoPageController@destroy')->name('hotcoffee.admin.infopages.destroy');
				});

				// Users
				Route::group(['prefix' => 'users'], function () {
					Route::get('/', 'Admin\UserController@index')->name('hotcoffee.admin.users.index');

					Route::get('/create', 'Admin\UserController@create')->name('hotcoffee.admin.users.create');
					Route::post('/', 'Admin\UserController@store')->name('hotcoffee.admin.users.store');

					Route::get('/{user}', 'Admin\UserController@edit')->name('hotcoffee.admin.users.edit');
					Route::post('/{user}', 'Admin\UserController@update')->name('hotcoffee.admin.users.update');

					Route::delete('/{user}', 'Admin\UserController@destroy')->name('hotcoffee.admin.users.destroy');
				});

				// User roles
				Route::group(['prefix' => 'roles'], function () {
					Route::get('/', 'Admin\RoleController@index')->name('hotcoffee.admin.roles.index');

					Route::get('/create', 'Admin\RoleController@create')->name('hotcoffee.admin.roles.create');
					Route::post('/', 'Admin\RoleController@store')->name('hotcoffee.admin.roles.store');

					Route::get('/{role}', 'Admin\RoleController@edit')->name('hotcoffee.admin.roles.edit');
					Route::post('/{role}', 'Admin\RoleController@update')->name('hotcoffee.admin.roles.update');

					Route::delete('/{role}', 'Admin\RoleController@destroy')->name('hotcoffee.admin.roles.destroy');
				});

				// Attachments
				Route::group(['prefix' => 'attachments'], function () {
					Route::get('/{id}/delete', 'Admin\AttachmentController@destroy')->name('hotcoffee.admin.attachments.destroy');
				});

				// Settings
				Route::group(['prefix' => 'settings'], function () {
					Route::get('/', 'Admin\SettingsController@index')->name('hotcoffee.admin.settings.index');
					Route::post('/', 'Admin\SettingsController@update')->name('hotcoffee.admin.settings.update');
				});

				// Export
				Route::group(['prefix' => 'export'], function () {
					Route::get('/', 'Admin\ExportController@index')->name('hotcoffee.admin.export.index');
					Route::post('/', 'Admin\ExportController@export')->name('hotcoffee.admin.export.export');
				});

				// Clear cache
				Route::get('/flush', 'Admin\FlushController@index')->name('hotcoffee.admin.flush');

				// Logout
				Route::get('/logout', 'Admin\SessionController@logout')->name('hotcoffee.admin.logout');;

			});

		});
	});
});

//===== FRONT =====//
Route::group(['namespace' => 'TaffoVelikoff\HotCoffee\Http\Controllers'], function () {
	$locales = array_merge(array_keys(config('hotcoffee.languages')), ['']);

	foreach ($locales as $locale) {

		Route::prefix($locale)->group(function () {
			Route::group(['middleware' => ['hotcoffee.locale']], function () {
				//Route::get('', 'Front\HomeController@index')->name('home');
				//Route::get('/home', 'Front\HomeController@index')->name('home');

				//===== URL MAPPER / SEF CONTROLLER =====//
				Route::get('/{keyword}', 'SefController@index');
			});
		});
	
	}
});