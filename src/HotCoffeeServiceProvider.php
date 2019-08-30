<?php
	
namespace TaffoVelikoff\HotCoffee;

use Validator;
use TaffoVelikoff\HotCoffee\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class HotCoffeeServiceProvider extends ServiceProvider {

	public function boot(\Illuminate\Routing\Router $router, \App\Http\Kernel $kernel) {

		// Routes
		$this->loadRoutesFrom(__DIR__.'/routes/web.php');

		// Views
		$this->loadViewsFrom(__DIR__.'/resources/views', 'hotcoffee');

		// Translations
	    $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'hotcoffee');

	    // Migrations
	    $this->loadMigrationsFrom(__DIR__.'/database/migrations');

	    // Config
	    $this->publishes([
	        __DIR__.'/config/hotcoffee.php' => config_path('hotcoffee.php'),
	    ]);

		// Middlewares
		$this->app['router']->aliasMiddleware('hotcoffee', \TaffoVelikoff\HotCoffee\Http\Middleware\HotCoffee::class);
		$this->app['router']->aliasMiddleware('hotcoffee.auth', \TaffoVelikoff\HotCoffee\Http\Middleware\Auth::class);
		$this->app['router']->aliasMiddleware('hotcoffee.admin', \TaffoVelikoff\HotCoffee\Http\Middleware\VerifyAdmin::class);
		$this->app['router']->aliasMiddleware('hotcoffee.locale', \TaffoVelikoff\HotCoffee\Http\Middleware\Locale::class);
		$this->app['router']->aliasMiddleware('hotcoffee.controllers', \TaffoVelikoff\HotCoffee\Http\Middleware\DisabledControllers::class);

		// Settings model
		$this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });

        // Custom validation rules
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
		
	}

	public function register() {
		
		// Default string lenght
        Schema::defaultStringLength(191);

	}
}