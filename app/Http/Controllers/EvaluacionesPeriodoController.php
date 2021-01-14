<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competenciasciudadanas;
use App\Seccion;
use App\Asignaturas;
use App\Periodoevaluacion;
use App\EvaluacionesPeriodo;
use App\Periodoactivo;
use App\Grados;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Validator; 
use Response;
use Illuminate\Support\Facades\Input;

class EvaluacionesPeriodoController extends Controller
{
   public function index()
   {
    $eval=EvaluacionesPeriodo::orderBy('id','ASC')->get();
    return view('admin.configuraciones.administracionacademica.calificaciones.evaluaciones.listaevaluacionesperiodo')->with('eval',$eval);
   }


/*
public function eliminarevaluacionesperiodo($id)
{
  //dd('Eliminar');
  $val=EvaluacionesPeriodo::find($id)->calificaciones_estudiante()->count();
  if($val==0)//no hay registros relacionados en la tabla de calificaciones, entonces borre
  {
$evaluacionaeliminar = EvaluacionesPeriodo::find($id)->delete();
  }     
return response()->json($val);
}

public function agregarevaluacionesperiodo()
{
  $periodosevaluacion=Periodoevaluacion::with('periodoevaluacion_cicloescolar')->where('estado','=','1')->pluck('nombre','id');
    return view('admin.configuraciones.administracionacademica.calificaciones.evaluaciones.registrarevaluacion')->with('periodosevaluacion',$periodosevaluacion);
}

 public function guardarevaluacionesperiodo(Request $request)
  {
   $rules = array(
       'codigo_eval' => 'min:2|max:8|required',
       'nombre' => 'min:4|max:50|required'
    );
$messages= array('codigo_eval.min' => 'El código de la evaluación no puede ser menor a :min caracteres',
  'codigo_eval.required' => 'El código de la evaluación es obligatorio',
  'nombre.required' => 'El nombre de actividad es obligatorio'
 );
  $validator = Validator::make ( Input::all(), $rules);
  if ($validator->fails())
  {
    //$validator->getMessageBag()->add('codigo_eval', 'Camo obligatorio');
  return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
}
  else {
    $evaluacion=new EvaluacionesPeriodo($request->all());
    //$evaluacion->estado='1';
//dd($evaluacion);
$porcentajeacumulado=EvaluacionesPeriodo::where('periodoevaluacion_id','=',$request->periodoevaluacion_id)->sum('d_porcentajeActividad');
$porcentajeacumulado=$porcentajeacumulado+$request->d_porcentajeActividad;
//dd($porcentajeacumulado);
if($porcentajeacumulado>100)//si % no se pasa del 100% entonces guarde
{ 
//Flash::error("La ponderación de las actividades evaluadas para ésta asignatura sobrepasan el 100%")->important();
  $evaluacion->d_porcentajeActividad=110;
}
else
{
$evaluacion->save();
}
return response()->json($evaluacion);
}

}

 public function actualizarevaluacionesperiodo(Request $request)
  {
//dd($request);   
$rules = array(
       'codigo_eval' => 'min:2|max:8|required',
       'nombre' => 'min:4|max:50|required'
    );
$messages= array('codigo_eval.min' => 'El código de la evaluación no puede ser menor a :min caracteres',
  'codigo_eval.required' => 'El código de la evaluación es obligatorio',
  'nombre.required' => 'El nombre de actividad es obligatorio'
 );
  $validator = Validator::make ( Input::all(), $rules);
  if ($validator->fails())
  {
    //$validator->getMessageBag()->add('codigo_eval', 'Camo obligatorio');
  return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
}
  else {
$evaluacion=EvaluacionesPeriodo::find($request->id);
$porcentajeacumulado=EvaluacionesPeriodo::where('periodoevaluacion_id','=',$evaluacion->periodoevaluacion_id)->sum('d_porcentajeActividad');
$porcentajeacumulado=$porcentajeacumulado+$request->d_porcentajeActividad-$request->porcentajeanterior;
if($porcentajeacumulado>100)//si % no se pasa del 100% entonces guarde
{ 
$evaluacion->d_porcentajeActividad=$porcentajeacumulado;
}
else{
  $evaluacion->codigo_eval=$request->codigo_eval;
  $evaluacion->nombre=$request->nombre;
  $evaluacion->d_porcentajeActividad=$request->d_porcentajeActividad;
$evaluacion->save();  
}
return response()->json($evaluacion);
  }    
}

public function listadoevaluaciones($idperiodo)
{
  $evaluaciones=EvaluacionesPeriodo::where('periodoevaluacion_id','=',$idperiodo)->get();
  return response()->json($evaluaciones);
}
*/

public function listacompetenciasciudadanas()
{
$competenciasciudadanas=Competenciasciudadanas::orderBy('id','ASC')->get();
//dd($competenciasciudadanas);
return view('admin.configuraciones.administracionacademica.calificaciones.competenciasciudadanas.listacompetenciasciudadanas')->with('competenciasciudadanas',$competenciasciudadanas);
}

}
