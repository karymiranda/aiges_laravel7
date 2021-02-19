<?php

namespace App\Exports;
use App\Expedienteestudiante;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class NominaCEestudiantesExport implements FromView
{
	use Exportable;
	
     public function view(): View
    {
    	$nomina=Expedienteestudiante::where('estado',1)->orderBy('v_apellidos','ASC')->get();

        return view('admin.personaldocente.reportesmodulodocentes.vistasaexcel.nominaestudiantesCE_excel', ['nomina' => $nomina]);
    }
}
