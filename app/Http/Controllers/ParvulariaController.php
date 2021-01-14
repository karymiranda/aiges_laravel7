<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expedienteestudiante;
use App\Seccion;
use App\HorarioClases;
use Laracasts\Flash\Flash;

class ParvulariaController extends Controller
{
   public function cerrarSeccionParvularia($idseccion)
    {
//Cerrar matriculas de la seccion
$lista=Expedienteestudiante::whereHas('estudiante_seccion', function ($q) use($idseccion){
    $q->where('seccion_id',$idseccion);
								})->get();
foreach ($lista as $key => $value) 
{
 //$estudiante=Expedienteestudiante::find($value->id);
Expedienteestudiante::find($value->id)->estudiante_seccion()->updateExistingPivot($idseccion, ['estado'=>0]);   
}
$seccion=Seccion::find($idseccion)->update([
                    "estado" => 0
                ]);
$horarios=HorarioClases::where('seccion_id',$idseccion)->update([
                    "estado" => 0
                ]);
Flash::success('Cierre de sección realizado con éxito. ')->important();
    return redirect()->route('listasecciones');
    }
}
