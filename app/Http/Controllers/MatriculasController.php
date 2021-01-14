<?php

namespace App\Http\Controllers;
use App\Http\Requests\EditarsolicitudmatriculaonlineRequest;
use App\Http\Requests\MatriculaRequest;
use Illuminate\Http\Request;
use App\Expedienteestudiante;
use App\Familiares;
use App\Grados;
use App\Seccion;
use App\Turnos;
use App\Periodoactivo;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Bitacora;
use App\Usuario;
use Illuminate\Support\Facades\Auth;

  
class MatriculasController extends Controller
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

	public function index()
	{ 
		$this->bitacora(array(
			"operacion" => 'Consultar lista de estudiantes matriculados'
		));

$periodoescolaractivo=Periodoactivo::orderBy('id','DESC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
if($periodoescolaractivo==null){
	Flash::warning("ACTUALMENTE NO CUENTA CON UN CICLO O AÑO ESCOLAR ACTIVO.<br> SE RECOMIENDA COMPLETAR EL REGISTRO DE UN NUEVO CICLO ESCOLAR E INICIAR LAS CONFIGURACIONES PARA SECCIONES, HORARIOS DE CLASES, Y PERIODOS DE EVALUACION PARA UN OPTIMO FUNCIONAMIENTO DE LA APLICACION.")->important(); 
    return redirect()->route('registrarcicloacademico');
}
else{
$anio=$periodoescolaractivo->anio;
$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) use ($anio){//use se pasa un parametro externo al filtro 
$q->where([['tb_matriculaestudiante.estado','=','1'],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.anio','=',$anio]]);}])->where('estado','=','1')->get();


return view('admin.academica.matricula.listadealumnosmatriculados')->with('datos',$datos)->with('anio',$anio);
}	
}

	
public function registrarmatricula() 
	{
$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoescolaractivo->anio;

$anios=Periodoactivo::orderBy('id','ASC')->where('tipo_periodo','like','ACADEMICO')->pluck('anio','anio');
//$anio=$periodoescolaractivo->anio;
$estudiantes=Expedienteestudiante::orderBy('id','ASC')->whereDoesntHave('estudiante_seccion', function($query) use ($anio){
$query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1']]);
})->where('estado','=','1')->get();
		$fecha = Carbon::today();
		$fecha=$fecha->format('d/m/Y');
		$grados=Grados::orderBy('id','ASC')->where('estado','=','1')->pluck('grado','id');


		return view('admin.academica.matricula.agregarmatricula')->with('estudiantes',$estudiantes)->with('fecha',$fecha)->with('grados',$grados)->with('anios',$anios);	
}

	public function guardarmatricula(MatriculaRequest $request)
	{
		//dd($request);
		$this->bitacora(array(
			"operacion" => 'Matricular estudiante con id '.$request->estudiante_id
		));
	$estudiante=Expedienteestudiante::find($request->estudiante_id);
	$formato = Carbon::createFromFormat('d/m/Y',$request->fecha);
	//$anio=Periodoactivo::periodoescolar()->first();
	$anio=$request->anio;
	$f_fechamatricula = $formato->format('Y/m/d');

	//REGISTRO LA MATRICULA
	$estudiante->estudiante_seccion()->attach($request->seccion_id,['f_fechamatricula'=>$f_fechamatricula,'v_nuevoingresoSN'=>$request->v_nuevoingresoSN,'v_presentocertificadoSN'=>$request->certificadoRadios,'v_procesoenlineaSN'=>'no','v_trasladoSN'=>$request->trasladoRadios,'v_centroescolarorigen'=>$request->txtcentroorigen,'v_observaciones'=>$request->txtobservaciones,'v_estadomatricula'=>'aprobada','estado'=>'1','anio'=>$anio,'modalidad'=>'Presencial','familiar_exp'=>$request->familiar_exp,'familiar_nombre'=>$request->familiar_nombre,'matricula'=>$request->matriculaRadios]);

	 
		Flash::success("El estudiante ". $estudiante->v_nombres ." ". $estudiante->v_apellidos . " ha sido matriculado con éxito")->important();
		return redirect()->route('listadematriculados');
}

public function secciones($id)//segun el grado seleccionado enviara las secciones asociadas a el
	{

	//BUSCANDO EL NUMERO DE CUPOS OCUPADOS AHORITA POR CADA SECCION
$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoescolaractivo->anio;

$secciones=Seccion::withCount([
    'seccion_estudiante', 
    'seccion_estudiante as cuposocupados' => function ($query) use ($anio){
    $query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
    }])->where('estado','=','1')->where('grado_id','=',$id)->get();
return response()->json($secciones);
	}

public function turnos($id)//enviare los datos de turno y empleado de acuerdo a la seccion seleccionada
	{
$seccion=Seccion::orderBy('id')->where('id','=',$id)->get();
$seccion->each(function($seccion){$seccion->seccion_turno;});//SACO EL NOMBRE DEL TURNO
$seccion->each(function($seccion){$seccion->seccion_empleado;});//SACO EL NOMBRE DEL EMPLEADO
		return response()->json($seccion);
	}

	public function familiaresporestudiante($id)//id del estudiante para buscar los familiares asociados a el
	{
		//CONSULTAR TABLA PIVOTE
	$estudiante=Expedienteestudiante::find($id)->estudiante_familiares()->orderBy('id')->get();//extraigo los datos de los familiares de un estudiante
	return response()->json($estudiante);
	}

	public function verdetallematriculaonline($id)
	{
	$anio=Periodoactivo::periodoescolar()->first();//uso el scope para sacar el periodo activo
	$anio=$anio->anio;

$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) use ($anio){//use pasa un parametro externo al filtro 
$q->where([['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','pendiente'],['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.modalidad','like','online']]);}])->where('id','=',$id)->first();
//dd($datos);
foreach ($datos->estudiante_seccion as $pivote) {	
	$fecha = $pivote->pivot->f_fechamatricula;	
	$formato = Carbon::createFromFormat('Y-m-d',$fecha);
	$fecha = $formato->format('d/m/Y');
}
return view('admin.academica.matricula.verdetallematriculaonline')->with('datos',$datos)->with('fecha',$fecha);	
}

	public function listadesolicitudesenlinea()
	{
$anio=Periodoactivo::periodoescolar()->first();//uso el scope para sacar el periodo activo
if($anio==null){
	Flash::warning("ACTUALMENTE NO CUENTA CON UN CICLO O AÑO ESCOLAR ACTIVO.<br> SE RECOMIENDA COMPLETAR EL REGISTRO DE UN NUEVO CICLO ESCOLAR E INICIAR LAS CONFIGURACIONES PARA SECCIONES, HORARIOS DE CLASES, Y PERIODOS DE EVALUACION PARA UN OPTIMO FUNCIONAMIENTO DE LA APLICACION.")->important(); 
    return redirect()->route('registrarcicloacademico');
}
else{	
$anio=$anio->anio;
$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) use ($anio){//use se pasa un parametro externo al filtro 
$q->where([['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','pendiente'],['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.modalidad','like','online']]);}])->where('estado','=','1')->get();

//dd($datos);
return view('admin.academica.matricula.solicitudespendientesdeaprobar')->with('datos',$datos)->with('anio',$anio);
}	
	}

	public function aprobarsolicitudmatriculaonline($idestudiante,$idseccion)
	{
$estudiante=Expedienteestudiante::find($idestudiante);
Expedienteestudiante::find($idestudiante)->estudiante_seccion()->updateExistingPivot($idseccion, ['v_estadomatricula'=>'aprobada']);
Flash::success('La solicitud de matrícula a sido APROBADA')->important();
return redirect()->route('listasolicitudesmatricula');
}

	public function eliminarsolicitudmatriculaonline($idestudiante,$idseccion)
	{
		$estudiante=Expedienteestudiante::find($idestudiante);
		$estudiante->estudiante_seccion()->detach($idseccion);//como la asociacion estudianteid-seccionid no se va repetir nunca, para el retiro de la matricula eliminare directamente al estudiante asociado a la seccion que me indique.
		Flash::error('La solicitud del estudiante '.$estudiante->v_nombres.' '. $estudiante->v_apellidos.' a sido denegada')->important();
		 return redirect()->route('listasolicitudesmatricula');
	}

public function editarsolicitudmatriculaonline($idestudiante,$idmatricula,$idseccion)
{
	$anio=Periodoactivo::periodoescolar()->first();//uso el scope para sacar el periodo activo
	$anio=$anio->anio;

$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) use ($anio){//use pasa un parametro externo al filtro 
$q->where([['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','pendiente'],['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.modalidad','like','online']]);}])->where('id','=',$idestudiante)->first();
//dd($datos);
foreach ($datos->estudiante_seccion as $pivote) 
{	
	$fecha = $pivote->pivot->f_fechamatricula;	
	$formato = Carbon::createFromFormat('Y-m-d',$fecha);
	$fecha = $formato->format('d/m/Y');
	$gradoid=$pivote->grado_id;
}
//dd($gradoid);
$listasecciones=Seccion::cupos($anio,$gradoid)->get()->pluck('seccion_full','id');//aca traigo el detalle de las secciones con sus correspondientes cupos (he utilizado un scope)
$grados=Grados::orderBy('id','ASC')->where('estado','=','1')->pluck('grado','id');

return view('admin.academica.matricula.editarsolicitudmatriculaonline')->with('datos',$datos)->with('fecha',$fecha)->with('listasecciones',$listasecciones)->with('grados',$grados);	
}

 public function actualizarmatriculaonline(EditarsolicitudmatriculaonlineRequest $request,$idestudiante,$idmatricula,$idseccion)
	 {
//dd($request);
$estudiante=Expedienteestudiante::find($idestudiante);
Expedienteestudiante::find($idestudiante)->estudiante_seccion()->updateExistingPivot($idseccion, ['seccion_id'=>$request->seccion_id]);
 	
Flash::success('La matrícula del estudiante '.$estudiante->v_nombres.' '. $estudiante->v_apellidos.' a sido actualizada con éxito')->important();
return redirect()->route('listasolicitudesmatricula');

	 }

public function vermatricula($idestudiante,$idmatricula,$idseccion) 
	{		
$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) use ($idmatricula){
$q->where('tb_matriculaestudiante.id','=',$idmatricula);}])->where('id','=',$idestudiante)->first();
$datosaux=$datos;//copio la variable con la coleccion, para poder extraer la fecha y darle formato d/m/y
	
foreach ($datosaux->estudiante_seccion as $datosaux) {//para darle formato a la fecha
$formato = Carbon::createFromFormat('Y-m-d',$datosaux->pivot->f_fechamatricula);
$fecha=$formato->format('d/m/Y');
}
$seccion=Seccion::where([['estado','=','1'],['id','=',$idseccion]])->first();
$seccion->each(function($seccion){
$seccion->seccion_turno;
$seccion->seccion_grado;
$seccion->seccion_empleado;
});
return view('admin.academica.matricula.vermatricula')->with('datos',$datos)->with('seccion',$seccion)->with('fecha',$fecha);	
	}

public function editarmatricula($idestudiante,$idmatricula,$idseccion)
	 {
/*
	 		$res=Seccion::cuposMatricula()->get();
	 		$seccion=Seccion::seccion($idseccion)->get();//este es un scope, en el modelo Seccion he creado una funcion que me devuelve los datos de una seccion con id $idseccion que le envio como parametrod esde este controlador
		dd($seccion);
*/
$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) use ($idmatricula){
$q->where('tb_matriculaestudiante.id','=',$idmatricula);}])->where('id','=',$idestudiante)->first();
$datosaux=$datos;//copio la variable con la coleccion, para poder extraer la fecha y darle formato d/m/y
	
foreach ($datosaux->estudiante_seccion as $datosaux) {//para darle formato a la fecha
$formato = Carbon::createFromFormat('Y-m-d',$datosaux->pivot->f_fechamatricula);
$fecha=$formato->format('d/m/Y');
$gradoid=$datosaux->grado_id;
}
$seccion=Seccion::where([['estado','=','1'],['id','=',$idseccion]])->first();
$seccion->each(function($seccion){
$seccion->seccion_turno;
$seccion->seccion_grado;
$seccion->seccion_empleado;
});
$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoescolaractivo->anio;

$listasecciones=Seccion::cupos($anio,$gradoid)->get()->pluck('seccion_full','id');//aca traigo el detalle de las secciones con sus correspondientes cupos (he utilizado un scope)
$grados=Grados::orderBy('id','ASC')->where('estado','=','1')->pluck('grado','id');
return view('admin.academica.matricula.editarmatricula')->with('grados',$grados)->with('fecha',$fecha)->with('datos',$datos)->with('seccion',$seccion)->with('listasecciones',$listasecciones);
	 }

	 public function actualizarmatricula(MatriculaRequest $request,$idestudiante,$idmatricula,$idseccion)
	 {
//dd($request);
	 	$this->bitacora(array(
			"operacion" => 'Modificar matricula del estudiante con id '.$idestudiante,
		));
$estudiante=Expedienteestudiante::find($idestudiante);
$f_fechamatricula = $request->fecha;
$formato = Carbon::createFromFormat('d/m/Y',$f_fechamatricula);
$f_fechamatricula = $formato->format('Y-m-d');

Expedienteestudiante::find($idestudiante)->estudiante_seccion()->updateExistingPivot($idseccion, ['f_fechamatricula'=>$f_fechamatricula,'v_nuevoingresoSN'=>$request->v_nuevoingresoSN,'v_presentocertificadoSN'=>$request->certificadoRadios,'seccion_id'=>$request->seccion_id,'familiar_exp'=>$request->familiar_exp,'familiar_nombre'=>$request->familiar_nombre,'v_trasladoSN'=>$request->trasladoRadios,'v_centroescolarorigen'=>$request->txtcentroorigen,'v_observaciones'=>$request->txtobservaciones,'matricula'=>$request->matriculaRadios]);
 	
Flash::success('La matrícula del estudiante '.$estudiante->v_nombres.' '. $estudiante->v_apellidos.' a sido actualizada con éxito')->important();
return redirect()->route('listadematriculados');
	 }
	 public function retirarmatricula($idestudiante,$idseccion)
	 {
	 	$estudiante=Expedienteestudiante::find($idestudiante);
		$estudiante->estudiante_seccion()->detach($idseccion);//como la asociacion estudianteid-seccionid no se va repetir nunca, para el retiro de la matricula eliminare directamente al estudiante asociado a la seccion que me indique.
		Flash::error('La matrícula del estudiante '.$estudiante->v_nombres.' '. $estudiante->v_apellidos.' a sido retirada con éxito')->important();
		 return redirect()->route('listadematriculados');
	 }

	 public function matriculaestudianteanio($anio)
	 {
$estudiante=Expedienteestudiante::orderBy('id','ASC')->whereDoesntHave('estudiante_seccion', function($query) use ($anio){
$query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1']]);
})->where('estado','=','1')->get();
	return response()->json($estudiante);
	 }



}
