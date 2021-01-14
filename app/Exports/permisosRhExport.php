<?php

namespace App\Exports;
use App\Permisos;
use App\Empleado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class permisosRhExport implements FromView
{
	use Exportable;
protected $permisos;
public function __construct($permisos=null)
{
$this->permisos=$permisos;
}
   
    public function View():View
    {
    return view('admin.recursohumano.reportes.permisoseincapacidadesRh',['permisos' => $this->permisos]);   
    }
}
