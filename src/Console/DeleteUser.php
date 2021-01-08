<?php

namespace TaffoVelikoff\HotCoffee\Console;

use Illuminate\Console\Command;

class DeleteUser extends Command {

	/**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'hotcoffee:delete-user {email}';

	/**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'Deletes a user via e-mail address.';

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

        // Get user
        $user = config('hotcoffee.users.model')::where('email', $this->argument('email'))->first();
        
        // Check if exists
        if(!$user) {
            $this->error("\nUser with e-mail {$this->argument('email')} does not exist in the database.\n"); 
            exit;
        }

        // Delete
        $user->delete();

        // Display message
        $this->info("\n=============================================");
        $this->info("\nHotCoffee: The user was successfully deleted.\n");
        $this->info("=============================================");
	}

}