<?php

namespace App\Http\Controllers;
use App\Http\Requests\MatriculaonlineestudianteRequest;
use Illuminate\Http\Request;
use App\Expedienteestudiante;
use App\Grados;
use Illuminate\Support\Facades\Auth;
use App\Usuario;
use App\Periodohabilmatriculaonline;
use App\Periodoactivo;
use App\Periodoevaluacion;
use App\Seccion;
use App\Turnos;
use App\HorarioClases;
use App\Notas;
use App\NotasItems;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Competenciasciudadanas;

class ModuloestudianteonlineController extends Controller
{ 
    public function index()
	{
//cargar pantalla inicial del modulo
	}
    public function registrarsolicitudmatricula()
	{
$hoy=Carbon::today();
$periodoactivo=Periodohabilmatriculaonline::where('tipo_periodo','Like','MATRICULA GENERAL')->where([['estado','1'],['f_fechadesde','<=',$hoy],['f_fechahasta','>=',$hoy]])->get();//saco el periodo de inscripcion activo y vigente

	foreach ($periodoactivo as $periodoactivo) 
	{
	if($periodoactivo!=null)//si hay un periodo de inscripcion activo muestre el formulario
	{	
		if(Auth::user()->estudiante_id!=null)//si el ususario logeado es estudiante
		{
$idestudiante=Auth::user()->estudiante_id;
$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$periodocount=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->count();
if(!$periodocount>0){

return redirect()->route('avisomatriculaonline');
}//si no hay un año ecolar activo redirecciona a error
$anio=$periodoactivo->anio;
//si el estudiante logeado no esta matriculado en el año lectivo actual
$existematricula=Expedienteestudiante::whereHas('estudiante_seccion', function($query) use ($anio){
$query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1']]);
})->where([['estado','=','1'],['id','=',$idestudiante]])->first();//consulto si el estudiante logeado tiene algun registro de matricula que sea de este periodoescolar activo


if($existematricula==null)//estudiante no esta matriculado
{	
$existesolicitud=Expedienteestudiante::whereHas('estudiante_seccion', function($query) use ($anio){
$query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.v_estadomatricula','=','pendiente'],['tb_matriculaestudiante.modalidad','=','Online']]);
})->where([['estado','=','1'],['id','=',$idestudiante]])->first();

if($existesolicitud==null)//si estudiante no tiene una solicitud de matricula enviada
{
	//si estudiante ya ha estado matriculado, sacara el ultimo grado donde se matriculo para habilitar el grado siguiente
	
$ultimamatricula=Expedienteestudiante::with('estudiante_seccion')->whereHas('estudiante_seccion', function($query) use ($anio){
$query->where([['tb_matriculaestudiante.anio','=',$max=Periodoactivo::where('tipo_periodo','like','ACADEMICO')->max('anio')-1],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
})->where([['estado','=','1'],['id','=',$idestudiante]])->first();

//saco la info de la matricula de este año para ese estudiante, si el resultado es null entonces no tiene matricula 

$sqlQuery="SELECT tb_grados.id,tb_grados.grado,tb_secciones.*,tb_secciones.descripcion,tb_matriculaestudiante.anio FROM tb_grados INNER JOIN tb_secciones INNER JOIN tb_matriculaestudiante  WHERE tb_grados.id=tb_secciones.grado_id AND tb_matriculaestudiante.v_estadomatricula='aprobada' AND tb_matriculaestudiante.anio=".$max=Periodoactivo::where('tipo_periodo','like','ACADEMICO')->max('anio')." AND tb_matriculaestudiante.seccion_id=tb_secciones.id AND tb_matriculaestudiante.estudiante_id=".$idestudiante; 
$matriculaanioactual = DB::select($sqlQuery);

if(count($matriculaanioactual)>0)
{
return redirect()->route('aviso_estudiantematriculado');
}
 
$ultimoaniocursado=$anio-1 ;
$sqlQuery="SELECT tb_grados.id,tb_grados.grado,tb_secciones.*,tb_secciones.descripcion,tb_matriculaestudiante.anio FROM tb_grados INNER JOIN tb_secciones INNER JOIN tb_matriculaestudiante  WHERE tb_grados.id=tb_secciones.grado_id AND tb_matriculaestudiante.v_estadomatricula='aprobada' AND tb_matriculaestudiante.anio=".$ultimoaniocursado." AND tb_matriculaestudiante.seccion_id=tb_secciones.id AND tb_matriculaestudiante.estudiante_id=".$idestudiante; 

$matriculaanioanterior = DB::select( DB::raw($sqlQuery));
if(count($matriculaanioanterior)>0)//si hay un historial de matricula para ese estudiante 
{

		$fecha = Carbon::today();
		$fecha=$fecha->format('d/m/Y');
		$hoy=Carbon::today();	
		$hoy= $hoy->format('Y-m-d');
		
foreach ($matriculaanioanterior as $key => $value) {
	$ultimogrado=$value->grado_id;
}

$grados=Grados::find($ultimogrado+1);//envia el grado siguiente 
$datosestudiante=Auth::user()->estudiante;
return view('admin.moduloenlineaestudiantes.solicitudmatriculaenlinea',compact('fecha','grados','datosestudiante','anio'));
} 
else{

return redirect()->route('avisoprimeramatricula');//si es primera matricula no va poder hacerlo online
}
}//ifexistesolicitud
if($existesolicitud!=null)//el estudiante si tiene una solicitud de matricula enviada
		{

return redirect()->route('aviso_estudiantematriculado');
		}	
}//if existematricula
			
if($existematricula!=null)//el estudiante si esta matriculado
		{
return redirect()->route('aviso_estudiantematriculado');
		}		
	}//si es estudiante
}
}
	if(!isset($periodoactivo->id))
		{		
			return redirect()->route('avisomatriculaonline');
}
	
	}

public function avisoprimeramatricula()
	{
	return view('admin.moduloenlineaestudiantes.aviso_primeramatriculaestudiante');
}

	 public function avisomatriculaonline()
	{
		$fecha = Carbon::today();
		$fecha=$fecha->format('d/m/Y');
	return view('admin.moduloenlineaestudiantes.avisomatriculaonline',compact('fecha'));
}
public function aviso_estudiantematriculado()
	{
	return view('admin.moduloenlineaestudiantes.aviso_estudiantematriculado');
}

 public function avisohorarioclases()
	{
	return view('admin.moduloenlineaestudiantes.avisohorarioclases');
}


public function guardarsolicitudmatriculaonline(MatriculaonlineestudianteRequest $request)
	{
		//dd($request);
	$estudiante=Expedienteestudiante::find($request->estudiante_id);
	$formato = Carbon::createFromFormat('d/m/Y',$request->f_fechamatricula);
	$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoescolaractivo->anio;
	$f_fechamatricula = $formato->format('Y/m/d');

	//REGISTRO LA MATRICULA
	$estudiante->estudiante_seccion()->attach($request->seccion_id,['f_fechamatricula'=>$f_fechamatricula,'v_presentocertificadoSN'=>'no','v_procesoenlineaSN'=>'si','v_trasladoSN'=>'no','v_centroescolarorigen'=>null,'v_observaciones'=>null,'v_estadomatricula'=>'pendiente','estado'=>'1','anio'=>$anio,'modalidad'=>'Online','matricula'=>'1','familiar_exp'=>null,'familiar_nombre'=>null]);

	Flash::success("Solicitud de matricula enviada exitosamente")->important();
		return redirect()->route('menu');
	}
	public function verexpedienteonline($id)
	{
//dd('va');
return view('admin.moduloenlineaestudiantes.expedientecompleto_moduloestudiante');
	}

	public function seccionesonline($id)//segun el grado seleccionado enviara las secciones asociadas a el
	{
$anio=Periodohabilmatriculaonline::where('tipo_periodo','like','MATRICULA GENERAL')->max('anio');
$secciones=Seccion::withCount([
    'seccion_estudiante', 
    'seccion_estudiante as cuposocupados' => function ($query) use ($anio){ 
    $query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
    }])->where([['estado','=','1'],['anio',$anio]])->where('grado_id','=',$id)->get();
return response()->json($secciones);
	}

public function turnosonline($id)//enviare los datos de turno y empleado de acuerdo a la seccion seleccionada
	{
$seccion=Seccion::orderBy('id')->where('id','=',$id)->get();
$seccion->each(function($seccion){$seccion->seccion_turno;});//SACO EL NOMBRE DEL TURNO
$seccion->each(function($seccion){$seccion->seccion_empleado;});//SACO EL NOMBRE DEL EMPLEADO

		return response()->json($seccion);
	}

public function horariodeclasesestudianteonline($id)
{

$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$periodoEA=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->count();

if(!$periodoEA>0){
return redirect()->route('avisohorarioclases');
}
$anio=$periodoescolaractivo->anio;	

$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id FROM  tb_matriculaestudiante where tb_matriculaestudiante.anio = ".$anio." AND estudiante_id = ".$id;
$seccion = DB::select( DB::raw($sqlQuery));

if(count($seccion)>0)//devuelve una seccion
{
	foreach ($seccion as  $value) {
	$id=$value->seccion_id;	
		}

	$horario = HorarioClases::where([['estado','=','1'],['anio','=',$anio],['tb_horario_clases.seccion_id','=',$id]])
    	->orderBy('id','ASC')->get();
    	$horario->each(function($horario){ 
			$horario->horario_asignatura;
			$horario->horario_docente; 
			$horario->horario_bloque;
		});

	if(!count($horario)>0){
	return redirect()->route('avisohorarioclases');	
	}

//	if(!count($horario>0)){return redirect()->route('aviso_estudiantematriculado');}//no hay informacion para mostrar
		$seccion=Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'))
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.id','=',$id)
            ->first();
        $lista[]=null;
		$d=0;
		$b=0;
		$nbloq=$horario->first()->horario_bloque->id;
		foreach ($horario as $horario) {
			if($nbloq!=$horario->horario_bloque->id){
				$b++;
				$d=0;
				$nbloq=$horario->horario_bloque->id;
			}
			$lista[$b][$d][0] = date('g:i A',strtotime($horario->horario_bloque->hora_inicio)) .' - '. date('g:i A',strtotime($horario->horario_bloque->hora_fin));
			$lista[$b][$d][1] = $horario->horario_bloque->tipo_bloque;
			if($horario->horario_bloque->tipo_bloque=='Clase') {
				$lista[$b][$d][2] = $horario->horario_asignatura->asignatura;
				$lista[$b][$d][3] = $horario->horario_docente->v_nombres . ' ' . $horario->horario_docente->v_apellidos;
			}else{
				$lista[$b][$d][2] = null;
				$lista[$b][$d][3] = null;
			}
			$d++;						
		}
		//dd($lista);
		return view('admin.moduloenlineaestudiantes.horariodeclasesestudianteonline')->with('horario',$lista)->with('seccion',$seccion->grado)->with('b',$b);




}
else//no hay una seccion para sacar un horario de clases
{
return redirect()->route('avisohorarioclases');
}	
}

public function calificacionesestudianteonline($id)
{

$ciclosacademicos=Periodoactivo::orderBy('anio','DESC')->where('tipo_periodo','like','ACADEMICO')->get();
$estudiante=Expedienteestudiante::find($id);
return view('admin.moduloenlineaestudiantes.calificacionesestudianteonline',compact('estudiante','ciclosacademicos'));
}



public function detallecalificacionesonline(Request $request)
{
//dd($request);
	$anio=Periodoactivo::find($request->anio);
	$anio=$anio->anio;	
	$idestudiante=$request->idestudiante;
	$seccion=Expedienteestudiante::with(['estudiante_seccion'=>function ($query) use ($anio){
            $query->where([['tb_matriculaestudiante.v_estadomatricula','aprobada'],['tb_matriculaestudiante.anio',$anio]]);    		
    	}])->where('id',$idestudiante)->first();

 if(count($seccion->estudiante_seccion)>0)//esta matriculado este año
        {
            foreach ($seccion->estudiante_seccion as $value) {
               $idseccion=$value->id;
               $exp=$seccion->v_expediente;
$varnotas = Notas::with(['notas'=> function ($query) use ($idestudiante){
	$query->where('alumno_id',$idestudiante);
}])->where('seccion_id', $idseccion)
				->get();
				
 $itemsNotas= $this->orderStudentNota($varnotas);
$criterios=Competenciasciudadanas::where('estado',1)->get();
$a=[];
foreach ($criterios as $key => $value) {
    array_push($a, $value->competencia);
}
 $conducta=self::getStudentConducta($idestudiante,$idseccion); 
return view('admin.moduloenlineaestudiantes.detallecalificacionesonline',compact('itemsNotas','idestudiante','exp','conducta','a'));
            }
        }
        else
        {      
Flash::error("No es posible ver las calificaciones, el estudiante no está matriculado en el año académico seleccionado.")->important();
return redirect()->route('historialcalificacionesestudianteonline',$idestudiante);
        }
}

	public function orderStudentNota($varnotas = array())
  {
    $result = array();
    foreach ($varnotas as $item) {
      foreach ($item->notas as $value) {
        $result[$value->alumno->v_expediente]['varnotas'][$item->asignatura->asignatura][$item->periodo->descripcion][$item->evaluacion->codigo_eval] =  floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);
      }
    }
    return $result;
  }

private function getStudentConducta($id,$seccion_id) {
		$sqlQuery = "SELECT cda.criterio_1, cda.criterio_2, cda.criterio_3, cda.criterio_4, cda.criterio_5, tbe.v_nombres, tbe.v_nie, tbe.v_apellidos, tbm.seccion_id FROM tb_expedienteestudiante as tbe INNER JOIN tb_matriculaestudiante as tbm ON tbm.estudiante_id = tbe.id and tbm.seccion_id={$seccion_id} INNER JOIN conducta_alumno as cda ON cda.alumno_id =  tbe.id where cda.alumno_id={$id}" ;
        return DB::select(
            DB::raw($sqlQuery)
		);
	}


public function trimestres($id)
	{
$trimestres=Periodoevaluacion::where('periodo_id',$id)->get();
return response()->json($trimestres);
	}

//consultar calificaciones online estudiante

	public function vercalificacionesonlineestudiante($idestudiante)
	{
		//dd('aca');
$varnotas   = Notas::where('seccion_id', $id)->get();
    if(!count($notas)>0)//si no hay notas entonces
    {

    }

	}

}
