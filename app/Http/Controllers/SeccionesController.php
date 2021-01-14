<?php

namespace App\Http\Controllers;
use App\Http\Requests\SeccionRequest;
use Illuminate\Http\Request;
use App\Seccion;
use App\Grados; 
use App\Turnos;
use App\Empleado;
use App\Expedienteestudiante;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Conducta;
use App\Bitacora;
use App\Usuario;
use App\Notas;
use App\NotasItems;
use App\Asignaturas;
use App\Periodoevaluacion;
use App\Periodoactivo;
use App\EvaluacionesPeriodo;
use App\Competenciasciudadanas;
use App\Notascompetenciasciudadanas;
use App\Notasitemcompetenciasciudadanas;

class SeccionesController extends Controller
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
$periodoescolaractivo=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
if($periodoescolaractivo==null){
	Flash::warning("ACTUALMENTE NO CUENTA CON UN CICLO O AÑO ESCOLAR ACTIVO.<br> SE RECOMIENDA COMPLETAR EL REGISTRO DE UN NUEVO CICLO ESCOLAR E INICIAR LAS CONFIGURACIONES PARA SECCIONES, HORARIOS DE CLASES, Y PERIODOS DE EVALUACION PARA UN OPTIMO FUNCIONAMIENTO DE LA APLICACION.")->important(); 
    return redirect()->route('registrarcicloacademico');	
}else{
		$listasecciones=Seccion::orderBy('id','ASC')->where('estado','=','1')->withCount(['seccion_estudiante',
                'seccion_estudiante as nuevoingreso' => function ($query){
                    $query->where([['tb_matriculaestudiante.anio','tb_secciones.anio'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
                }
            ])->get();	


		$cantidadsecciones=count($listasecciones);
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_grado;});//SACO EL NOMBRE DEL GRADO
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_turno;});//NOMBRE DEL TURNO
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_empleado;});//NOMBRE DEL ASESOR DE SECCION
$periodos = Periodoevaluacion::where('estado', 1)->get();
	return view('admin.configuraciones.administracionacademica.secciones.listasecciones',compact('listasecciones','periodos','cantidadsecciones'));
		}	
	}


 
	 public function agregarseccion()	
	{ 
		$grados=Grados::orderBy('id','ASC')->where('estado','=','1')->pluck('grado','id');
		$turnos=Turnos::orderBy('turno','ASC')->where('estado','=','1')->pluck('turno','id');
		
		//$asesor=Empleado::with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->pluck('nombrecompleto','id');	// muestra todos los empleados registrados como docentes    

		/*$asesor=Empleado::doesntHave('empleado_seccion')->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->with('tipoPersonal')->orderBy('v_numeroexp','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->pluck('nombrecompleto','id');//saco a todos los empleados que no tienen una seccion asignada*/

$periodoescolaractivo=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoescolaractivo->anio;


	/*	$asesor=Empleado::doesntHave('empleado_seccion')->with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->pluck('nombrecompleto','id');//saco a todos los empleados que no tienen una seccion asignada*/

		$asesor=Empleado::WhereDoesntHave('empleado_seccion', function ($q) use($anio){$q->where('anio',$anio);})->with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->pluck('nombrecompleto','id');//saco a todos los empleados que no tienen una seccion asignada

		
//dd($asesor);

		//CON ESTO LLENO LA TABLA CON LOS DOCENTES ASESORES
		$listasecciones=Seccion::orderBy('seccion','ASC')->where('estado','=','1')->get();
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_grado;});//SACO EL NOMBRE DEL GRADO
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_turno;});//NOMBRE DEL TURNO
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_empleado;});//NOMBRE DEL ASESOR DE SECCION
		return view('admin.configuraciones.administracionacademica.secciones.agregarseccion')->with('grados',$grados)->with('turnos',$turnos)->with('asesor',$asesor)->with('listasecciones',$listasecciones);
	}

	 public function guardarseccion(SeccionRequest $request)//request son los valores que estamos recibiendo del formulario desde donde hemos invocado la ruta guardar
	{
$periodoescolaractivo=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
	$seccion=new Seccion($request->all());
	$seccion->nivel=$request->nivel;	 
	$seccion->anio = $periodoescolaractivo->anio;
	$seccion->estado='1';
		if($seccion->seccionintegrada==null)
      {      $seccion->seccionintegrada=0;} else{ $seccion->seccionintegrada=1;} 
		$seccion->save();
		Flash::success("La sección " . $seccion->descripcion . " ha sido creada exitosamente")->important();
		return redirect()->route('listasecciones');
	}

	public function verseccion($id) {
		$seccion	= Seccion::find($id);
		$periodos = Periodoevaluacion::where('estado', 1)->get();
		$grados	= Grados::orderBy('grado','ASC')->where('estado','=','1')->pluck('grado','id');
		$turnos	= Turnos::orderBy('turno','ASC')->where('estado','=','1')->pluck('turno','id');
		$asesor	= Empleado::select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->pluck('nombrecompleto','id');

		return view(
			'admin.configuraciones.administracionacademica.secciones.verseccion'
			)->with('periodos', $periodos)->with('seccion', $seccion)->with('grados', $grados)->with('turnos', $turnos)->with('asesor', $asesor);
	}

	public function editarseccion($id)
	{
	$seccion=Seccion::find($id);
	$grados=Grados::orderBy('grado','ASC')->where('estado','=','1')->pluck('grado','id');
	$turnos=Turnos::orderBy('turno','ASC')->where('estado','=','1')->pluck('turno','id');
	
	/*$disponibles=Empleado::doesntHave('empleado_seccion')->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->pluck('nombrecompleto','id');*/
	//dd($asesor);

/*if($seccion->seccionintegrada==1)//saca a todos los docentes
{
	$asesor=Empleado::with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->pluck('nombrecompleto','id');	// muestra todos los empleados registrados como docentes  
}
else
	{//sacar solo a los docentes disponibles
$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoescolaractivo->anio;

	$asesor=Empleado::WhereDoesntHave('empleado_seccion', function ($q) use($anio){$q->where('anio',$anio);})->with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->pluck('nombrecompleto','id');//saco a todos los empleados que no tienen una seccion asignada
}
*/

$asesor=Empleado::with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->pluck('nombrecompleto','id');	// muestra todos los empleados registrados como docentes 

//dd($asesor);
	
	/*foreach ($disponibles as $disponibles ) {
		$asesor->push($disponibles);
	}*/
	
	$listasecciones=Seccion::orderBy('seccion','ASC')->where('estado','=','1')->get();
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_grado;});//SACO EL NOMBRE DEL GRADO
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_turno;});//NOMBRE DEL TURNO
		$listasecciones->each(function($listasecciones){$listasecciones->seccion_empleado;});//NOMBRE DEL ASESOR DE SECCION

	return view('admin.configuraciones.administracionacademica.secciones.editarseccion',compact('seccion','grados','turnos','asesor','listasecciones'));
	}

public function actualizarseccion(SeccionRequest $request,$id)
	{
$periodoescolaractivo=Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();

		//dd($request);
		$secciones=Seccion::find($id);
		$secciones->seccion=$request->seccion;
		$secciones->codigo=$request->codigo;
		$secciones->descripcion=$request->descripcion;
		$secciones->cupo_maximo=$request->cupo_maximo;
		$secciones->nivel=$request->nivel;
		$secciones->aula_ubicacion=$request->aula_ubicacion;
		$secciones->turno_id=$request->turno_id;
		$secciones->grado_id=$request->grado_id;
		$secciones->empleado_id=$request->empleado_id;
		$secciones->anio = $periodoescolaractivo->anio;
		$secciones->estado='1';
		if($request->seccionintegrada==null)
      {      $secciones->seccionintegrada=0;} else{ $secciones->seccionintegrada=1;} 

		$secciones->save();	
		Flash::success('Sección '. $secciones->seccion.' actualizada exitosamente.')->important();
		return redirect()->route('listasecciones');
	}


	public function asignarasesordeseccion($id)
	{
dd('exito');
	}

	public function desactivarseccion($id)
	{
		$seccion=Seccion::find($id);
		$seccion->estado=0;
		$seccion->save();
		Flash::error('La sección '.$seccion->seccion.' a sido deshabilitada exitosamente.')->important();
		return redirect()->route('listasecciones');
	}

 public function asesorseccionnormal()
    {
         $asesor=Empleado::doesntHave('empleado_seccion')->with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->get();
        return response()->json($asesor);
    }

    public function asesorseccionintegrada()
    {
       $asesor=Empleado::with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->get();
       return response()->json($asesor);
    }

   /* public function asesorseccionnormaledit($id)
    {   
       $asesor=Empleado::select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->where([['tb_empleado.id','=',$id],['v_numeroexp','!=','RH0000-0']])->first();//

        $disponibles=Empleado::doesntHave('empleado_seccion')->with('tipoPersonal')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->whereHas('tipoPersonal',function($filtro){$filtro->where('v_tipopersonal','like','Docente');})->select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->get();

        //$asesor->push($disponibles);
       return response()->json($disponibles);
    }*/

	public function asignarnotas(Request $request, $id)
	{
		$seccion = Seccion::find($id);
		$asignaturas = Asignaturas::pluck('asignatura', 'id');
		$periodos = Periodoevaluacion::where('estado', 1)->get();
		$evaluaciones = EvaluacionesPeriodo::where('codigo_eval','!=','RF')->pluck('nombre', 'id');
		
		return view(
			'admin.configuraciones.administracionacademica.secciones.notas', 
			compact('seccion', 'periodos', 'asignaturas', 'evaluaciones', 'id')
		);
	} 

	
	public function agregarNota(Request $request)
	{
		

		$params = $request->all();

		$estudiantes = Expedienteestudiante::select('tb_expedienteestudiante.v_apellidos','tb_expedienteestudiante.v_nombres','tb_expedienteestudiante.id')
				->where('tb_expedienteestudiante.estado','=','1')
				->orderBy('tb_expedienteestudiante.v_apellidos','ASC')
				->join('tb_matriculaestudiante', 'tb_expedienteestudiante.id', '=', 'tb_matriculaestudiante.estudiante_id')
				->join('tb_secciones', 'tb_matriculaestudiante.seccion_id', '=', 'tb_secciones.id')
				->where('tb_matriculaestudiante.seccion_id','=',$request->seccion_id)
            	->get();

		$notaVerify = Notas::where('seccion_id', $params['seccion_id'])
				->where('periodo_id', $params['periodo'] )
				->where('asignatura_id', $params['materia'] )
				->where('evaluacion_id', $params['evaluacion'] )
				->get();

		if(count($notaVerify) > 0 ){
			return redirect('/seccionesnotas/'. $notaVerify[0]->id .'/view');
		}

		$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');

		$students = DB::select( DB::raw($sqlQuery) );

		return view('admin.configuraciones.administracionacademica.secciones.agregar-notas', compact('params', 'students'));
	}

	public function viewNotas($id)
	{
		$notaVerify = Notas::find($id);
		//dd($notaVerify);
		return view('admin.configuraciones.administracionacademica.secciones.view-notas', [
			"notas" => $notaVerify
		]);
	} 

	public function addSaveNota(Request $request)
	{

		$materia = $request->get('materia');
		$periodos = $request->get('periodo');
		$evaluacion = $request->get('evaluacion');

		$nies = $request->get('nies');
		$notas = $request->get('notas');
		
		// creado la instancia de las notas
		$notaInstance = new Notas;
		$notaInstance->periodo_id = $request->get('periodo');
		$notaInstance->seccion_id = $request->get('seccion_id');
		$notaInstance->asignatura_id = $request->get('materia');
		$notaInstance->evaluacion_id = $request->get('evaluacion');
		
				if( $notaInstance->save() ) {
			if($nies!=null){

			foreach ($nies as $index => $nie) {
				$item = new NotasItems;
				$item->notas_id = $notaInstance->id;
				$item->alumno_id = $nie;
				$item->calificacion = $notas[$index];
				$item->save();
			}

$secbitacora=Seccion::find($request->get('seccion_id'));
$asigbitacora=Asignaturas::find($request->get('materia'));
$this->bitacora(array(
			"operacion" => 'Guardar calificaciones para la sección '.$secbitacora->descripcion.', asignatura '.$asigbitacora->asignatura
		));

		}

			return redirect('/seccionesnotas/'. $notaInstance->id .'/view');
		}		
	}

	public function updateNota(Request $request)
	{
		$item = NotasItems::find($request->get('id'));
		$item->calificacion = $request->get('notaUpdate');
		$item->observaciones = $request->get('observaciones');
		$item->save();

$datobitacora=Notas::find($item->notas_id);
$this->bitacora(array(
			"operacion" => 'Modificar calificaciones para el estudiante con id '.$item->alumno_id.', '.$datobitacora->evaluacion->nombre.', asignatura '.$datobitacora->asignatura->asignatura.', '.$datobitacora->periodo->descripcion
		));

		return redirect('/seccionesnotas/'. $request->get('seccion_id') .'/view');
	}

	public function editarNota($id, $nota_id)
	{
		$item = NotasItems::find($id);
		return view('admin.configuraciones.administracionacademica.secciones.update-notas', [
			'item' => $item, 
			'nota_id' => $nota_id
		]);
	}


//COMPETENCIAS CIUDADANAS
	/*public function asignarponderacioncompetencia($id)
	{
		$seccion = Seccion::find($id);
		//$competenciasciudadanas=Competenciasciudadanas::pluck('competencia','id');
		$periodos = Periodoevaluacion::where('estado', 1)->get();
	/*$periodos=Periodoevaluacion::with('periodoevaluacion_cicloescolar')->where(
    [['estado','=','1'],['fecha_inicio','<=',$hoy],['fecha_fin','>=',$hoy]])->get();

		//MUESTRA SOLO EL PERIODO DENTRO DEL CUAL CORRESPONDE LA FECHA ACTUAL, ES DECIR, NO MOSTRARA PERIODOS QUE YA HAYAN FINALIZADO SEGUN EL RANGO DE FECHA DE DURACION DEFINIDA 
		$hoy=Carbon::now()->format('Y-m-d');
return view('admin.configuraciones.administracionacademica.secciones.competenciasciudadanas.competenciasciudadanas_admin',compact('seccion', 'periodos','id'));	
	}*/
//////////////////////////////////////////////////////////////////////

/*	public function agregarCompetenciaadmin(Request $request)
	{

		$params = $request->all();
		$comp=Competenciasciudadanas::all();
		//$params['comp']=$comp;
		$competenciaVerify = Notascompetenciasciudadanas::where('seccion_id', $params['seccion_id'])
				->where('periodo_id', $params['periodo'] )
				->get();
//dd($competenciaVerify);
		if(count($competenciaVerify) > 0 ){
	
			return redirect('/seccionescompetenciasadmin/'. $competenciaVerify[0]->id .'/view');
		}

		$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');

		$students = DB::select( DB::raw($sqlQuery) );
//dd('va para save');
		return view('admin.configuraciones.administracionacademica.secciones.competenciasciudadanas.agregar-competenciasadmin', compact('params', 'students','comp'));
	}
	
	public function viewCompetenciasadmin($id)
	{
		$notaVerify = Notascompetenciasciudadanas::find($id);
		return view('admin.configuraciones.administracionacademica.secciones.competenciasciudadanas.view_competencianotaadmin', [
			"notas" => $notaVerify
		]);
	}

public function addSaveCompetenciaadmin(Request $request)
	{
		////dd($request);
		//$competencia = $request->get('competencia');
		$periodos = $request->get('periodo');

		$nies = $request->get('nies');
		$notas = $request->get('ponderacion');

		// creado la instancia de las notas
		$notaInstance = new Notascompetenciasciudadanas;
		$notaInstance->periodo_id = $request->get('periodo');
		$notaInstance->seccion_id = $request->get('seccion_id');
		//$notaInstance->competencia_id = $request->get('competencia');
		
		if( $notaInstance->save() ) {
			foreach ($nies as $index => $nie) {
				$item = new Notasitemcompetenciasciudadanas;
				$item->notascompetenciasciudadanas_id = $notaInstance->id;
				//$item->alumno_id = $nie;
				$item->estudiante_id = $nie;
				$item->nota = $notas[$index];
				$item->save();
			}

			return redirect('/seccionescompetenciasadmin/'. $notaInstance->id .'/view');
		}		
	}
*/

	//////////////////////////RUTAS MEL/////////////////////


//COMPETENCIAS CIUDADANAS
	public function asignarponderacioncompetencia($id)
	{
		$seccion = Seccion::find($id);
		$periodos = Periodoevaluacion::where('estado', 1)->get();
		$hoy = Carbon::now()->format('Y-m-d');
		return 
		view('admin.configuraciones.administracionacademica.secciones.competenciasciudadanas.competenciasciudadanas_admin',	compact('seccion', 'periodos', 'competenciasciudadanas','id'));	
	}

	public function agregarCompetenciaadmin(Request $request)
	{
		$params = $request->all();
		$comp=Competenciasciudadanas::all();
		$students = self::getStudentConducta($params['seccion_id'], $params['periodo']);

		if (count($students) > 0) {
		
			return redirect('/seccionescompetenciasadmin/'. $params['seccion_id'] .'/view/'.$params['periodo']);
		}

		$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');
		$students = DB::select( DB::raw($sqlQuery) );
		return view('admin.configuraciones.administracionacademica.secciones.competenciasciudadanas.agregar-competenciasadmin', compact('students', 'params','comp'));
	}

	private function getStudentConducta($id, $periodo) {
		$sqlQuery = "SELECT cda.id, cda.periodo_id, cda.criterio_1, cda.criterio_2, cda.criterio_3, cda.criterio_4, cda.criterio_5, tbe.v_nombres, tbe.v_nie, tbe.v_apellidos, tbm.seccion_id FROM tb_expedienteestudiante as tbe INNER JOIN tb_matriculaestudiante as tbm ON tbm.estudiante_id = tbe.id INNER JOIN conducta_alumno as cda ON cda.alumno_id = tbe.id where tbm.seccion_id = {$id} and cda.periodo_id = {$periodo}";
		return DB::select(
			DB::raw($sqlQuery)
		);
	}
	
	public function viewCompetenciasadmin($id, $periodo)
	{
		$students = self::getStudentConducta($id, $periodo);
		return 
			view('admin.configuraciones.administracionacademica.secciones.competenciasciudadanas.view_competencianotaadmin', ["students" => $students ]);
	}

public function addSaveCompetenciaadmin(Request $request)
	{
		$cr5  = $request->get('cr5');
		$cr4  = $request->get('cr4');
		$cr3  = $request->get('cr3');
		$cr2  = $request->get('cr2');
		$cr1  = $request->get('cr1');
		$nies = $request->get('nies');
		$seccion = $request->get('seccion');
		$periodo = $request->get('periodo');
		
		foreach ($nies as $index => $nie) {
			$item = new Conducta;
			$item->alumno_id = $nie;
			$item->periodo_id = $periodo;
			$item->criterio_1 = $cr1[$index];
			$item->criterio_2 = $cr2[$index];
			$item->criterio_3 = $cr3[$index];
			$item->criterio_4 = $cr4[$index];
			$item->criterio_5 = $cr5[$index];
			$item->save();
		}
		return redirect('/seccionescompetenciasadmin/'. $seccion .'/view/'.$periodo);
	}

public function duplicarsecciones()
{
	
	$anioanterior=Periodoactivo::where([['estado',0],['tipo_periodo','like','ACADEMICO']])->max('anio');
	$anioactual=Periodoactivo::where([['estado',1],['tipo_periodo','like','ACADEMICO']])->max('anio');

	$secciones=Seccion::where('anio',$anioanterior)->get();
	foreach ($secciones as $key => $value) {
		$newseccion=new Seccion();
		$newseccion->seccion=$value->seccion;		
		$newseccion->codigo=$value->codigo;		
		$newseccion->descripcion=$value->descripcion;		
		$newseccion->cupo_maximo=$value->cupo_maximo;
		$newseccion->aula_ubicacion=$value->aula_ubicacion;
		$newseccion->seccionintegrada=$value->seccionintegrada;
		$newseccion->turno_id=$value->turno_id;
		$newseccion->grado_id=$value->grado_id;
		$newseccion->empleado_id=$value->empleado_id;
		$newseccion->nivel=$value->nivel;
		$newseccion->estado=1;
		$newseccion->anio=$anioactual;
		$newseccion->save();
	}

	Flash::success('Las secciones del ciclo académico '.$anioanterior.' han sido duplicadas con éxito.')->important();
	return redirect()->route('listasecciones');
}
}
