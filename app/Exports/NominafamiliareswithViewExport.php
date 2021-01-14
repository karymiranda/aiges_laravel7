<?php

namespace App\Exports;

use App\Expedienteestudiante;
use App\Seccion;
use App\Empleados;
use App\Grados;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NominafamiliareswithViewExport implements FromView
{
    use Exportable;
   
   protected $listafamiliares;
   public function __construct($listafamiliares=null)//recibo el parametro desde el controlador
   {
$this->listafamiliares=$listafamiliares;
   } 
   /**
    * @return \Illuminate\Support\Collection
    */

    public function  view(): View
    {
   return view('admin.personaldocente.reportesmodulodocentes.vistasaexcel.nominafamiliaresExcel', ['listafamiliares' => $this->listafamiliares]);
    }
}
