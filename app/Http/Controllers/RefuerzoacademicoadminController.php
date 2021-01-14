<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CuadroFinalController;
use App\CuadroFinal;
use App\Seccion;
use App\Periodoevaluacion;
use App\Periodoactivo;
use App\EvaluacionesPeriodo;
use App\Notas;
use App\NotasItems;
use App\Asignaturas;
use App\Expedienteestudiante;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

class RefuerzoacademicoadminController extends Controller
{
    public function refuerzonotas(Request $request)
    {
    	$seccion_id=$request->get('seccion_id');
    	$periodo=$request->get('periodo');
      $modulo=$request->get('modulo');
    	$is_data=true;

$notasEst   = Notas::where([['seccion_id', $seccion_id],['periodo_id',$periodo]])->get();
 if(!count($notasEst)>0)//si no hay notas entonces
    {
      Flash::error("No hay información para mostrar")->important();
     if ($modulo=='admin'){return redirect()->route('listasecciones');}
else{return redirect()->route('nominadeestudiantes',$seccion_id);}
      
    }  
    $itemsNotasEst = $this->orderStudentNota($notasEst);

     if(!count($itemsNotasEst)>0)//si no hay notas entonces
    {
      Flash::error("No hay calificaciones registradas.")->important();
     if ($modulo=='admin'){return redirect()->route('listasecciones');}
else{return redirect()->route('nominadeestudiantes',$seccion_id);}
    }  
    //dd($itemsNotasEst);
    $periodoevaluado = Periodoevaluacion::find($periodo);
   $students = DB::table('tb_expedienteestudiante')
      ->join('tb_matriculaestudiante', 'tb_matriculaestudiante.estudiante_id', '=', 'tb_expedienteestudiante.id')
      ->where('tb_matriculaestudiante.seccion_id', $seccion_id)
      ->select(
      	"tb_expedienteestudiante.id",
        "tb_expedienteestudiante.v_nombres",
        "tb_expedienteestudiante.v_apellidos",
        "tb_expedienteestudiante.v_nie",
        "tb_expedienteestudiante.v_expediente")
      ->orderBy('tb_expedienteestudiante.v_apellidos', 'asc')
      ->orderBy('tb_expedienteestudiante.v_nombres', 'asc')
      ->get(); 
$materias=$this->getSubjects($seccion_id);

return view('admin.configuraciones.administracionacademica.secciones.refuerzoacademico.verpromediosporperiodo',compact('seccion_id','is_data','itemsNotasEst','students','materias','periodoevaluado','modulo'));		
    } 

   public function periodorefuerzonotas($id,$modulo)
   {
   	$aniolectivo=Periodoactivo::periodoescolar()->get();
		$aniolectivoactivo=$aniolectivo->pluck('anio','id');
		
		$seccion= Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.id','=',$id)
            ->pluck('grado', 'tb_secciones.id');	
	$periodos = Periodoevaluacion::where('estado', 1)->get();

		return view('admin.configuraciones.administracionacademica.secciones.refuerzoacademico.periodorefuerzoacademico',compact('periodos','aniolectivoactivo','seccion','modulo','id'));
		
   }

      public function orderStudentNota($varnotas = array())
  {
    $result = array();
    foreach ($varnotas as $item) {
      foreach ($item->notas as $value) {

       $result[$value->alumno->v_expediente]['varnotas'][$item->asignatura->asignatura][$item->periodo->descripcion][$item->evaluacion->codigo_eval] = floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);

       if($item->evaluacion->codigo_eval=='RF'){
       	 $result[$value->alumno->v_expediente]['varnotas'][$item->asignatura->asignatura][$item->periodo->descripcion][$item->evaluacion->codigo_eval] = floatval($value->calificacion);
       }

      }
    }
    return $result;
  }

public function addrefuerzo($estudiante,$materia,$seccion,$periodo,$modulo)
{
  #dd($estudiante,$materia,$seccion,$periodo);
	$alumno=Expedienteestudiante::find($estudiante);
	$periodoevaluado=Periodoevaluacion::find($periodo);
	$asignatura=Asignaturas::where('asignatura',$materia)->first();
$notaVerify = Notas::with('evaluacion')->whereHas('evaluacion',function($p){
$p->where('codigo_eval','RF');
})->where('seccion_id', $seccion)
                ->where('periodo_id', $periodo )
                ->where('asignatura_id', $asignatura->id)
                ->first();
$evalrefuerzo=EvaluacionesPeriodo::where('codigo_eval','RF')->first();//traigo los datos de la actividad refuerzo
//dd(count($notaVerify));
if(count($notaVerify)<=0)//No existe la nota
{
$nota=new Notas;
$nid=$nota->id;
$nota->seccion_id=$seccion;	
$nota->evaluacion_id=$evalrefuerzo->id;
$nota->asignatura_id=$asignatura->id;	
$nota->periodo_id=$periodo;
$nota->save();
}
else
{
$nid=$notaVerify->id;
}
//dd($notaid);
$calificacion=self::getNotesStudentsperiodo($estudiante,$seccion,$asignatura->id,$periodo);//saco el promedio del periodo

foreach ($calificacion as $key => $value) {
	foreach ($value as $k => $v) {
	$calificacion=$v;
	}	
}
//dd($calificacion);
if($calificacion<5)
{
  //dd($calificacion);
$cali=Notas::find($nid);
$item = new NotasItems;
$item->notas_id = $nid;
$item->alumno_id = $estudiante;
$item->calificacion=5-$calificacion;
$item->observaciones="Refuerzo académico";
$item->save();
}

$notaArray = Notas::with(['notas'=>function($parametro) use ($estudiante){
$parametro->where('alumno_id',$estudiante);
}])->where('seccion_id', $seccion)
                ->where('periodo_id', $periodo)
                ->where('asignatura_id', $asignatura->id)
                ->get();
//dd($notaArray);
return view('admin.configuraciones.administracionacademica.secciones.refuerzoacademico.completarrefuerzo',compact('seccion','periodoevaluado','asignatura','notaArray','alumno','modulo'));
}

 private function getSubjects($id) {
        return self::getObjectArray(DB::table('notas')
            ->join('tb_asignaturas', 'notas.asignatura_id', '=', 'tb_asignaturas.id')
            ->where('notas.seccion_id', $id)
           // ->where('tb_asignaturas.is_cuadro', 1)
           
            ->select('tb_asignaturas.name_short', 'tb_asignaturas.id')
            ->distinct()
            ->get());
    }


    private function getObjectArray($arrayObject) {
        $array = [];
        foreach ($arrayObject as $item) {
            $array[$item->id] = $item->name_short; 
        }
        return $array;
    }


    private function getNotesStudentsperiodo($alumno_id,$seccion,$asignatura,$periodo){
        $arrayResponse = [];
        $currentAsigantura = null;
        $sqlQuery = "SELECT notas.asignatura_id, notas_items.calificacion,tb_evaluacionesperiodo.d_porcentajeActividad as porcentaje FROM notas_items INNER JOIN notas ON notas.id = notas_items.notas_id and notas.seccion_id={$seccion} INNER JOIN tb_evaluacionesperiodo ON tb_evaluacionesperiodo.id = notas.evaluacion_id WHERE notas_items.alumno_id = {$alumno_id} and notas.asignatura_id={$asignatura} and notas.periodo_id={$periodo} ORDER BY notas.asignatura_id";
        $notes = DB::select(DB::raw($sqlQuery));

        foreach($notes as $value) {
            $strName = $value->asignatura_id;
            if($currentAsigantura != $strName)
                $arrayResponse[$strName] = array("calificacion" => 0);

            $arrayResponse[$strName]['calificacion'] += (
                floatval($value->calificacion) * floatval($value->porcentaje)
            )/100;
            $currentAsigantura = $value->asignatura_id;
        }
        //dd($arrayResponse);
        return $arrayResponse;
    }




    private function getNotesStudents($alumno_id,$seccion){
        $arrayResponse = [];
        $currentAsigantura = null;
        $sqlQuery = "SELECT notas.asignatura_id, notas_items.calificacion,tb_evaluacionesperiodo.d_porcentajeActividad as porcentaje FROM notas_items INNER JOIN notas ON notas.id = notas_items.notas_id and notas.seccion_id={$seccion} INNER JOIN tb_evaluacionesperiodo ON tb_evaluacionesperiodo.id = notas.evaluacion_id WHERE notas_items.alumno_id = {$alumno_id} ORDER BY notas.asignatura_id";
        $notes = DB::select(DB::raw($sqlQuery));

        foreach($notes as $value) {
            $strName = $value->asignatura_id;
            if($currentAsigantura != $strName)
                $arrayResponse[$strName] = array("calificacion" => 0);

            $arrayResponse[$strName]['calificacion'] += (
                floatval($value->calificacion) * floatval($value->porcentaje)
            )/100;
            $currentAsigantura = $value->asignatura_id;
        }
        //dd($arrayResponse);
        return $arrayResponse;
    }



///////////refuerzo modulo docente//////////////////////////////

}
