<?php

namespace TaffoVelikoff\HotCoffee\Console;

use App\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command {

	/**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'hotcoffee:make-admin {--name=} {--email=}';

	/**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'Creates an admin user.';

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

        // Validate user name
        if(!$this->option('name')) {
            $validate['name'] = false;
            while($validate['name'] == false) {
            	$name = $this->ask('Enter a name for the new admin user (3 to 18 charecters long)');
            	(strlen($name) < 3 || strlen($name) > 18) ? $this->error("Invalid name. Must be between 3 and 18 charecters long.") : $validate['name'] = true;
            }
        } else {
            $name = $this->option('name');
        }

        // Validate user e-mail
        if(!$this->option('email')) {
            $validate['email'] = false;
            while($validate['email'] == false) {
            	$email = $this->ask('Enter an e-mail address');
            	(!filter_var($email, FILTER_VALIDATE_EMAIL)) ? $this->error("Invalid e-mail address.") : $validate['email'] = true;
            }
        } else {
            $email = $this->option('email');
        }

        // Validate password
        $validate['password'] = false;
        while($validate['password'] == false) {
        	$password = $this->secret('Enter a password (8 charecters minimum)');
        	(strlen($password) < 8) ? $this->error("Password should be at least 8 charecters long.") : $validate['password'] = true;
        }

        // Repeat password
        $repeat = $this->secret('Repeat your password');

        if($repeat == $password) {

        	// Create user
        	$user = User::create([
				'name'	=> $name,
				'email' => $email,
				'password' => $password
			]);
	        $user->address()->create([
	            'user_id' => $user->id,
	        ]);
	        $user->roles()->sync(1);
	        $user->markEmailAsVerified();

        	// Display message
	        $this->info("===================================================================================");

	        $this->info("
			    )))
			    (((
			  +-----+
			  |     |]	HOT COFFEE ADMIN
			  `-----' 
			___________
			`---------'
	    	");

	        $this->info("===================================================================================");
			$this->info("\nNew admin user was succesfully created. You can now login to the admin panel here:\n".route('hotcoffee.admin.login')."\n");
			$this->info("====================================================================================");
			exit;
		}

		$this->error('Passwords didn\'t match. Please run the command again.');
	}

}