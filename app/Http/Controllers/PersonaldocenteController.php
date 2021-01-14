<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\RolesSesion;
use Carbon\Carbon;
use App\TipoPersonal;
use App\Especialidad;
use App\Conducta;
use App\Cargo;
use App\Grados;
use App\Seccion;
use App\Asignaturas;
use App\HorarioClases;
use App\BloqueHorarios;
use App\Empleados;
use App\Periodoactivo;
use App\Periodoevaluacion;
use App\Expedienteestudiante;
use App\EvaluacionesPeriodo;
use App\Notas;
use App\Bitacora;
use App\NotasItems;
use App\Competenciasciudadanas;
use App\Notascompetenciasciudadanas;
use App\Notasitemcompetenciasciudadanas;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

class PersonaldocenteController extends Controller
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

    public function verexpediente()
	{
		$roles=RolesSesion::sesionRoles();
		$formato = Carbon::createFromFormat('Y-m-d',Auth::user()->empleado->f_fechanaci);
		Auth::user()->empleado->f_fechanaci = $formato->format('d/m/Y');
		if(Auth::user()->empleado->f_fechaingresoalCE!=null)
		{
			$formato2 = Carbon::createFromFormat('Y-m-d',Auth::user()->empleado->f_fechaingresoalCE);
			Auth::user()->empleado->f_fechaingresoalCE = $formato2->format('d/m/Y');
		}
		if(Auth::user()->empleado->f_fechaingresoministerio!=null)
		{
			$formato3 = Carbon::createFromFormat('Y-m-d',Auth::user()->empleado->f_fechaingresoministerio);
			Auth::user()->empleado->f_fechaingresoministerio = $formato3->format('d/m/Y');
		}
		$edad = Carbon::parse($formato)->age;
		$tiposPersonal = TipoPersonal::orderBy('v_tipopersonal','ASC')->where('estado','=','1')->pluck('v_tipopersonal','id');
		$cargos = Cargo::orderBy('v_descripcion','ASC')->where('estado','=','1')->pluck('v_descripcion','id');
		$especialidades = Especialidad::orderBy('v_especialidad','ASC')->where('estado','=','1')->pluck('v_especialidad','id');

		

		foreach(Auth::user()->empleado->permisos as $permiso)
	    {
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
		    $permiso->f_fechasolicitud = $formato->format('d/m/Y');
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_desde);
		    $permiso->f_desde = $formato->format('d/m/Y');
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_hasta);
		    $permiso->f_hasta = $formato->format('d/m/Y');
	    }

		
		return view('admin.personaldocente.expediente.llllllexpedientedocente')->with('roles',$roles)->with('edad',$edad)->with('tiposPersonal',$tiposPersonal)->with('cargos',$cargos)->with('especialidades',$especialidades);
	}

////////CALIFICACIONES MODULO DOCENTES///////////////////

	public function asignarnotasteacher(Request $request,$id)
	{
		$seccion = Seccion::find($id);
		$asignaturas=$this->asignaturas_docente_horario($id);
		$periodos = Periodoevaluacion::where('estado', 1)->get();


		//MUESTRA SOLO EL PERIODO DENTRO DEL CUAL CORRESPONDE LA FECHA ACTUAL, ES DECIR, NO MOSTRARA PERIODOS QUE YA HAYAN FINALIZADO SEGUN EL RANGO DE FECHA DE DURACION DEFINIDA 
		$hoy=Carbon::now()->format('Y-m-d');
	  /*  $periodos=Periodoevaluacion::with('periodoevaluacion_cicloescolar')->where(
    [['estado','=','1'],['fecha_inicio','<=',$hoy],['fecha_fin','>=',$hoy]])->get();*/
    	//dd($seccion);

		$evaluaciones = EvaluacionesPeriodo::where('codigo_eval','!=','RF')->pluck('nombre', 'id');
	
	return view(
			'admin.personaldocente.gestionacademica.controlcalificaciones.notasteacher', 
			compact('seccion', 'periodos', 'asignaturas', 'evaluaciones', 'id')
		);
	}
 
	public function agregarNotateacher(Request $request)
	{

		$params = $request->all();
		$notaVerify = Notas::where('seccion_id', $params['seccion_id'])
				->where('periodo_id', $params['periodo'] )
				->where('asignatura_id', $params['materia'] )
				->where('evaluacion_id', $params['evaluacion'] )
				->get();

		if(count($notaVerify) > 0 ){
			return redirect('/seccionesnotasteacher/'. $notaVerify[0]->id .'/view');
		/*Flash::error('La sección '.$seccion->seccion.' a sido deshabilitada exitosamente.')->important();
		return redirect()->route('');*/
		}

		$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');

		$students = DB::select( DB::raw($sqlQuery) );

		return view('admin.personaldocente.gestionacademica.controlcalificaciones.agregar-notasteacher', compact('params', 'students'));
	}

public function viewNotasteacher($id)
	{
		$notaVerify = Notas::find($id);
		//dd($notaVerify);
		return view('admin.personaldocente.gestionacademica.controlcalificaciones.view-notasteacher', [
			"notas" => $notaVerify
		]);
	}


public function addSaveNotateacher(Request $request)
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


			return redirect('/seccionesnotasteacher/'. $notaInstance->id .'/view');
		}		
	}

public function updateCompetencia(Request $r)
{
$item = Conducta::find($r->get('id'));
$item->criterio_1=$r->cr1;
$item->criterio_2=$r->cr2;
$item->criterio_3=$r->cr3;
$item->criterio_4=$r->cr4;
$item->criterio_5=$r->cr5;
$item->save();
return redirect()->route('ViewCompetenciasteacher',[$r->get('seccion'),$r->get('periodo')]);
}

public function editarNota($id, $nota_id)
	{
		$item = NotasItems::find($id);
		return view('admin.personaldocente.gestionacademica.controlcalificaciones.updateNotasteacher', [
			'item' => $item, 
			'nota_id' => $nota_id
		]);
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

		return redirect('/seccionesnotasteacher/'. $request->get('seccion_id') .'/view');
	}





 
//COMPETENCIAS CIUDADANAS DOCENTES

	public function asignarponderacionteacher(Request $request,$id)
	{
		$seccion = Seccion::find($id);
		//$asignaturas = Asignaturas::pluck('asignatura', 'id');
		$competenciasciudadanas=Competenciasciudadanas::pluck('competencia','id');
		$periodos = Periodoevaluacion::where('estado', 1)->get();
		//MUESTRA SOLO EL PERIODO DENTRO DEL CUAL CORRESPONDE LA FECHA ACTUAL, ES DECIR, NO MOSTRARA PERIODOS QUE YA HAYAN FINALIZADO SEGUN EL RANGO DE FECHA DE DURACION DEFINIDA 
		$hoy=Carbon::now()->format('Y-m-d');
	    /*$periodos=Periodoevaluacion::with('periodoevaluacion_cicloescolar')->where(
    [['estado','=','1'],['fecha_inicio','<=',$hoy],['fecha_fin','>=',$hoy]])->get();*/
	return view(
			'admin.personaldocente.gestionacademica.controlcalificaciones.competenciasciudadanas.competencia', 
			compact('seccion', 'periodos', 'competenciasciudadanas','id')
		);
	}

public function missecciones_teacher()//INGRESO DE COMPETENCIAS CIUDADANAS
	{
		  //$secciones=$this->secciones_docente_horario();
          $secciones=$this->secciones_docente();
		return view('admin.personaldocente.gestionacademica.controlcalificaciones.competenciasciudadanas.listaseccionespordocentev2',compact('secciones'));
	} 


	public function agregarCompetenciateacher(Request $request)
	{
//dd($request);
		$params = $request->all();
		$comp=Competenciasciudadanas::all();
		$students = self::getStudentConducta($params['seccion_id'], $params['periodo']);
	//dd($students);
		if(count($students) > 0 )
		{
return redirect('/seccionescompetenciasteacher/'. $params['seccion_id'] .'/view/'.$params['periodo']);
			
		}

		$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');

		$students = DB::select( DB::raw($sqlQuery) );

		return view('admin.personaldocente.gestionacademica.controlcalificaciones.competenciasciudadanas.agregar-competenciasteacher', compact('params', 'students','comp'));
	}

	private function getStudentConducta($id, $periodo) {
		$sqlQuery = "SELECT cda.id, cda.periodo_id, cda.criterio_1, cda.criterio_2, cda.criterio_3, cda.criterio_4, cda.criterio_5, tbe.v_nombres, tbe.v_nie, tbe.v_apellidos, tbm.seccion_id FROM tb_expedienteestudiante as tbe INNER JOIN tb_matriculaestudiante as tbm ON tbm.estudiante_id = tbe.id INNER JOIN conducta_alumno as cda ON cda.alumno_id = tbe.id where tbm.seccion_id = {$id} and cda.periodo_id = {$periodo}";
		return DB::select(
			DB::raw($sqlQuery)
		);
	}


public function viewCompetenciasteacher($id, $periodo)
	{
		$students = self::getStudentConducta($id, $periodo);
		//dd($students);
		return view('admin.personaldocente.gestionacademica.controlcalificaciones.competenciasciudadanas.view_competencianotateacher', ["students" => $students,"id" => $id,"periodo" => $periodo ]);
	}

public function editCompetenciasteacher($id,$seccion,$periodo)
{
$competencias=Competenciasciudadanas::get();
$conducta=Conducta::find($id);
$estudiante=Expedienteestudiante::find($conducta->alumno_id);
return view('admin.personaldocente.gestionacademica.controlcalificaciones.competenciasciudadanas.edit_competenciateacher',compact('conducta','competencias','estudiante','seccion','periodo'));
	

}

public function addSaveCompetenciateacher(Request $request)
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
			return redirect('/seccionescompetenciasteacher/'. $seccion .'/view/'.$periodo);
		}		
	


	//NOTAS MODULO DOCENTES

	public function misseccionesteacher()//INGRESO DE CALIFICACIONES
	{
		$secciones=$this->secciones_docente();

		return view('admin.personaldocente.gestionacademica.controlcalificaciones.listaseccionespordocente',compact('secciones'));
	}

	 protected function secciones_docente() //saca las secciones qu pertenecen al docente logeado
		{ 
	$secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where([['tb_secciones.empleado_id','=',Auth::user()->empleado->id],['tb_secciones.estado','=',1]])->get();
		    return $secciones; 
		}

   protected function secciones_docente_horario() //saca las secciones qu pertenecen al docente logeado y en las que imparte alguna materia
        { 
        $hoy = Carbon::now();
	    $hoyg = $hoy->format('Y-m-d');
	    $anio = $hoy->year;	
 
            $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->join('tb_horario_clases', 'tb_horario_clases.seccion_id', '=', 'tb_secciones.id')
            ->groupBy('tb_secciones.id')
            ->where('tb_horario_clases.estado','=',1)
            ->where('tb_secciones.estado','=',1)
            //->whereYear('tb_horario_clases.anio','=',$anio)
            ->where('tb_horario_clases.docente_id','=',Auth::user()->empleado->id)->get();
            return $secciones; 
        }


         protected function asignaturas_docente_horario($id) //saca las secciones qu pertenecen al docente logeado y en las que imparte alguna materia
        { 
             $a = Asignaturas::select('tb_asignaturas.asignatura','tb_asignaturas.id')
            ->join('tb_horario_clases', 'tb_horario_clases.asignatura_id', '=', 'tb_asignaturas.id')
            ->groupBy('tb_asignaturas.id')
            ->where([['tb_horario_clases.docente_id','=',Auth::user()->empleado->id],['tb_horario_clases.seccion_id','=',$id]])->pluck('asignatura','id');

            return $a; 
        }


 public function registrarcalificaciones()
    {
//MUESTRA SOLO EL PERIODO DENTRO DEL CUAL CORRESPONDE LA FECHA ACTUAL, ES DECIR, NO MOSTRARA PERIODOS QUE YA HAYAN FINALIZADO SEGUN EL RANGO DE FECHA DE DURACION DEFINIDA 
$hoy=Carbon::now()->format('Y-m-d');
$periodos=Periodoevaluacion::with('periodoevaluacion_cicloescolar')->where(
    [['estado','=','1'],['fecha_inicio','<=',$hoy],['fecha_fin','>=',$hoy]])->pluck('descripcion','id');
//dd($periodos);
$secciones=$this->secciones_docente_horario();
 return view('admin.personaldocente.gestionacademica.controlcalificaciones.registrarcalificacion')->with('secciones',$secciones)->with('periodos',$periodos);

    }

    public function listadoasignaturas(Request $request,$id){
      $asignaturas = $this->asignaturas_docente_horario($id);
     return response()->json($asignaturas);   
    }
    
    public function listadoestudiantes($seccion_id){
$datos=Expedienteestudiante::orderBy('v_apellidos','ASC')->whereHas('estudiante_seccion',function ($q) use ($seccion_id){
    $q->where('seccion_id','=',$seccion_id);
})->where('estado','=',1)->get();
 return response()->json($datos);
    }

public function mihorariodeclases()
{
$aniolectivo=Periodoactivo::periodoescolar()->first();
$aniol=Periodoactivo::periodoescolar()->count();

if($aniol>0)
{
$anio=$aniolectivo->anio;
$bloques=BloqueHorarios::get();
$horario = HorarioClases::with('horario_docente')->where([['anio','=',$anio],['tb_horario_clases.docente_id','=',Auth::user()->empleado->id]])
      ->orderBy('dia','Asc')->get();

$lista=array();
foreach ($bloques as $key => $value)
 {
  if($value->tipo_bloque=='Receso')
  {
  for ($d=0; $d <5 ; $d++) { 
$lista[$key][$d][0]=date('g:i A',strtotime($value->hora_inicio)) .' - '. date('g:i A',strtotime($value->hora_fin));
$lista[$key][$d][1]='RECESO';
$lista[$key][$d][2]='RECESO';
$lista[$key][$d][3]='RECESO';
$lista[$key][$d][4]='RECESO';
$lista[$key][$d][5]='RECESO';
$lista[$key][$d][6]='RECESO';
  }
  }
else//es bloque de clases
{
 $horariom=HorarioClases::where([['anio','=',$anio],['tb_horario_clases.docente_id','=',Auth::user()->empleado->id],['bloque_id',$value->id],])->get();

foreach ($horariom as $i => $horariom) {
  $lista[$key][$i][0]=date('g:i A',strtotime($value->hora_inicio)) .' - '. date('g:i A',strtotime($value->hora_fin));

 $lista[$key][$i][1] = $horariom->horario_bloque->tipo_bloque;
$lista[$key][$i][2] = $horariom->horario_asignatura->asignatura;
$lista[$key][$i][3] = $horariom->horario_docente->v_nombres . ' ' . $horariom->horario_docente->v_apellidos;
$lista[$key][$i][4] = $horariom->horario_seccion->descripcion;
$lista[$key][$i][5] = $horariom->anio;
$lista[$key][$i][6] = $horariom->dia;

}
 }//cierro else
}//cierro foreach
}//cierro if
$numerobloques=count($bloques);
return view('admin.personaldocente.gestionacademica.nominas.consultarinformacionindividual.mishorarios',compact('lista','bloques','numerobloques'));
}

}
