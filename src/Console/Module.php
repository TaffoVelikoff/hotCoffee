<?php

namespace TaffoVelikoff\HotCoffee\Console;

use File;
use Illuminate\Console\Command;

class Module extends Command {

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'hotcoffee:module {name} {--folder=}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Creates a boilerplate for a new module.';

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

		/*===== CONTROLLER =====*/

		// Create the folder
		$name = $this->argument('name');
		($this->option('folder')) ? $folder = ucfirst($this->option('folder')) : $folder = 'Admin';
		
		if($folder && !File::exists(base_path('/app/Http/Controllers/'.$folder)))
			File::makeDirectory(base_path('/app/Http/Controllers/'.$folder));
		
		// Copy the controller
		File::put(base_path('/app/Http/Controllers/'.$folder.'/'.ucfirst($name).'Controller.php'), File::get(__DIR__.'/../../publishable/Module/ModuleController.php'));
		$controllerFile = base_path('/app/Http/Controllers/'.$folder.'/'.ucfirst($name).'Controller.php');
		$controllerContent = File::get($controllerFile);
		
		// Namespace
		if($folder)
			$controllerContent = str_replace('namespace App\Http\Controllers', 'namespace App\Http\Controllers\\'.ucfirst($folder), $controllerContent);

		// Model name
		$controllerContent = str_replace('App\Module', 'App\\'.ucfirst($name), $controllerContent);

		// Controller name
		$controllerContent = str_replace('ModuleController', ucfirst($name.'Controller'), $controllerContent);
		
		// View names
		($folder) ? $viewNames = lcfirst($folder).'.'.$name : $viewNames = $name;
		$controllerContent = str_replace('view(\'module', 'view(\''.$viewNames, $controllerContent);
		$controllerContent = str_replace('$module', '$'.$name, $controllerContent);
		$controllerContent = str_replace('compact(\'modules\')', 'compact(\''.$name.'s'.'\')', $controllerContent);

		// Destroy method
		$controllerContent = str_replace('Module::', ucfirst($name).'::', $controllerContent);

		// Put the new content
		File::put($controllerFile, $controllerContent);

		/*===== MODEL =====*/
		File::put(base_path('/app/'.ucfirst($name).'.php'), File::get(__DIR__.'/../../publishable/Module/Module.php'));
		$modelFile = base_path('/app/'.ucfirst($name).'.php');
		$modelContent = File::get($modelFile);
		$modelContent = str_replace('Module', ucfirst($name), $modelContent);
		File::put($modelFile, $modelContent);

		/*===== VIEWS =====*/
		if($folder && !File::exists(base_path('/resources/views/'.lcfirst($folder))))
			File::makeDirectory(base_path('/resources/views/'.lcfirst($folder)));

		File::put(base_path('/resources/views/'.lcfirst($folder).'/'.$name.'s.blade.php'), File::get(__DIR__.'/../../publishable/Module/modules.blade.php'));
		$viewOneFile = base_path('/resources/views/'.lcfirst($folder).'/'.$name.'s.blade.php');
		$viewOneContent = File::get($viewOneFile);
		$viewOneContent = str_replace('$info', '$'.$name, $viewOneContent);
		$viewOneContent = str_replace('$modules', '$'.$name.'s', $viewOneContent);
		File::put($viewOneFile, $viewOneContent);

		File::put(base_path('/resources/views/'.lcfirst($folder).'/'.$name.'.blade.php'), File::get(__DIR__.'/../../publishable/Module/module.blade.php'));

		$this->info("All files for the module were created.");
	}

}