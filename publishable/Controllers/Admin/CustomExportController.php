<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class CustomExportController extends \TaffoVelikoff\HotCoffee\Http\Controllers\Exports\CustomExportController
{
    public function __construct($export, $fields)
    {
        $this->export = $export;
        $this->fields = $fields;
    }

    /**
     * Each "case" is a custom export function
     */
    public function collection()
    {   
        switch ($this->export) {
            // This is just for demo of the custom export controller
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