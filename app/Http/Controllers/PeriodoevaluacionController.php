<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PeriodoevaluacionRequest;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Periodoevaluacion;
use App\Periodoactivo;

class PeriodoevaluacionController extends Controller
{
    public function index()
	{
$ciclos=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
if(!isset($ciclos)){//no hay ciclo o año escolar activo
Flash::warning("ACTUALMENTE NO CUENTA CON UN CICLO O AÑO ESCOLAR ACTIVO.<br> SE RECOMIENDA COMPLETAR EL REGISTRO DE UN NUEVO CICLO ESCOLAR E INICIAR LAS CONFIGURACIONES PARA SECCIONES, HORARIOS DE CLASES, Y PERIODOS DE EVALUACION PARA UN OPTIMO FUNCIONAMIENTO DE LA APLICACION.")->important(); 
    return redirect()->route('registrarcicloacademico');	
}
else{
$periodosevaluacion=Periodoevaluacion::with('periodoevaluacion_cicloescolar')->where('periodo_id','=',$ciclos->id)->get(); 
$mostrarboton=Periodoevaluacion::where('periodo_id','=',$ciclos->id)->count();
return view('admin.configuraciones.administracionacademica.calificaciones.periodos.listaperiodosdeevaluacion')->with('periodosevaluacion',$periodosevaluacion)->with('mostrarboton',$mostrarboton);
}
}


	public function registrarperiodoevaluacion()
	{
$ciclos=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->pluck('anio','id');
return view('admin.configuraciones.administracionacademica.calificaciones.periodos.registrarperiodoevaluacion')->with('ciclos',$ciclos);
	}

public function guardarperiodoevaluacion(PeriodoevaluacionRequest $request)
	{
//dd($request);
	$periodoevaluacion=new Periodoevaluacion($request->all());
	$periodo = explode(' - ', $request->periodo);
    $desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
    $hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
    $periodoevaluacion->fecha_inicio = $desde->format('Y/m/d');
    $periodoevaluacion->fecha_fin = $hasta->format('Y/m/d');
    $periodoevaluacion->estado=$request->estado;
    $periodoevaluacion->save();
    Flash::success("Período de evaluación ". $periodoevaluacion->nombre ." guardado exitosamente")->important();
    return redirect()->route('listaperiodosdeevaluacion');
	}
	
	public function editarperiodoevaluacion($id)
	{
 $ciclos=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->pluck('anio','id');
 $datos=Periodoevaluacion::find($id);
 $desde = Carbon::createFromFormat('Y-m-d',$datos->fecha_inicio);
 $hasta = Carbon::createFromFormat('Y-m-d',$datos->fecha_fin);
 $desde=$desde->format('d/m/Y');
 $hasta=$hasta->format('d/m/Y');
 $periodo=implode(' - ',[$desde,$hasta]);
return view('admin.configuraciones.administracionacademica.calificaciones.periodos.editarperiodoevaluacion')->with('datos',$datos)->with('periodo',$periodo)->with('ciclos',$ciclos);
	}

public function actualizarperiodoevaluacion(PeriodoevaluacionRequest $request,$id)
	{
	$periodoevaluacion=Periodoevaluacion::find($id);
	$periodoevaluacion->fill($request->all());	
	$periodo = explode(' - ', $request->periodo);
    $desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
    $hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
    $periodoevaluacion->fecha_inicio = $desde->format('Y/m/d');
    $periodoevaluacion->fecha_fin = $hasta->format('Y/m/d');
    $periodoevaluacion->save();
    Flash::success("Periodo de evaluación actualizado exitosamente")->important();
    return redirect()->route('listaperiodosdeevaluacion');
    	}

    	public function eliminarperiodoevaluacion($id)
	{
	Periodoevaluacion::destroy($id);
	Flash::success("Periodo de evaluación eliminado exitosamente")->important();
    return redirect()->route('listaperiodosdeevaluacion');
	}

}
