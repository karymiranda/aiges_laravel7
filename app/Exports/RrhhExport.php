<?php

namespace App\Exports;

use App\Empleado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RrhhExport implements FromView
{
    public function view(): View
    {
    	$empleados = Empleado::orderBy('id','ASC')->where('estado','=','1')->get();
		$empleados->each(function($empleados){ 
			$empleados->cargo;
		});
        return view('admin.seguridad.Reportes.recursohumano.rrhhExcel', [
            'empleados' => $empleados
        ]);
    }
}
