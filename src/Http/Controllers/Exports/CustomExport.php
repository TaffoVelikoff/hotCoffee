<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomExport implements FromCollection
{
	use Exportable;

    public function __construct()
    {
        //
    }

    public function collection()
    {
        //
    }
}
