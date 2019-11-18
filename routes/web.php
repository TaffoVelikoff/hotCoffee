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

		//=====  File manager =====//
		Route::group(['middleware' => 'hotcoffee.auth'], function () {
			Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show')->name('hotcoffee.filemanager');;
			Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
		});

		//===== ADMIN =====//
		Route::group(['prefix' => config('hotcoffee.prefix')], function () {

			// NO AUTH
			Route::get('/', 'Admin\AuthController@index');
			Route::get('/login', 'Admin\AuthController@index')->name('hotcoffee.admin.login');
			Route::post('/auth', 'Admin\AuthController@authenticate')->name('hotcoffee.admin.auth');

			// AUTH
			Route::group(['middleware' => array('hotcoffee.auth', 'hotcoffee.admin', 'hotcoffee.controllers', 'verified')], function () {

				// Articles
				Route::group(['prefix' => 'article'], function () {
					Route::get('/', 'Admin\ArticleController@index')->name('hotcoffee.admin.articles.index');

					Route::get('/create', 'Admin\ArticleController@create')->name('hotcoffee.admin.articles.create');
					Route::post('/', 'Admin\ArticleController@store')->name('hotcoffee.admin.articles.store');

					Route::get('/{article}', 'Admin\ArticleController@edit')->name('hotcoffee.admin.articles.edit');
					Route::post('/{article}', 'Admin\ArticleController@update')->name('hotcoffee.admin.articles.update');

					Route::delete('/{article}', 'Admin\ArticleController@destroy')->name('hotcoffee.admin.articles.destroy');
				});

				// Info pages
				Route::group(['prefix' => 'infopages'], function () {
					Route::get('/', 'Admin\InfoPageController@index')->name('hotcoffee.admin.infopages.index');

					Route::get('/create', 'Admin\InfoPageController@create')->name('hotcoffee.admin.infopages.create');
					Route::post('/', 'Admin\InfoPageController@store')->name('hotcoffee.admin.infopages.store');

					Route::get('/{info}', 'Admin\InfoPageController@edit')->name('hotcoffee.admin.infopages.edit');
					Route::post('/{info}', 'Admin\InfoPageController@update')->name('hotcoffee.admin.infopages.update');

					Route::delete('/{info}', 'Admin\InfoPageController@destroy')->name('hotcoffee.admin.infopages.destroy');
				});

				// Menus
				Route::group(['prefix' => 'menus'], function () {
					Route::get('/', 'Admin\MenuController@index')->name('hotcoffee.admin.menus.index');

					Route::get('/create', 'Admin\MenuController@create')->name('hotcoffee.admin.menus.create');
					Route::post('/', 'Admin\MenuController@store')->name('hotcoffee.admin.menus.store');

					Route::get('/{menu}', 'Admin\MenuController@edit')->name('hotcoffee.admin.menus.edit');
					Route::post('/{menu}', 'Admin\MenuController@update')->name('hotcoffee.admin.menus.update');

					Route::delete('/{menu}', 'Admin\MenuController@destroy')->name('hotcoffee.admin.menus.destroy');
				});

				// Menu items
				Route::group(['prefix' => 'menuitems'], function () {

					Route::post('/', 'Admin\MenuItemController@store')->name('hotcoffee.admin.menuitems.store');
					Route::post('/{item}', 'Admin\MenuItemController@update')->name('hotcoffee.admin.menuitems.update');

					Route::get('/{item}', 'Admin\MenuItemController@edit')->name('hotcoffee.admin.menuitems.edit');

					Route::delete('/{item}', 'Admin\MenuItemController@destroy')->name('hotcoffee.admin.menuitems.destroy');
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

				// Search
				Route::post('/search', 'Admin\SearchController@index')->name('hotcoffee.admin.search');

				// File manager
				Route::get('/filemanager', 'Admin\FileManagerController@index')->name('hotcoffee.admin.filemanager');

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

				// Change locale
				Route::get('/locale/{locale}', 'Admin\LocaleController@switch')->name('hotcoffee.admin.locale');

				// Clear cache
				Route::get('/flush', 'Admin\FlushController@cache')->name('hotcoffee.admin.flush');

				// Clear auth history
				Route::get('/clearauth', 'Admin\FlushController@history')->name('hotcoffee.admin.clearauth');

				// Logout
				Route::get('/logout', 'Admin\AuthController@logout')->name('hotcoffee.admin.logout');

			});

		});
	});
});