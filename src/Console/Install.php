<?php

namespace TaffoVelikoff\HotCoffee\Console;

use File;
use Artisan;
use Illuminate\Console\Command;
use TaffoVelikoff\HotCoffee\Role;

class Install extends Command {

	/**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'hotcoffee:install';

	/**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'This will install the hotCoffee admin panel.';

	/**
     * Create a new command instance.
     *
     * @return void
     */
   	public function __construct() {
		  parent::__construct();
   	}

   	/*
   	 * Process the command
   	 */
    public function handle() {

      if(!File::exists(base_path('config/hotcoffee.php'))) {

        // Ask for example controllers and other logic
        ($this->confirm(
          'Do you want to install the example logic? This includes some example controllers, methods, routes and views for the front-end of your app.'
        )) ? $example = true : $example = false;

        $this->info("Working, please wait.\n");

        if($example == true) {

          $this->info("Publishing example code...");

          // Create _backup directory
          if(!File::exists(base_path('_backup')))
              File::makeDirectory(base_path('_backup'));

          // Move some files to the _backup folder
          File::move(base_path('/routes/web.php'), base_path('_backup/web.php'));

          // Copy hotCoffee routes
          File::put(base_path('/routes/web.php'), File::get(__DIR__.'/../../resources/publish/routes/web.php'));

          // Copy example front controllers
          if(!File::exists(base_path('/app/Http/Controllers/Front')))
              File::makeDirectory(base_path('/app/Http/Controllers/Front'));

          File::put(base_path('/app/Http/Controllers/Front/ArticleController.php'), File::get(__DIR__.'/../../resources/publish/Controllers/Front/ArticleController.php'));
          File::put(base_path('/app/Http/Controllers/Front/HomeController.php'), File::get(__DIR__.'/../../resources/publish/Controllers/Front/HomeController.php'));
          File::put(base_path('/app/Http/Controllers/Front/InfoPageController.php'), File::get(__DIR__.'/../../resources/publish/Controllers/Front/InfoPageController.php'));

          // Copy front views
          if(!File::exists(base_path('/resources/views/front')))
            File::makeDirectory(base_path('/resources/views/front'));

          File::put(base_path('/resources/views/front/_layout.blade.php'), File::get(__DIR__.'/../../resources/publish/views/front/_layout.blade.php'));
          File::put(base_path('/resources/views/front/article.blade.php'), File::get(__DIR__.'/../../resources/publish/views/front/article.blade.php'));
          File::put(base_path('/resources/views/front/home.blade.php'), File::get(__DIR__.'/../../resources/publish/views/front/home.blade.php'));
          File::put(base_path('/resources/views/front/infopage.blade.php'), File::get(__DIR__.'/../../resources/publish/views/front/infopage.blade.php'));

        } else {

          $this->info("Appending the routes to routes/web.php...");
          File::append(base_path("routes/web.php"), "\n\nHotCoffee::routes();");

        }

        // Create some admin controllers
        $this->info("Publishing some admin controllers to the /app directory...");
        if(!File::exists(base_path('/app/Http/Controllers/Admin')))
            File::makeDirectory(base_path('/app/Http/Controllers/Admin'));

        File::put(base_path('/app/Http/Controllers/Admin/CustomExportController.php'), File::get(__DIR__.'/../../resources/publish/Controllers/Admin/CustomExportController.php'));
        File::put(base_path('/app/Http/Controllers/Admin/DashboardController.php'), File::get(__DIR__.'/../../resources/publish/Controllers/Admin/DashboardController.php'));

        // Copy admin views
        $this->info("Publishing some admin views to the /app directory...");
        if(!File::exists(base_path('/resources/views/admin')))
          File::makeDirectory(base_path('/resources/views/admin'));

        File::put(base_path('/resources/views/admin/dashboard.blade.php'), File::get(__DIR__.'/../../resources/publish/views/admin/dashboard.blade.php'));

        // Copy the settings file
        File::put(base_path('/storage/app/settings.json'), File::get(__DIR__.'/../../resources/publish/settings.json'));

        // Migrate
        $this->info("Migrating database...");
        Artisan::call('migrate');

        // Create admin role
        $this->info("Creating the admin user role...");
        Role::create([
            'name'          => 'admin',
            'description'   => 'App administrator.',
        ]);

        // Publish hotCoffee config
        $this->info("Publishing assets. This may take a while...");
        Artisan::call('vendor:publish --tag=hotcoffee_config');

        // Publish unisharp/laravel-filemanager assets
        Artisan::call('vendor:publish --tag=lfm_config');
        Artisan::call('vendor:publish --tag=lfm_public');
        Artisan::call('vendor:publish --tag=hotcoffee_assets');

        // Link storage
        $this->info('Adding the storage symlink to your public folder...');
        Artisan::call('storage:link');

        // Clear cache
        $this->info('Clearing cache...');
        Artisan::call('optimize');

        // Display message
        $this->info("\n===================================================================================");

        $this->info("
            )))
            (((
          +-----+
          |     |]  HOT COFFEE ADMIN
          `-----' 
        ___________
        `---------'
        ");

        $this->info("\n===================================================================================");
        $this->info("\nThe package was succesfully installed.");
        $this->info("Edit your User model (usually app/User.php) and make the class extend \TaffoVelikoff\HotCoffee\User instead of Authenticatable.\n");
        $this->info("Then you can run 'php artisan hotcoffee:make-admin' to create your first admin user.\n");
        $this->info("===================================================================================");

      } else {

        // Already installed
        $this->info("\n====================================================");
        $this->info("\nHotCoffee: The package was already installed.\n");
        $this->info("====================================================");

      }

	}

}