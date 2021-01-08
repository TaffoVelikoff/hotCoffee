<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Exports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ModelExportController implements FromCollection
{
	use Exportable;

	public function __construct($model, $columns)
    {
        $this->columns = $columns;
        $this->model = $model;
    }

    public function collection()
    {
        return $this->model::select($this->columns)->get();
    }
}
