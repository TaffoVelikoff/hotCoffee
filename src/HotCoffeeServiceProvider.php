<?php
	
namespace TaffoVelikoff\HotCoffee;

use Validator;
use Illuminate\Support\Facades\Route;
use TaffoVelikoff\HotCoffee\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class HotCoffeeServiceProvider extends ServiceProvider {

	public function boot() {

		// Register resources
		$this->registerResources();

		// Middlewares
		$this->registerMiddlewares();

		// Settings model
		$this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });

        // Custom validation rules
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        Route::model('info', \TaffoVelikoff\HotCoffee\InfoPage::class);
        Route::model('item', \TaffoVelikoff\HotCoffee\MenuItem::class);
		
	}

	public function register() {
		
		// Default string lenght
        Schema::defaultStringLength(191);

        $this->commands([
        	Console\MakeAdmin::class,
        	Console\DeleteUser::class,
        	Console\Install::class,
        ]);

	}

	/*
	 *	Registers views, routes, translations and all other resources
	 */
	private function registerResources() {

		// Routes
		$this->loadRoutesFrom(__DIR__.'/../routes/web.php');

		// Views
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'hotcoffee');

		// Translations
	    $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'hotcoffee');

	    // Migrations
	    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

	    // Config
	    $this->publishes([
	        __DIR__.'/../config/hotcoffee.php' => config_path('hotcoffee.php'),
	    ]);

	    // Assets
	    $this->publishes([
	        __DIR__.'/../public' => public_path('hotcoffee'),
	    ], 'assets');
	}

	/*
	 *	Registers the middlewares
	 */
	private function registerMiddlewares() {

		$this->app['router']->aliasMiddleware('hotcoffee', \TaffoVelikoff\HotCoffee\Http\Middleware\HotCoffee::class);
		$this->app['router']->aliasMiddleware('hotcoffee.auth', \TaffoVelikoff\HotCoffee\Http\Middleware\Auth::class);
		$this->app['router']->aliasMiddleware('hotcoffee.admin', \TaffoVelikoff\HotCoffee\Http\Middleware\VerifyAdmin::class);
		$this->app['router']->aliasMiddleware('hotcoffee.locale', \TaffoVelikoff\HotCoffee\Http\Middleware\Locale::class);
		$this->app['router']->aliasMiddleware('hotcoffee.controllers', \TaffoVelikoff\HotCoffee\Http\Middleware\DisabledControllers::class);
		
	}
}