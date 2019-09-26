<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CustomExport extends \TaffoVelikoff\HotCoffee\Http\Controllers\Exports\CustomExport
{
    public function __construct($export, $fields)
    {
        $this->export = $export;
        $this->fields = $fields;
    }

    public function collection()
    {	
    	switch ($this->export) {
    		case 'custom':
    			return User::select($this->fields)->get();
    			break;
    		
    		default:
    			// Flash warning message
		        session()->flash('notify', array(
		            'type'      => 'danger',
		            'message'   => 'Not found...'
		        )); 

		        // Redirect back
		        return back();
    			break;
    	}

    }
}
