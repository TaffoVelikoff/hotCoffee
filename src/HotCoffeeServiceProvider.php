<?php
	
namespace TaffoVelikoff\HotCoffee;

use Validator;
use Illuminate\Support\Facades\Route;
use TaffoVelikoff\HotCoffee\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

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
        Schema::defaultStringLength(255);

        // Facades
		$loader = AliasLoader::getInstance();
        $loader->alias('HotCoffee', \TaffoVelikoff\HotCoffee\Facades\HotCoffee::class);

		$this->app->bind('hotcoffee', function() {
			return new HotCoffee();
		});

		// Extending Bnb\Laravel\Attachments\Attachment
		$this->app->bind(
            \Bnb\Laravel\Attachments\Contracts\AttachmentContract::class,
            \TaffoVelikoff\HotCoffee\Attachment::class
        );

        // Artisan commands
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
		//$this->loadRoutesFrom(__DIR__.'/../routes/web.php');

		// Views
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'hotcoffee');

		// Translations
	    $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'hotcoffee');

	    // Migrations
	    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

	    // Config
	    $this->publishes([
	        __DIR__.'/../config/hotcoffee.php' => config_path('hotcoffee.php'),
	    ], 'hotcoffee.config');

	    // Assets
	    $this->publishes([
	        __DIR__.'/../public' => public_path('hotcoffee'),
	    ], 'hotcoffee.assets');
	}

	/*
	 *	Registers the middlewares
	 */
	private function registerMiddlewares() {
		
		$this->app['router']->middlewareGroup('hotcoffee', [
			\TaffoVelikoff\HotCoffee\Http\Middleware\Auth::class,
			\TaffoVelikoff\HotCoffee\Http\Middleware\HotCoffee::class
		]);

	}
}