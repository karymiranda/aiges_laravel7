<?php

namespace App\Exports;
use App\Expedienteestudiante;
use App\Seccion;
use App\Empleados;
use App\Grados;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NominaalumnoswithViewExport implements FromView
{
	use Exportable;
   
   protected $listaestudiantes;
   public function __construct($listaestudiantes=null)//recibo el parametro desde el controlador
   {
$this->listaestudiantes=$listaestudiantes;
   } 
   /**
    * @return \Illuminate\Support\Collection
    */

    public function  view(): View
    {
  
   return view('admin.personaldocente.reportesmodulodocentes.vistasaexcel.formato_nominaestudiantesExcel', ['listaestudiantes' => $this->listaestudiantes]);
    }
}
