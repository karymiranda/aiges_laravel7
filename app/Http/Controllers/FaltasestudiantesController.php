<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faltasestudiantes;
use App\Expedienteestudiante;
use Carbon\Carbon;
use Laracasts\Flash\Flash;


class FaltasestudiantesController extends Controller
{
   public function addconductaestudiante_admin($idestudiante)
{
	dd('llega');
return view('admin.academica.expedientesestudiantes.conducta.addfaltaestudiante_admin');
}


public function addfaltaestudiante_docentes($idestudiante,$idseccion)
{
$estudiante=Expedienteestudiante::find($idestudiante);
		$fecha = Carbon::today();
		$fecha=$fecha->format('d/m/Y');
return view('admin.personaldocente.gestionacademica.nominas.consultarinformacionindividual.faltasyreconocimientos.addfaltas_doc',compact('fecha','estudiante','idseccion'));
}

public function storefaltaestudiante_docentes(Request $request)
{
	$estudiante_id=$request->estudiante_id;
	$seccion_id=$request->seccion_id;
	$fecha = $request->fecha;
$formato = Carbon::createFromFormat('d/m/Y',$fecha);
$fecha = $formato->format('Y-m-d');
$faltas=new Faltasestudiantes($request->all());
$faltas->fecha=$fecha;

$faltas->save();
Flash::success("Falta registrada con exito")->important();
return redirect()->route('addfaltaestudiante_doc',[$estudiante_id,$seccion_id]);
}



}
