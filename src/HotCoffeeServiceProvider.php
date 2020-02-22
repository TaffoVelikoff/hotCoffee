<?php
	
namespace TaffoVelikoff\HotCoffee;

use Validator;
use Illuminate\Support\Facades\Route;
use TaffoVelikoff\HotCoffee\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use TaffoVelikoff\HotCoffee\Providers\HotCoffeeEventServiceProvider;

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

		// Register custom validation rules
		$this->registerCustomValidationRules();

		// Route bindings
		Route::model('article', config('hotcoffee.articles.model'));
		Route::model('info', config('hotcoffee.infopages.model'));
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

		//
		$this->mergeConfigurations();

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

		// Views
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'hotcoffee');

		// Translations
		$this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'hotcoffee');

		// Migrations
		$this->loadMigrationsFrom(__DIR__.'/../database/migrations');

		// Configs
		$this->publishesConfigurations();

		// Assets
		$this->publishes([
			__DIR__.'/../public' => public_path('vendor/hotcoffee'),
		], 'hotcoffee_assets');
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

	/**
	 * Custom validation rules
	 */
	private function registerCustomValidationRules() {

		Validator::extend('without_spaces', function($attr, $value){
			return preg_match('/^\S*$/u', $value);
		});

	}

	private function publishesConfigurations() {

		// Main hotcoffee config file
		$this->publishes([
			__DIR__.'/../config/hotcoffee.php' => config_path('hotcoffee.php'),
		], 'hotcoffee_config');

		// Settings config file
		$this->publishes([
			__DIR__.'/../config/hotcoffee/settings.php' => config_path('hotcoffee/settings.php'),
		], 'hotcoffee_config_settings');

		// Settings config file
		$this->publishes([
			__DIR__.'/../config/hotcoffee/infopages.php' => config_path('hotcoffee/infopages.php'),
		], 'hotcoffee_config_infopages');

		// Articles config file
		$this->publishes([
			__DIR__.'/../config/hotcoffee/articles.php' => config_path('hotcoffee/articles.php'),
		], 'hotcoffee_config_articles');

		// Users config file
		$this->publishes([
			__DIR__.'/../config/hotcoffee/users.php' => config_path('hotcoffee/users.php'),
		], 'hotcoffee_config_users');
	}

	private function mergeConfigurations() {

		// Settings
		$this->mergeConfigFrom(
			__DIR__.'/../config/hotcoffee/settings.php', 'hotcoffee.settings'
		);

		// Info Pages
		$this->mergeConfigFrom(
			__DIR__.'/../config/hotcoffee/infopages.php', 'hotcoffee.infopages'
		);

		// Articles
		$this->mergeConfigFrom(
			__DIR__.'/../config/hotcoffee/articles.php', 'hotcoffee.articles'
		);

		// Users
		$this->mergeConfigFrom(
			__DIR__.'/../config/hotcoffee/users.php', 'hotcoffee.users'
		);
	}
}