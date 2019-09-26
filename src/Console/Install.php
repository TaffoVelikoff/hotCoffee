<?php

namespace TaffoVelikoff\HotCoffee\Console;

use File;
use Illuminate\Console\Command;

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
        
        $routes = File::append(base_path('/routes/web.php'), File::get(__DIR__.'/../../resources/publish/routes.txt'));

        exit;
        if(!File::exists(base_path('/app/_backup/User.php'))) {
            // Create _backup directory
            File::makeDirectory(base_path('/app/_backup'));

            // Move current User model
            File::move(base_path('/app/User.php'), base_path('/app/_backup/User.php'));

            // Create HotCoffee User model
            File::put(base_path('/app/User.php'), File::get(__DIR__.'/../../resources/publish/User.php'));

            // Create SefController
            File::put(base_path('/app/Http/Controllers/SefController.php'), File::get(__DIR__.'/../../resources/publish/SefController.php'));

            // Create CustomExportController
            File::put(base_path('/app/Http/Controllers/CustomExportController.php'), File::get(__DIR__.'/../../resources/publish/CustomExportController.php'));

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
            $this->info("Run 'php artisan hotcoffee:make-admin' to create your first admin user.\n");
            $this->info("===================================================================================");
        } else {
            // Already installed
            $this->info("\n====================================================");
            $this->info("\nHotCoffee: The package was already installed.\n");
            $this->info("====================================================");
        }

	}

}