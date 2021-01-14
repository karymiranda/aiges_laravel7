<?php

namespace App\Exports;
use App\Expedienteestudiante;
use App\Seccion;
use App\Empleados;
use App\Grados;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class NominaalumnosseccionExport implements FromCollection
{
	use Exportable;
   
   protected $listaestudiantes;
   public function __construct($listaestudiantes=null)
   {
$this->listaestudiantes=$listaestudiantes;
   } 
   /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return $this->listaestudiantes ?:Expedienteestudiante::all();
    }
}
