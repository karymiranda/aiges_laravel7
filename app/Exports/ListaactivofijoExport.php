<?php 

namespace App\Exports;
use App\ActivoFijo; 
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ListaactivofijoExport implements FromView
{
    use Exportable;
    protected $activosP;
    public function __construct($activos=null)
    {    
    	 $this->activosP=$activos;
    }

    public function view():View
	
    {
    	return view('admin.activofijo.reportes.listaactivos_excel',['activos'=> $this->activosP]);     
    }
}
