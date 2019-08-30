<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Excel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use TaffoVelikoff\HotCoffee\Http\Controllers\Exports\ModelExport;

class ExportController extends Controller
{
    /**
     * Display the export page
     */
    public function index() {

    	// Display view
        return view('hotcoffee::admin.export');
    }

    /**
     * Export
     */
    public function export(Request $request) {

        // Something to export?
        if($request->export) {
            $exportables = config('hotcoffee.exportables');
            $exportable = $exportables[$request->export];

            // Is it in the "exportables" array?
            if(in_array($exportable, config('hotcoffee.exportables')))

                // Export a model
                if($exportable['type'] == 'model')
                    return (new ModelExport($request->export, $exportable['fields']))->download($exportable['file_name'].'.'.$exportable['file_type']);

                if($exportable['type'] == 'emails')
                    return (new ModelExport('App\User', $exportable['fields']))->download($exportable['file_name'].'.'.$exportable['file_type']);

                if($exportable['type'] == 'custom')
                    return (new CustomExport($exportable['case'], $exportable['fields']))->download($exportable['file_name'].'.'.$exportable['file_type']);
        }
        
        // Flash warning message
        session()->flash('notify', array(
            'type'      => 'danger',
            'message'   => __('hotcoffee::admin.err_select_export')
        )); 

        // Redirect back
        return redirect()->route('hotcoffee.admin.export.index');

    }
}
