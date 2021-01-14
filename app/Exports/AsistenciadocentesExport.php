<?php

namespace App\Exports;
use App\Empleado;
use App\Permisos;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class AsistenciadocentesExport implements FromView
{
	use Exportable;
	protected $asistencias,$docentes,$fecha_inicial,$fecha_final;
	public function __construct($datos=null,$docentes=null,$ultimo_dia=null)
	{
$this->datos=$datos;
$this->docentes=$docentes;
$this->ultimo_dia=$ultimo_dia;
	}

    public function view():View
    {
     return view('admin.recursohumano.reportes.asistenciaspersonaldocente',['datos' =>$this->datos,'ultimo_dia'=>$this->ultimo_dia]);
    }
}
