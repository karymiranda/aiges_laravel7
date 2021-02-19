<?php

namespace App\Exports;
use App\Expedienteestudiante;
use App\Familiares;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class NominaCEfamiliaresExport implements FromView
{
   
   
    use Exportable;

	
   
    public function view(): View
    {
       
$listafamiliares=Expedienteestudiante::with('estudiante_familiares')->where('estado',1)->get();

        return view('admin.personaldocente.reportesmodulodocentes.vistasaexcel.nominafamiliaresCE_excel', ['listafamiliares' => $listafamiliares]);
    }
    
}
