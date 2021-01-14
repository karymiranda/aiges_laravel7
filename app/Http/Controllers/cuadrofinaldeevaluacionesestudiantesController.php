<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notas;
use App\Seccion;
use App\NotasItems;
use App\EvaluacionesPeriodo;
use App\InfoCentroEducativo;
use App\Periodoevaluacion;


class cuadrofinaldeevaluacionesestudiantesController extends Controller
{
   public function docentescuadrofinal_pdf($id)
   {
    $centroEscolar = InfoCentroEducativo::first();
    $seccion = Seccion::find($id);
    $pdf = new pdfcuadrofinaldeevaluacionesController("L","mm","Letter");
    $pdf->AddPage();
    //$filename = 'CUADROFINAL.pdf';
     $pdf->headerBoletaNotas($centroEscolar);
    return response()->make($pdf->Output(), 200, [
      'Content-Type' => 'application/pdf',
      'Content-Disposition' => 'inline; filename="doc.pdf"'
    ]);
   }
   
}
