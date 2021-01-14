<?php

namespace App\Exports;
use App\ActivoFijo; 
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TrasladoactivosExport implements FromView
{
    use Exportable;
    protected $traslados;
    public function __construct($traslados=null)
    {    
    	 $this->traslados=$traslados;
    }

    public function view():View
    {
    return view('admin.activofijo.reportes.trasladosactivos_excel',['traslados'=> $this->traslados]); 
    }
}
