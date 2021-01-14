<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expedienteestudiante;
use App\Grados;
use App\Familiares;
use App\Periodoactivo; 
use App\Usuario;
use App\BloqueHorarios;
use App\Asignaturas;
use App\Empleado;
use App\Seccion;
use App\HorarioClases;
use App\Http\Requests\DatosPersonalesFamiliaresRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Periodohabilmatriculaonline;
use Laracasts\Flash\Flash;
use Carbon\Carbon;


class ModulopadresdefamiliaonlineController extends Controller
{
    public function misestudiantes($id)
    {
	$estudiante=Familiares::find($id)->familiares_estudiante()->with('estudiante_usuario')->get();
	return view('admin.moduloenlineapadres.misestudiante',compact('estudiante'));
    }


 public function asistenciasestudiantes($idestudiante)
    {
$estudiante=Expedienteestudiante::find($idestudiante);
$ciclosacademicos=Periodoactivo::orderBy('anio','DESC')->where('tipo_periodo','like','ACADEMICO')->get();
return view('admin.moduloenlineapadres.asistenciasestudiantes',compact('estudiante','ciclosacademicos'));

    }

    public function avisoerror($tipoerror)
    {
    return view('admin.moduloenlineapadres.avisoexceptionmatricula');	

    }
     public function avisosindatos()
    {
    return view('admin.moduloenlineapadres.aviso_busquedasinresultados');
	}


    public function asesorseccion($idestudiante)
    {
    	$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
		$anio=$periodoescolaractivo->anio;


		$sqlQuery = "SELECT tb_secciones.empleado_id FROM tb_secciones inner join  tb_matriculaestudiante where tb_matriculaestudiante.anio = ".$anio." AND estudiante_id = ".$idestudiante." AND tb_secciones.id=tb_matriculaestudiante.seccion_id";
		$asesor_id = DB::select( DB::raw($sqlQuery));


		if(!count($asesor_id)>0)//NO esta matriculado
		{
Flash::error('Actualmente ésta sección no tiene un docente asesor asignado.')->important();
	return redirect()->route('estudiantes_familiares',Auth::user()->familiar->id);
		}

		foreach ($asesor_id as $key => $asesor_id) {
			$asesor_id=$asesor_id->empleado_id;
		}
		
		$asesor=Empleado::with('empleado_seccion')->with('usuarios')->where('id',$asesor_id)->first();
		//dd($asesor);
	return view('admin.moduloenlineapadres.infoasesordeseccion',compact('asesor'));    	
    }

    public function historialcalificaciones($idestudiante)
    {
$estudiante=Expedienteestudiante::find($idestudiante);
$ciclosacademicos=Periodoactivo::orderBy('anio','DESC')->where('tipo_periodo','like','ACADEMICO')->get();
return view('admin.moduloenlineapadres.calificacionesestudiantes',compact('estudiante','ciclosacademicos'));
    }

    public function horariosdeclases($idestudiante)
    {
      	//$estudiante=Expedienteestudiante::find($idestudiante);
    	$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
		$anio=$periodoescolaractivo->anio;

		$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id FROM  tb_matriculaestudiante where tb_matriculaestudiante.anio = ".$anio." AND estudiante_id = ".$idestudiante;
		$idseccion = DB::select( DB::raw($sqlQuery));

		if(count($idseccion)>0){//si esta matriculado muestre la informacion
		foreach ($idseccion as $key => $value) {
			$id=$value->seccion_id;
		}
	
		$horario = HorarioClases::where([['estado','=','1'],['anio','=',$anio],['tb_horario_clases.seccion_id','=',$id]])
    	->orderBy('id','ASC')->get();
    	$horario->each(function($horario){ 
			$horario->horario_asignatura;
			$horario->horario_docente; 
			$horario->horario_bloque;
		});
		//dd($horario);
		if(!count($horario)>0)
		{
	Flash::error('Estimado padre de familia, en este momento el estudiante no tiene un  horario de clases definido.')->important();
	return redirect()->route('estudiantes_familiares',Auth::user()->familiar->id);
		}

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

		//dd($horario);
		return view('admin.moduloenlineapadres.horariodeclases')->with('horario',$lista)->with('seccion',$seccion->grado)->with('b',$b)->with('idseccion',$id);
	}//fin verify
	else{
	Flash::error('Estimado padre de familia, en este momento el estudiante no tiene un  horario de clases definido.')->important();
	return redirect()->route('estudiantes_familiares',Auth::user()->familiar->id);
	}
		
	
    }

     public function matriculaenlinea($idestudiante)
    {
$hoy=Carbon::today();
$periodoactivo=Periodohabilmatriculaonline::where('tipo_periodo','Like','MATRICULA GENERAL')->where([['estado','1'],['f_fechadesde','<=',$hoy],['f_fechahasta','>=',$hoy]])->get();//saco el periodo de inscripcion activo y vigente	
	foreach ($periodoactivo as $periodoactivo) 
	{

	if($periodoactivo!=null)//si hay un periodo de inscripcion activo muestre el formulario
	{	
$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoactivo->anio;
$periodocount=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->count();
if(!$periodocount>0){
return redirect()->route('avisomatriculaonline');}

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
//si estudiante ya ha estado matriculado, sacara el ultimo grado deonde se matriculo para habilitar el grado siguiente
	
$ultimamatricula=Expedienteestudiante::with('estudiante_seccion')->whereHas('estudiante_seccion', function($query) use ($anio){
$query->where([['tb_matriculaestudiante.anio','=',$max=Periodoactivo::where('tipo_periodo','like','ACADEMICO')->max('anio')-1],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
})->where([['estado','=','1'],['id','=',$idestudiante]])->first();

//saco la info de la matricula de este año para ese estudiante, si el resultado es null entonces no tiene matricula 

$sqlQuery="SELECT tb_grados.id,tb_grados.grado,tb_secciones.*,tb_secciones.descripcion,tb_matriculaestudiante.anio FROM tb_grados INNER JOIN tb_secciones INNER JOIN tb_matriculaestudiante  WHERE tb_grados.id=tb_secciones.grado_id AND tb_matriculaestudiante.v_estadomatricula='aprobada' AND tb_matriculaestudiante.anio=".$max=Periodoactivo::where('tipo_periodo','like','ACADEMICO')->max('anio')." AND tb_matriculaestudiante.seccion_id=tb_secciones.id AND tb_matriculaestudiante.estudiante_id=".$idestudiante; 

$matriculaanioactual = DB::select( DB::raw($sqlQuery));
if(count($matriculaanioactual)>0)
{
	Flash::error('Estimado padre de familia, el proceso de matricula no puede ser completado. El estudiante no fue matriculado en el Centro Escolar el último año.')->important();
	return redirect()->route('estudiantes_familiares',Auth::user()->familiar->id);
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
//dd($matriculaanioanterior);		
foreach ($matriculaanioanterior as $key => $value) 
{
	$ultimogrado=$value->grado_id;
	
}
$grados=Grados::find($ultimogrado+1);
//$secciones=Seccion::where([['grado_id',$grados->id],['estado',1],['anio',$anio]])->pluck('seccion','id');

$datosestudiante=Expedienteestudiante::find($idestudiante);
return view('admin.moduloenlineapadres.matriculaestudianteonline')->with('fecha',$fecha)->with('grados',$grados)->with('datosestudiante',$datosestudiante)->with('anio',$anio);
} 
else{
	Flash::error('Estimado padre de familia, el proceso de matricula para estudiantes de nuevo ingreso no puede ser realizado en línea.')->important();
	return redirect()->route('estudiantes_familiares',Auth::user()->familiar->id);
}
}//ifexistesolicitud
if($existesolicitud!=null)//el estudiante si tiene una solicitud de matricula enviada
		{
Flash::error('Estimado padre de familia, el proceso de matricula en linea no puede completarse debido a que el estudiante ya cuenta con una solicitud activa.')->important();
	return redirect()->route('estudiantes_familiares',Auth::user()->familiar->id);
		}	
}//if existematricula
			
if($existematricula!=null)//el estudiante si esta matriculado
		{
	Flash::error('Estimado padre de familia, el proceso de matricula en linea no puede ser completado debido a que el estudiante ya se encuentra matriculado.')->important();
	return redirect()->route('estudiantes_familiares',Auth::user()->familiar->id);
		}		
	}//si es estudiante

}
	if(!isset($periodoactivo->id))
	{	
		return redirect()->route('avisoerror',1);
		}

 	}

 	public function seccionmatricula($id)//segun el grado seleccionado enviara las secciones asociadas a el
	{
$anio=Periodohabilmatriculaonline::where('tipo_periodo','like','MATRICULA GENERAL')->max('anio');
$secciones=Seccion::withCount([
    'seccion_estudiante', 
    'seccion_estudiante as cuposocupados' => function ($query) use ($anio){
    $query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
    }])->where([['estado','=','1'],['anio',$anio]])->where('grado_id','=',$id)->get();
return response()->json($secciones);
	}

public function turnomatriculaonline($id)//enviare los datos de turno y empleado de acuerdo a la seccion seleccionada
	{
$seccion=Seccion::orderBy('id')->where('id','=',$id)->get();
$seccion->each(function($seccion){$seccion->seccion_turno;});//SACO EL NOMBRE DEL TURNO
$seccion->each(function($seccion){$seccion->seccion_empleado;});//SACO EL NOMBRE DEL EMPLEADO

		return response()->json($seccion);
	}

	public function guardarsolicitudmatriculaonline(Request $request)
	{
		//dd($request);
	$familiar=Familiares::find(Auth::user()->familiar->id);
	$estudiante=Expedienteestudiante::find($request->estudiante_id);
	$formato = Carbon::createFromFormat('d/m/Y',$request->f_fechamatricula);
	$f_fechamatricula = $formato->format('Y/m/d');


	//REGISTRO LA MATRICULA
	$estudiante->estudiante_seccion()->attach($request->seccion_id,['f_fechamatricula'=>$f_fechamatricula,'v_presentocertificadoSN'=>'NO','v_procesoenlineaSN'=>'SI','v_trasladoSN'=>'NO','v_centroescolarorigen'=>null,'v_observaciones'=>null,'v_estadomatricula'=>'pendiente','estado'=>'1','anio'=>$request->anio,'modalidad'=>'Online','matricula'=>'1','familiar_exp'=>$familiar->expediente,'familiar_nombre'=>$familiar->nombres." ".$familiar->apellidos]);

	Flash::success("Solicitud de matricula enviada exitosamente")->important();
		return redirect()->route('estudiantes_familiares',Auth::user()->familiar->id);
	

	}

	public function expedienteonline($id)
	{
		$familiar=Familiares::find($id);
		$user=Usuario::where('familiar_id','=',$id)->get();
		//dd($user);
		//$listaparentesco=Parentesco::orderBy('parentesco','ASC')->pluck('parentesco','id');
//dd($listaparentesco);
		if($familiar->fechanacimiento!=null)
		{
		$formato = Carbon::createFromFormat('Y-m-d',$familiar->fechanacimiento);
		$edad=Carbon::parse($formato)->age;
		$familiar->fechanacimiento = $formato->format('d/m/Y');
			}
			else{$edad=null;}
	return view('admin.moduloenlineapadres.expedientefamiliaronline')->with('familiar',$familiar)->with('edad',$edad)->with('user',$user);	;
	}
    
    public function editarexpedienteenlinea($id)
    {
    	$familiar=Familiares::find($id);
		$user=Usuario::where('familiar_id','=',$id)->get();
		//dd($user);
		//$listaparentesco=Parentesco::orderBy('parentesco','ASC')->pluck('parentesco','id');

		if($familiar->fechanacimiento!=null)
		{
		$formato = Carbon::createFromFormat('Y-m-d',$familiar->fechanacimiento);
		$edad=Carbon::parse($formato)->age;
		$familiar->fechanacimiento = $formato->format('d/m/Y');
			}
			else{$edad=null;}

return view('admin.moduloenlineapadres.editarexpedientefamiliaronline',compact('familiar','edad','user'));
    }

    public function actualizarexpedienteenlinea(DatosPersonalesFamiliaresRequest $request, $id)
	{
		
		$familiar=Familiares::find($id);
		$familiar->fill($request->all());
		if($familiar->fechanacimiento!=null)
		{
		$fechanacimiento = $request->fechanacimiento;
		$formato = Carbon::createFromFormat('d/m/Y',$fechanacimiento);
		$familiar->fechanacimiento = $formato->format('Y/m/d');
	    }
		if($request->file('txtfoto')!=null)//si ha modificado la fotografia 
		{
			$usuario = Usuario::where('familiar_id','=',$request->id)->first();
			$file=$request->file('txtfoto');
			$extension=$file->getClientOriginalExtension();
			$nombre= 'PF_' . time() .'.'.$extension;
			$path= public_path('/imagenes/Administracionacademica/Padresdefamilia');
			$file->move($path,$nombre);
			$usuario->foto=$nombre;		
			$usuario->save();
		}
		$familiar->save();
		Flash::success("El expediente ha sido actualizado  actualizado exitosamente")->important();
		return redirect()->route('expedienteonline',$familiar->id);	
	}
}
 