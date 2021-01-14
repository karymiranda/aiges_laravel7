<?php

namespace App\Exports;
use App\Asistenciasestudiantes;
use App\Seccion;
use App\Expedienteestudiante;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AsistenciaestudiantesExport implements FromView
{
 use Exportable; 
 
protected $asistencias;
public function __construct($asistencias=null)
{
$this->asistencias=$asistencias;
}
 /**
    * @return \Illuminate\Support\Collection
    */
 public function view():View
 {
    return view('admin.personaldocente.reportesmodulodocentes.vistasaexcel.asistenciaestudiantesExcel',['asistencias' => $this->asistencias]);
 }

}