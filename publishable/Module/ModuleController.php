<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{

    /**
     * Show all
     */
    public function index() {
        // Get all
        // $modules = Module::orderBy('id', 'desc')->paginate(settings('paginate'));
        return view('modules'/*, compact('modules')*/);
    }

    /**
     * Create
     */
    public function create() {
        return view('module');
    }

    /**
     * Edit
     */
    public function edit($id) {
        return view('module');
    }

    /**
     * Store
     */
    public function store() {
        //
    }

    /**
     * Update
     */
    public function update($id) {
        //
    }

    /**
     * Delete
     */
    public function destroy($id) {

        $module = Module::findOrFail($id);
        $module->delete();
        
        return array(
            'type'  => 'warning',
            'title' => __('hotcoffee::admin.success').'!',
            'message' => __('hotcoffee::admin.suc_deleted')
        );

    }

}