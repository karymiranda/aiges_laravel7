<?php

namespace App\Exports;
use App\ActivoFijo;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CatalogoactivofijoExport implements FromView
{
    use Exportable;
    protected $catalogo;
    public function __construct($cuentas=null)
    {    
    	 $this->catalogo=$cuentas;
    }
    public function view():View
    {
        return view('admin.activofijo.reportes.catalogoactivos_excel',['activos'=> $this->catalogo]); 
    }
}
