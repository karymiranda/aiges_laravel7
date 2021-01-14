<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expedienteestudiante;
use App\Asignaturas;
use App\Periodoevaluacion;
use App\Periodoactivo;
use App\EvaluacionesPeriodo;
use App\Bitacora;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Notas;
use App\NotasItems;
use App\Competenciasciudadanas;
use App\Usuario;
use App\Conducta;

class CalificacionesindividualadminController extends Controller
{
    public function bitacora($operacion = array())
    {
        $usuario = Auth::user()->id;
        $user=Usuario::find(Auth::user()->id);
        $usuarioname=$user->empleado->v_nombres ." ".$user->empleado->v_apellidos;
        $item = new Bitacora;
        $item->user_id = $usuario;
        $item->usuario_nombre = $usuarioname;
        $item->operacion = json_encode($operacion);
        $item->save();
    }
    public function index($id,$modulo)
    {
        $periodoescolaractivo=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
        $anio=$periodoescolaractivo->anio;
    	$seccion=Expedienteestudiante::with(['estudiante_seccion'=>function ($query) use ($anio){
            $query->where([['tb_matriculaestudiante.v_estadomatricula','aprobada'],['tb_matriculaestudiante.anio',$anio]]);    		
    	}])->where('id',$id)->first();

        if(count($seccion->estudiante_seccion)>0)//esta matriculado este año
        {
            foreach ($seccion->estudiante_seccion as $value) {
               $idseccion=$value->id;
               
            $info=$value->descripcion.' / '.$seccion->v_apellidos.', '.$seccion->v_nombres;
            }
        }
        else
        {
//en menu docentes nuca ingresara aca xq ahi todos los alumnos estan matriculados
Flash::error("No es posible ingresar calificaciones, el estudiante no está matriculado en ninguna sección.")->important();
return redirect()->route('listaexpedientes');
        }

//    	dd($seccion->estudiante_seccion->id);
		$asignaturas = Asignaturas::pluck('asignatura', 'id');
		$periodos = Periodoevaluacion::where('estado', 1)->get();
		$evaluaciones = EvaluacionesPeriodo::pluck('nombre', 'id');
/*$hoy=Carbon::now()->format('Y-m-d');
$periodos=Periodoevaluacion::with('periodoevaluacion_cicloescolar')->where(
    [['estado','=','1'],['fecha_inicio','<=',$hoy],['fecha_fin','>=',$hoy]])->pluck('descripcion','id');*/

return view('admin.academica.expedientesestudiantes.notasindividuales.listanotasindividuales',compact('periodos', 'asignaturas', 'evaluaciones','id','idseccion','info','modulo'));
    }


public function addnotessingleadmin(Request $request)
{
$params = $request->all();
$modulo= $request->modulo;
$estudiante=Expedienteestudiante::find($request->estudiante_id);
$evaluaciones = EvaluacionesPeriodo::orderBy('id')->where('codigo_eval','!=','RF')->get();
$asignatura = Asignaturas::find($request->materia);
$periodo = Periodoevaluacion::find($request->periodo);
$id=$request->estudiante_id;

$notaVerify = Notas::with(['notas'=>function($parametro) use ($id){
$parametro->where('alumno_id',$id);
}])->where('seccion_id', $params['seccion_id'])
                ->where('periodo_id', $params['periodo'] )
                // ->where('asignatura_id', $params['materia'] )
                ->where('asignatura_id', $params['materia'] )
                ->get();

if(count($notaVerify)>0)
{//ver
     
if(!count($notaVerify[0]->notas)>0)//si existe la evaluacionm pero aun no ha sido calificada
{//se envia a guardar ya que no han registrado una calificcaion para esta evaluacion
return view('admin.academica.expedientesestudiantes.notasindividuales.registrarnotasindividual',compact('evaluaciones','params','estudiante','asignatura','periodo','modulo'));
}
//dd($notaVerify);
return view('admin.academica.expedientesestudiantes.notasindividuales.vernotasindividual',compact('evaluaciones','params','estudiante','asignatura','periodo','notaVerify','modulo'));

}else
{//guardar

return view('admin.academica.expedientesestudiantes.notasindividuales.registrarnotasindividual',compact('evaluaciones','params','estudiante','asignatura','periodo','modulo'));
}
 
}

public function savenotessingleadmin(Request $request)
{

       $params = $request->all();
       $modulo=$request->modulo;
       $estudiante=Expedienteestudiante::find($request->estudiante_id);
       $asignatura = Asignaturas::find($request->materia);
       $periodo = Periodoevaluacion::find($request->periodo);

        $estudiante_id = $request->get('estudiante_id');
        $evaluaciones = $request->get('nota_id');
        $notas = $request->get('notas');
         
        $nota_id=Notas::where([['seccion_id',$request->get('seccion_id')],['asignatura_id',$request->get('materia')],['periodo_id',$request->get('periodo')]])->get();

        if(count($nota_id)>0){
            #dd($evaluaciones);
             # dd(max($notas));
            foreach ($evaluaciones as $index=>$a) {             
                $item = new NotasItems;
                $item->notas_id = $nota_id[$index]->id;
                 //dd($nota_id[$index]);
                $item->alumno_id = $request->get('estudiante_id');
                $item->calificacion = $notas[$index];
                //dd($item);
                $item->save();
            }
$notaVerify = Notas::with(['notas'=>function($parametro) use ($estudiante_id){
$parametro->where('alumno_id',$estudiante_id);
}])->where('seccion_id', $params['seccion_id'])
                ->where('periodo_id', $params['periodo'] )
                // ->where('asignatura_id', $params['materia'] )
                ->where('asignatura_id', $params['materia'] )
                ->get(); 
        }

else{
    Flash::error('Las calificaciones no se pueden ingresar individualmente. Debe ser ingresada desde el menú Secciones')->important();
    return redirect()->route('listnotessingleadmin',[$estudiante_id,$modulo]);
}
//dd($notaVerify);

return view('admin.academica.expedientesestudiantes.notasindividuales.vernotasindividual',compact('evaluaciones','params','estudiante','asignatura','periodo','notaVerify','modulo'));
}

public function editnotessingleadmin($id,$nota_id,$modulo)
{
$item = NotasItems::find($id);
        return view('admin.academica.expedientesestudiantes.notasindividuales.editarnotasindividual', [
            'item' => $item, 
            'nota_id' => $nota_id,
            'modulo'=> $modulo
        ]);
}

public function updatenotessingleadmin(Request $request)
    {
        $item = NotasItems::find($request->get('id'));
        $item->calificacion = $request->get('notaUpdate');
        $item->observaciones = $request->get('observaciones');
        $item->save();

$datobitacora=Notas::find($item->notas_id);
$this->bitacora(array(
            "operacion" => 'Modificar calificaciones para el estudiante con id '.$item->alumno_id.', '.$datobitacora->evaluacion->nombre.', asignatura '.$datobitacora->asignatura->asignatura.', '.$datobitacora->periodo->descripcion
        ));

return redirect('listnotessingleadmin/'. $request->get('estudiante_id').'/'.$request->get('modulo'));

/*if($request->modulo=='admin')
{
        return redirect('listnotessingleadmin/'. $request->get('estudiante_id').'/'.$request->get('modulo'));
    }
    
    if($request->modulo=='docentes')
    {
       return redirect('addnotessingleadmin');
   }*/

}

  public function vercalificacionesonline($idestudiante)
    {  
$estudiante=Expedienteestudiante::find($idestudiante);
$ciclosacademicos=Periodoactivo::orderBy('anio','DESC')->where([['tipo_periodo','like','ACADEMICO'],['estado',1]])->first();

$periodoconducta=$ciclosacademicos->id;
$anio=$ciclosacademicos->anio;
$consulta = "SELECT tb_matriculaestudiante.seccion_id,tb_expedienteestudiante.v_expediente from tb_matriculaestudiante JOIN tb_expedienteestudiante where  tb_matriculaestudiante.anio=".$anio." AND tb_matriculaestudiante.v_estadomatricula='aprobada' AND tb_expedienteestudiante.id=tb_matriculaestudiante.estudiante_id AND  tb_matriculaestudiante.estudiante_id=".$idestudiante."";
$id_seccion = DB::select( DB::raw($consulta));
$idseccion=$id_seccion[0]->seccion_id;
$exp=$id_seccion[0]->v_expediente;
$varnotas = Notas::with(['notas'=> function ($query) use ($idestudiante){
    $query->where('alumno_id',$idestudiante);
}])->where('seccion_id',$idseccion)->get();

$itemsNotas= $this->orderStudentNota($varnotas);
$criterios=Competenciasciudadanas::where('estado',1)->get();
$a=[];
foreach ($criterios as $key => $value) {
    array_push($a, $value->competencia);
}
$conducta=self::getStudentConducta($idestudiante,$idseccion);
return view('admin.personaldocente.gestionacademica.nominas.consultarinformacionindividual.vercalificacionesindividual',compact('itemsNotas','exp','idseccion','a','conducta','estudiante'));


    }

    private function getStudentConducta($id,$idseccion) {
        $sqlQuery = "SELECT cda.criterio_1, cda.criterio_2, cda.criterio_3, cda.criterio_4, cda.criterio_5, tbe.v_nombres, tbe.v_nie, tbe.v_apellidos, tbm.seccion_id FROM tb_expedienteestudiante as tbe INNER JOIN tb_matriculaestudiante as tbm ON tbm.estudiante_id = tbe.id and tbm.seccion_id={$idseccion} INNER JOIN conducta_alumno as cda ON cda.alumno_id =  tbe.id where cda.alumno_id={$id}";
        return DB::select(
            DB::raw($sqlQuery)
        );
    }

    public function orderStudentNota($varnotas = array())
  {
    $result = array();
    foreach ($varnotas as $item) {
      foreach ($item->notas as $value) {
        $result[$value->alumno->v_expediente]['varnotas'][$item->asignatura->asignatura][$item->periodo->descripcion][$item->evaluacion->codigo_eval] =  floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);

        if($item->evaluacion->codigo_eval=='RF'){
         $result[$value->alumno->v_expediente]['varnotas'][$item->asignatura->asignatura][$item->periodo->descripcion][$item->evaluacion->codigo_eval] = floatval($value->calificacion);
       }

      }
    }
    return $result;
  }

//competencias ciudadanas individuales admin

  public function periodocompetenciasingleadmin($id,$modulo)
  { 
        $periodoescolaractivo=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
        $anio=$periodoescolaractivo->anio;
        $seccion=Expedienteestudiante::with(['estudiante_seccion'=>function ($query) use ($anio){
            $query->where([['tb_matriculaestudiante.v_estadomatricula','aprobada'],['tb_matriculaestudiante.anio',$anio]]);         
        }])->where('id',$id)->first();

    
        if(count($seccion->estudiante_seccion)>0)//esta matriculado este año
        {
            foreach ($seccion->estudiante_seccion as $value) {
               $idseccion=$value->id;
               
            $info=$value->descripcion.' / '.$seccion->v_apellidos.', '.$seccion->v_nombres;
            }
        }
        else
        {
Flash::error("No es posible ingresar calificaciones, el estudiante no está matriculado en ninguna sección.")->important();
return redirect()->route('listaexpedientes');
        }

$periodos = Periodoevaluacion::where('estado', 1)->get();
return view('admin.academica.expedientesestudiantes.competenciasindividuales.selectperiodsingleadmin',compact('periodos','id','estudiante','info','idseccion','modulo'));
  }

public function addcompetenciassingleadmin(Request $request)
{
$params = $request->all();
$modulo=$request->modulo;
$students=Expedienteestudiante::find($request->estudiante_id);
$comp=Competenciasciudadanas::all();
$criterios=$comp;
$competencia = self::getStudentConductaPeriodo($params['estudiante_id'],$params['periodo']);

if (count($competencia) > 0) { 
        
            return redirect('seecompsingleadmin/'. $params['estudiante_id'] .'/'.$params['periodo'].'/'.$modulo);
        }

return view('admin.academica.expedientesestudiantes.competenciasindividuales.registrarcompetenciassingleadmin', compact('students', 'params','comp','criterios','modulo'));
}

 private function getStudentConductaPeriodo($id,$periodo) {
        $sqlQuery = "SELECT cda.id, cda.periodo_id, per.descripcion, cda.criterio_1, cda.criterio_2, cda.criterio_3, cda.criterio_4, cda.criterio_5, tbe.v_nombres, tbe.v_nie, tbe.v_apellidos, tbm.seccion_id FROM tb_expedienteestudiante as tbe INNER JOIN tb_matriculaestudiante as tbm ON tbm.estudiante_id = tbe.id and tbm.estado=1 INNER JOIN conducta_alumno as cda ON cda.alumno_id =  tbe.id 
        INNER JOIN tb_periodoevaluaciones as per ON cda.periodo_id =  per.id where cda.alumno_id= {$id} and cda.periodo_id={$periodo}";
        return DB::select(
            DB::raw($sqlQuery)
        );
    }
   
   public function seecompetenciasingleadmin($id,$periodo,$modulo)
   {
    $competencia = self::getStudentConductaPeriodo($id,$periodo);
    $comp=Competenciasciudadanas::all();

return view('admin.academica.expedientesestudiantes.competenciasindividuales.seeCompetenciassingleadmin', compact('competencia','comp','periodo','id','modulo'));

   }  


public function addSaveCompetenciasingleadmin(Request $request)
{
$modulo=$request->get('modulo');
$item = new Conducta;
        $cr1  = $request->get('cr1');
        $estudiante = $request->get('estudiante_id');
        $periodo = $request->get('periodo');

$item->alumno_id = $estudiante;
            $item->periodo_id = $periodo;
            $item->criterio_1 = $cr1[0];
            $item->criterio_2 = $cr1[1];
            $item->criterio_3 = $cr1[2];
            $item->criterio_4 = $cr1[3];
            $item->criterio_5 = $cr1[4];
            $item->save();
 
 return redirect('seecompsingleadmin/'. $estudiante .'/'.$periodo.'/'.$modulo);
}


public function Editcompetenciasingleadmin($idestudiante,$idperiodo,$modulo)
{
$competencia = self::getStudentConductaPeriodo($idestudiante,$idperiodo);
$comp=Competenciasciudadanas::all();
return view('admin.academica.expedientesestudiantes.competenciasindividuales.editarcompetenciasingleadmin',compact('competencia','comp','idestudiante','idperiodo','criterios','modulo'));

}

public function UpdateCompetenciasingleadmin(Request $request)
{
    $item=Conducta::find($request->get('id'));
        $item->criterio_1=$request->get('cr1');
        $item->criterio_2=$request->get('cr2');
        $item->criterio_3=$request->get('cr3');
        $item->criterio_4=$request->get('cr4');
        $item->criterio_5=$request->get('cr5');
       $item->save(); 
    //dd($item);
       //Flash::success('Competencias ciudadanas  actualizadas exitosamente.')->important();

       return redirect('seecompsingleadmin/'. $request->get('idestudiante') .'/'.$request->get('idperiodo').'/'.$request->get('modulo'));


}
//calificaciones por año desde modulo docentes/historial academico
public function vercalificaciones($idestudiante,$anio)
{
 $consulta = "SELECT tb_matriculaestudiante.seccion_id,tb_expedienteestudiante.v_expediente from tb_matriculaestudiante JOIN tb_expedienteestudiante where  tb_matriculaestudiante.anio=".$anio." AND tb_matriculaestudiante.v_estadomatricula='aprobada' AND tb_expedienteestudiante.id=tb_matriculaestudiante.estudiante_id AND  tb_matriculaestudiante.estudiante_id=".$idestudiante."";
$id_seccion = DB::select( DB::raw($consulta));
$idseccion=$id_seccion[0]->seccion_id;
$exp=$id_seccion[0]->v_expediente;
$estudiante=Expedienteestudiante::find($idestudiante);
$varnotas = Notas::with(['notas'=> function ($query) use ($idestudiante){
    $query->where('alumno_id',$idestudiante);
}])->where('seccion_id',$idseccion)->get();

$itemsNotas= $this->orderStudentNota($varnotas);
$criterios=Competenciasciudadanas::where('estado',1)->get();
$a=[];
foreach ($criterios as $key => $value) {
    array_push($a, $value->competencia);
}

$conducta=self::getStudentConducta($idestudiante,$idseccion);
return view('admin.personaldocente.gestionacademica.nominas.consultarinformacionindividual.vernotashistorialacademico',compact('itemsNotas','estudiante','idseccion','a','conducta','anio','exp'));



}

public function vercalificacionexpedienteadmin($idestudiante,$anio)
{
   
    $consulta = "SELECT tb_matriculaestudiante.seccion_id,tb_expedienteestudiante.v_expediente from tb_matriculaestudiante JOIN tb_expedienteestudiante where  tb_matriculaestudiante.anio=".$anio." AND tb_matriculaestudiante.v_estadomatricula='aprobada' AND tb_expedienteestudiante.id=tb_matriculaestudiante.estudiante_id AND  tb_matriculaestudiante.estudiante_id=".$idestudiante."";
$id_seccion = DB::select( DB::raw($consulta));
$idseccion=$id_seccion[0]->seccion_id;
$exp=$id_seccion[0]->v_expediente;
$estudiante=Expedienteestudiante::find($idestudiante);
$varnotas = Notas::with(['notas'=> function ($query) use ($idestudiante){
    $query->where('alumno_id',$idestudiante);
}])->where('seccion_id',$idseccion)->get();

$itemsNotas= $this->orderStudentNota($varnotas);
$criterios=Competenciasciudadanas::where('estado',1)->get();
$a=[];
foreach ($criterios as $key => $value) {
    array_push($a, $value->competencia);
}

$conducta=self::getStudentConducta($idestudiante,$idseccion);
return view('admin.academica.expedientesestudiantes.notasindividuales.vercalificacionesexpediente',compact('itemsNotas','estudiante','idseccion','a','conducta','anio','exp'));
}

}
