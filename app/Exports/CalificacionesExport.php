<?php

namespace App\Exports;
use App\Notas;
use App\NotasItem;
use App\Seccion;
use App\Expedienteestudiante;
use App\Periodoevaluacion;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CalificacionesExport implements FromView
{
    use Exportable;
    protected $notas,$seccion,$periodo,$asignatura;

    public function __construct($notas=null,$seccion=null,$asignatura=null,$periodo=null,$students=null)
    {
$this->notas=$notas;
$this->asignatura=$asignatura;
$this->seccion=$seccion;
$this->periodo=$periodo;
$this->students=$students;
    }

    public function view():View
    {
    	$hoy = Carbon::now();
		$hoy = $hoy->format('d/m/Y');
return view('admin.personaldocente.reportesmodulodocentes.vistasaexcel.notasExcel',['notas' => $this->notas,'asignatura' => $this->asignatura,'seccion' => $this->seccion,'periodo' => $this->periodo,'students' => $this->students,'hoy' => $hoy]);    	
    }
}
