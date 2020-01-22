<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Excel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\Admin\CustomExportController;
use TaffoVelikoff\HotCoffee\Http\Controllers\Exports\ModelExportController;

class ExportController extends Controller
{
    /**
     * Display the export page
     */
    public function index() {

        // Custom page name
        view()->share('customPageName', __('hotcoffee::admin.xls_export'));

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
                    return (new ModelExportController($request->export, $exportable['fields']))->download($exportable['file_name'].'.'.$exportable['file_type']);

                if($exportable['type'] == 'emails')
                    return (new ModelExportController('App\User', $exportable['fields']))->download($exportable['file_name'].'.'.$exportable['file_type']);

                if($exportable['type'] == 'custom')
                    return (new CustomExportController($exportable['case'], $exportable['fields']))->download($exportable['file_name'].'.'.$exportable['file_type']);
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
