<?php

namespace TaffoVelikoff\HotCoffee\Console;

use File;
use Illuminate\Console\Command;

class PublishRoutes extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotcoffee:publish-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will copy the routes from the package\'s directory to the "routes" folder of your project.';

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

      $question = 'This will copy the all of hotcoffee\'s routes into routes/admin.php file. If you already have a file with that name it WILL BE OVERWRITTEN! Are you sure you want to continue?';

      if($this->confirm($question)) {
        File::put(base_path('/routes/admin.php'), File::get(__DIR__.'/../../routes/web.php'));
        $this->info('The routes file was copied succsessfully.');
      }

    }

}