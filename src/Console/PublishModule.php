<?php

namespace TaffoVelikoff\HotCoffee\Console;

use File;
use Illuminate\Console\Command;

class PublishModule extends Command {

	/**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'hotcoffee:publish-module';

	/**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'Publishes a controller and it\'s views to your app so you can edit them.';

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
/*
        // Array of publishable modules
        $publishable = ['Article', 'InfoPage', 'Dashboard', 'Settings', 'Role', 'Search'];

        // Validate
        $validate = false;
        while($validate == false) {
            $controller = $this->ask('What do you want to publish to your app (model name without ".php" at the end)?');
            (!in_array($controller, $publishable)) ? $this->error("No such module or it can not be published.") : $validate = true;
        }
        
        switch($controller) {
            case 'Dashboard':
            case 'Search':
                // Copy controller
                $path = $this->ask('Do you want to place the controller in a specific folder? Leave empty if not.');

                $controllerFolder = base_path('/app/Http/Controllers/'.$path);
                if(!File::exists($controllerFolder)) {
                    File::makeDirectory($controllerFolder);
                }

                if($path) $path .= '/';

                $contollerCopy = base_path('/app/Http/Controllers/'.$path.$controller.'Controller.php');
                if(!File::exists($contollerCopy)) {
                    $controllerFile = File::get(__DIR__.'/../../src/Http/Controllers/Admin/'.$controller.'Controller.php');
                    $controllerFile = str_replace('namespace TaffoVelikoff\HotCoffee', 'namespace App', $controllerFile);
                    $controllerFile = str_replace('Controllers\Admin', 'Controllers\\'.substr($path, 0, -1), $controllerFile);
                    File::put($contollerCopy, $controllerFile);
                }

                break;

            // All others
            default:
                // Copy controller
                $path = $this->ask('Do you want to place the controller in a specific folder? Leave empty if not.');

                $controllerFolder = base_path('/app/Http/Controllers/'.$path);
                if(!File::exists($controllerFolder)) {
                    File::makeDirectory($controllerFolder);
                }

                if($path) $path .= '/';

                $contollerCopy = base_path('/app/Http/Controllers/'.$path.$controller.'Controller.php');
                if(!File::exists($contollerCopy)) {
                    $controllerFile = File::get(__DIR__.'/../../src/Http/Controllers/Admin/'.$controller.'Controller.php');
                    $controllerFile = str_replace('namespace TaffoVelikoff\HotCoffee', 'namespace App', $controllerFile);
                    $controllerFile = str_replace('Controllers\Admin', 'Controllers\\'.substr($path, 0, -1), $controllerFile);
                    $controllerFile = str_replace('use TaffoVelikoff\HotCoffee\\'.$controller, 'use App\\'.$controller, $controllerFile);
                    File::put($contollerCopy, $controllerFile);
                }

                // Copy the request
                if(!File::exists(base_path('/app/Http/Requests/')))
                    File::makeDirectory(base_path('/app/Http/Requests/'));

                if(!File::exists(base_path('/app/Http/Requests/'.$path)))
                    File::makeDirectory(base_path('/app/Http/Requests/'.$path));

                $requestCopy = base_path('/app/Http/Requests/'.substr($path, 0, -1).'/Store'.$controller.'.php');
                if(!File::exists($requestCopy)) {
                    $requestFile = File::get(__DIR__.'/../../src/Http/Requests/Admin/Store'.$controller.'.php');
                    $requestFile = str_replace('namespace TaffoVelikoff\HotCoffee', 'namespace App', $requestFile);
                    $requestFile = str_replace('Requests\Admin', 'Requests\\'.substr($path, 0, -1), $requestFile);
                    File::put($requestCopy, $requestFile);
                }

                // Copy the model
                $modelCopy = base_path('/app/'.$controller.'.php');
                if(!File::exists($modelCopy)) {
                    $modelFile = File::get(__DIR__.'/../../src/'.$controller.'.php');
                    $modelFile = str_replace('namespace TaffoVelikoff\HotCoffee', 'namespace App', $modelFile);
                    File::put($modelCopy, $modelFile);
                }
                
                break;
        }
        
        // Display message
        $this->info("===================================================================================");
        $this->info("Done. Don't forget to change the route to your new controller in the hotcoffee.php config file.");
        $this->info("Check any use cases if you previously published other models.");
        $this->info("====================================================================================");
        exit;
*/
	}
}