<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Seccion;
use Illuminate\Support\Facades\Auth;
use App\Expedienteestudiante;
use App\AsistenciasEstudiantes;
use App\Periodoactivo;
use Illuminate\Support\Facades\DB;
use App\Bitacora;
use App\Usuario;

class ControlAsistenciaController extends Controller
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


    public function index()//FUNCION DESDE ASISTENCIA DOCENTE
	{
	
		$hoy = Carbon::now();
		$hoyc = $hoy->format('Y-m-d');
		$hoyf = $hoy->format('d/m/Y');
		$hoyt = $hoyf . ' - ' . $hoyf;
		$secciones = $this->secciones_docente();
		//dd($secciones);
		$lista[]=null;  
		$f=1;
		$n=0;

		return view('admin.personaldocente.gestionacademica.controlasistencia.listaasistencias')->with('hoy',$hoyt)->with('secciones',$secciones)->with('seccion','0')->with('estudiante',$lista)->with('n',$n)->with('f',$f);		
	}

	public function tomarasistencia(Request $request){
		if($request->grado_seccion==''){
			Flash::warning("No ha seleccionado un grado y sección. ")->important(); 
		  	return redirect()->route('tomarasistencialista');
		}else{
			
			$hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
			$hoyf = $hoy->format('d/m/Y');
			$hoyc = $hoy->format('Y-m-d');
			//dd($hoyc);

			$secciones = $this->secciones_docente();
			$estudiantes = Expedienteestudiante::select('tb_expedienteestudiante.v_apellidos','tb_expedienteestudiante.v_nombres','tb_expedienteestudiante.v_genero','tb_expedienteestudiante.id','tb_expedienteestudiante.v_nie')
					->where('tb_expedienteestudiante.estado','=','1')
					->orderBy('tb_expedienteestudiante.v_apellidos','ASC')
					->join('tb_matriculaestudiante', 'tb_expedienteestudiante.id', '=', 'tb_matriculaestudiante.estudiante_id')
					->join('tb_secciones', 'tb_matriculaestudiante.seccion_id', '=', 'tb_secciones.id')
					->where('tb_matriculaestudiante.seccion_id','=',$request->grado_seccion)
	            	->get();
			$lista[]=null;
			$n=0;
			foreach ($estudiantes as $estudiante) {
				$lista[$n][0] = $estudiante->v_apellidos . ', ' . $estudiante->v_nombres;
				$lista[$n][1] = $estudiante->v_nie;
				$lista[$n][2] = $estudiante->v_genero;
				$asistencias = AsistenciasEstudiantes::where([['expedienteestudiante_id','=',$estudiante->id],['f_fecha','=',$hoyc]])->get();
				if($asistencias->first()!=null){
					foreach ($asistencias as $asistencia) {
						if($asistencia->v_asistenciaSN=='S'){
								$lista[$n][3] = 'Asistencia';
						}else{
							if($asistencia->v_asistenciaSN=='N' && $asistencia->v_pidiopermisoSN=='N'){
								$lista[$n][3] = 'Ausencia';
							}else{
								$lista[$n][3] = 'Permiso';
							}
						}
					}	
				}else{
					$lista[$n][3] = 'Pendiente';
				}
				
				$lista[$n][4] = $estudiante->id;
				$n++;
			}
			return view('admin.personaldocente.gestionacademica.controlasistencia.tomarasistencia')->with('hoy',$hoyf)->with('seccion',$request->grado_seccion)->with('secciones',$secciones)->with('n',$n)->with('estudiante',$lista);
		}
	}

	public function regresarasistencia($id,$fecha){
	//dd($fecha);
		if($id==''){
			Flash::warning("No ha seleccionado un grado y sección.")->important(); 
		  	return redirect()->route('tomarasistencialista');
		}else{
			
			$hoy = Carbon::parse($fecha);
			$hoyc = $hoy->format('Y-m-d');			
			$hoyf = $hoy->format('d/m/Y');
			//dd($hoyf);
			

			$secciones = $this->secciones_docente();
			$estudiantes = Expedienteestudiante::select('tb_expedienteestudiante.v_apellidos','tb_expedienteestudiante.v_nombres','tb_expedienteestudiante.v_genero','tb_expedienteestudiante.id','tb_expedienteestudiante.v_nie')
					->where('tb_expedienteestudiante.estado','=','1')
					->orderBy('tb_expedienteestudiante.v_apellidos','ASC')
					->join('tb_matriculaestudiante', 'tb_expedienteestudiante.id', '=', 'tb_matriculaestudiante.estudiante_id')
					->join('tb_secciones', 'tb_matriculaestudiante.seccion_id', '=', 'tb_secciones.id')
					->where('tb_matriculaestudiante.seccion_id','=',$id)
	            	->get();
			$lista[]=null;
			$n=0;
			foreach ($estudiantes as $estudiante) {
				$lista[$n][0] = $estudiante->v_apellidos . ', ' . $estudiante->v_nombres;
				$lista[$n][1] = $estudiante->v_nie;
				$lista[$n][2] = $estudiante->v_genero;
				$asistencias = AsistenciasEstudiantes::where([['expedienteestudiante_id','=',$estudiante->id],['f_fecha','=',$hoyc]])->get();
				if($asistencias->first()!=null){
					foreach ($asistencias as $asistencia) {
						if($asistencia->v_asistenciaSN=='S'){
								$lista[$n][3] = 'Asistencia';
						}else{
							if($asistencia->v_asistenciaSN=='N' && $asistencia->v_pidiopermisoSN=='N'){
								$lista[$n][3] = 'Ausencia';
							}else{
								$lista[$n][3] = 'Permiso';
							}
						}
					}	
				}else{
					$lista[$n][3] = 'Pendiente';
				}
				
				$lista[$n][4] = $estudiante->id;
				$n++;
			}
			return view('admin.personaldocente.gestionacademica.controlasistencia.tomarasistencia')->with('hoy',$hoyf)->with('seccion',$id)->with('secciones',$secciones)->with('n',$n)->with('estudiante',$lista);
		}
	}

	public function tomarasistencialista(){
	//	dd('tomar asist ist');
		$hoy = Carbon::now();
		$hoyc = $hoy->format('Y-m-d');
		$hoyf = $hoy->format('d/m/Y');
		$secciones = $this->secciones_docente();
		$estudiantes=null;
		$lista[]=null;
		$n=0;
		
		return view('admin.personaldocente.gestionacademica.controlasistencia.tomarasistencia')->with('hoy',$hoyf)->with('seccion','')->with('secciones',$secciones)->with('n',$n)->with('estudiante',$lista);
	}

	public function listadoasistencia(Request $request){
	//	dd('listaasiste');

		$secciones = $this->secciones_docente();
		if($request->grado_seccion==''){
			Flash::warning("No ha seleccionado un grado y sección.  <br> Debe estar registrado como asesor de sección para tener acceso al registro de asistencia.")->important(); 
		  	return redirect()->route('listaasistencias');
		}else{
		  	$periodo = explode(' - ', $request->f_asistencia);
		    $f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
		    $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
		    $f_desde = $f_desde->format('Y-m-d');
		    $f_hasta = $f_hasta->format('Y-m-d');
		  	$hoy = Carbon::now();
			$hoyc = $hoy->format('Y-m-d');
			$estudiantes = Expedienteestudiante::select('tb_expedienteestudiante.v_apellidos','tb_expedienteestudiante.v_nombres','tb_expedienteestudiante.id')
				->where('tb_expedienteestudiante.estado','=','1')
				->orderBy('tb_expedienteestudiante.v_apellidos','ASC')
				->join('tb_matriculaestudiante', 'tb_expedienteestudiante.id', '=', 'tb_matriculaestudiante.estudiante_id')
				->join('tb_secciones', 'tb_matriculaestudiante.seccion_id', '=', 'tb_secciones.id')
				->where('tb_matriculaestudiante.seccion_id','=',$request->grado_seccion)
            	->get();

			$lista[]=null;
			$f=0;
			$n=0;
			foreach ($estudiantes as $estudiante) {
				for($i=$f_desde;$i<=$f_hasta;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
					$lista[$n][$f][0] = $estudiante->v_apellidos . ', ' . $estudiante->v_nombres;
					$asistencias = AsistenciasEstudiantes::where([['expedienteestudiante_id','=',$estudiante->id],['f_fecha','=',$i]])->get();					
					if($asistencias->first()!=null){
						foreach ($asistencias as $asistencia) {
							if($asistencia->v_asistenciaSN=='S'){
									$lista[$n][$f][2] = 'Asistencia';
							}else{
								if($asistencia->v_asistenciaSN=='N' && $asistencia->v_pidiopermisoSN=='N'){
									$lista[$n][$f][2] = 'Ausencia';
								}else{
									$lista[$n][$f][2] = 'Permiso';
								}
							}
						}	
					}else{
						$lista[$n][$f][2] = 'Pendiente';

					}
					//$lista[$n][$f][2] = 'Asistencia';
					$fecha = Carbon::createFromFormat('Y-m-d',$i);
					$lista[$n][$f][1] = $fecha->format('d/m/Y');
					$f++;			
				}
				$f=0;
				$n++;
			}
			//dd($lista);	
			$f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
		    $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
			$f=$this->generateDateRange($f_desde,$f_hasta);	
			if($f>7){ 
			  Flash::warning("El rango no puede excederse de 7 días")->important(); 
			  return redirect()->route('listaasistencias');
			}else{ 	
				return view('admin.personaldocente.gestionacademica.controlasistencia.listaasistencias')->with('estudiante',$lista)->with('hoy',$request->f_asistencia)->with('n',$n)->with('f',$f)->with('secciones',$secciones)->with('seccion',$request->grado_seccion);
			}
		}
	  }

	  public function agregarausencia(Request $request,$id)
	  {
	  	//dd($request);
	  	$asistencia = new AsistenciasEstudiantes();
	    $asistencia->expedienteestudiante_id = $id;
	    //$hoy = Carbon::now();
	    //$hoyg = $hoy->format('Y-m-d');

	    $hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
			$hoyf = $hoy->format('d/m/Y');
			$hoyg = $hoy->format('Y-m-d');


	    $asistencia->f_fecha = $hoyg;
	    $asistencia->año = $hoy->year;	    
	    $asistencia->v_asistenciaSN = 'N';
	    $asistencia->v_pidiopermisoSN = 'N';
	    $asistencia->justificacion = $request->justificacion;
	    $asistencia->observacion= $request->observacion;
	    $asistencia->save();
	    return redirect()->route('regresarasistencia',[$request->grado_seccion,$hoy]);
	  }

	  public function agregarasistencia(Request $request,$id)
	  {
	  	//dd($request);
	  	$asistencia = new AsistenciasEstudiantes();
	    $asistencia->expedienteestudiante_id = $id;  
	     $hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
			$hoyf = $hoy->format('d/m/Y');
			$hoyg = $hoy->format('Y-m-d');

	    $asistencia->f_fecha = $hoyg;
	    $asistencia->año = $hoy->year;	    
	    $asistencia->v_asistenciaSN = 'S';
	    $asistencia->save();
	    return redirect()->route('regresarasistencia',[$request->grado_seccion,$hoy]);
	  }

	  public function agregarpermiso(Request $request,$id)
	  {
	  	$asistencia = new AsistenciasEstudiantes();
	    $asistencia->expedienteestudiante_id = $id;
	    //$hoy = Carbon::now();
	    //$hoyg = $hoy->format('Y-m-d');

	        $hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
			$hoyf = $hoy->format('d/m/Y');
			$hoyg = $hoy->format('Y-m-d');

	    $asistencia->f_fecha = $hoyg;
	    $asistencia->año = $hoy->year;	    
	    $asistencia->v_asistenciaSN = 'N';
	    $asistencia->v_pidiopermisoSN = 'S';
	    $asistencia->justificacion = $request->justificacion;
	    $asistencia->observacion= $request->observacion;
	    $asistencia->save();
	    return redirect()->route('regresarasistencia',[$request->grado_seccion,$hoy]);
	  }

	  	protected function generateDateRange(Carbon $start_date, Carbon $end_date) 
		{ 
		    $f = 0; 
		    for($date = $start_date; $date->lte($end_date); $date->addDay()) { 
		     	$f++; 
		    } 
		    return $f; 
		}

		 protected function secciones_docente() 
		{ 
	
		    $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.empleado_id','=',Auth::user()->empleado->id)
             ->where('tb_secciones.estado','=',1)
            ->pluck('grado', 'tb_secciones.id');
		    return $secciones; 
		}

////////////////////////////////////////////////////////////////////////////

//ASISTENCIA MEJORADA MUDULO DOCENTES


public function marcarasistencia()
		{
		$hoy = Carbon::now();
		$fecha = $hoy->format('d/m/Y');
		$aniolectivo=Periodoactivo::periodoescolar()->get();
		$aniolectivoactivo=$aniolectivo->pluck('anio','id');

		$seccion = $this->secciones_docente();	
	
		return view('admin.personaldocente.gestionacademica.controlasistencia.registrarasistencia',compact('fecha','aniolectivoactivo','seccion'));
		}

public function marcarasistencialistaestudiantes_view(Request $request)
{
#dd($request);
	//dd('entra');
$params=$request->all();
		 $hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
		 $fecha = $hoy->format('Y-m-d');

		$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');
		
$students = DB::select( DB::raw($sqlQuery) );
if(count($students)>0)//si hay estudiantes en seccin para que no de error
{
//comprobar si un estudiante de esa seccion ya esta registrado como asistencia

		$asistenciaVerify =AsistenciasEstudiantes::whereHas('estudiante')
				->where('f_fecha',$fecha)
				->where('expedienteestudiante_id',$students[0]->estudiante_id)
				->get();
		#dd($asistenciaVerify);

		if(count($asistenciaVerify) > 0 )
		{
			foreach ($students as $student) 
			{
				$asistencia[] =AsistenciasEstudiantes::whereHas('estudiante')
				->where('f_fecha',$fecha)
				->where('expedienteestudiante_id',$student->estudiante_id)
				->first();
				
				}
				//dd('va para ver info');
				return view('admin.personaldocente.gestionacademica.controlasistencia.verregistroasistencia_view',compact('params','students','asistencia'));
			}//cierro if
			 
		else
		{

		 //va registrar la asistencia de ese dia
			 foreach ($students as $key => $student) 
		 {
				$asistencia[] =AsistenciasEstudiantes::whereHas('estudiante')
				->where('f_fecha',$fecha)
				->where('expedienteestudiante_id',$students[$key]->estudiante_id)
				->first();
		}
		
		return view('admin.personaldocente.gestionacademica.controlasistencia.view_asistenciastudents',compact('params','students','asistencia'));

		}

}
else{//si no hay estudiante matriculados entonces no haga nada
	Flash::error('La seccion no tiene estudiantes matriculados')->important();
	return redirect()->route('marcarasistencia_view',$request->seccion_id);
}

}

public function guardarasistenciasteacher(Request $request)
{
//dd($request);
         $params=$request->all();
		 $hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
		 $fecha = $hoy->format('Y-m-d');


$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');
		
$students = DB::select( DB::raw($sqlQuery) );

if(count($students)>0)//si hay estudiantes en seccin para que no de error
{
if(isset($request->falto))
{
	//dd(@$request->falto);
	for ($i=0; $i<count($request->ids); $i++) 
	{ 
		$regasistencia=new AsistenciasEstudiantes();
		 	$regasistencia->expedienteestudiante_id=$request->ids[$i];
		 	$regasistencia->f_fecha=$fecha;
//dd($request->ids[$i]);
		if(array_key_exists($request->ids[$i], @$request->falto))
		{
			//dd('siarray');
			$regasistencia->v_asistenciaSN='N';
		 	$regasistencia->v_pidiopermisoSN=0;
		 	$regasistencia->justificacion=$request->justificacion[$i];
		 	$regasistencia->observacion=$request->observacion[$i];
		}
		else
		{
		$regasistencia->v_asistenciaSN='S';
		 	$regasistencia->v_pidiopermisoSN=0;
		 	$regasistencia->justificacion=null;
		 	$regasistencia->observacion=null;	
		}
 	
		 	$regasistencia->año=$hoy->format('Y');
		 	$regasistencia->save();	 

	}//fin for	
 }//fin if isset
else//entonces guarde todo de un solo como asistencia
{
for ($i=0; $i<count($request->ids) ; $i++) 
{ 
		 	$regasistencia=new AsistenciasEstudiantes();
		 	$regasistencia->expedienteestudiante_id=$request->ids[$i];
		 	$regasistencia->f_fecha=$fecha;
		 	$regasistencia->v_asistenciaSN='S';
		 	$regasistencia->v_pidiopermisoSN=0;
		 	$regasistencia->año=$hoy->format('Y');
		 	$regasistencia->save();	 	
}//fin for asistencia normal

}


		  //recuero la informacion de asistencias apra presentarla en la tabla
		 foreach ($students as $key => $student) 
		 {
				$asistencia[] =AsistenciasEstudiantes::whereHas('estudiante')
				->where('f_fecha',$fecha)
				->where('expedienteestudiante_id',$students[$key]->estudiante_id)
				->first();
		}
$secbitacora=Seccion::find($request->get('seccion_id'));
$this->bitacora(array(
			"operacion" => 'Tomar asistencia para la sección'.$secbitacora->descripcion
		));

//dd($asistencia);
		return view('admin.personaldocente.gestionacademica.controlasistencia.verregistroasistencia_view',compact('params','students','asistencia'));
}
else{//si no hay estudiante matriculados entonces no haga nada
	Flash::error('La seccion no tiene estudiantes matriculados')->important();
	return redirect()->route('marcarasistencia_view',$request->seccion_id);
}
}



		////////////ASISTENCIAS MENU ADMINISTRADOR////////////////////////
		public function tomarasistenciaadmin($id)
		{
			
		$hoy = Carbon::now();
		$fecha = $hoy->format('d/m/Y');
		$aniolectivo=Periodoactivo::periodoescolar()->get();
		$aniolectivoactivo=$aniolectivo->pluck('anio','id');
		
		$seccion= Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.id','=',$id)
            ->pluck('grado', 'tb_secciones.id');
	
		return view('admin.configuraciones.administracionacademica.secciones.asistencia.registrarasistencia_admin',compact('fecha','aniolectivoactivo','seccion'));
		}


		public function tomarasistencia_listaestudiantes(Request $request)
		{

	$params=$request->all();
		 $hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
		 $fecha = $hoy->format('Y-m-d');


		$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');

$students = DB::select( DB::raw($sqlQuery) );
if(count($students)>0)//si hay estudiantes en seccin para que no de error
{
//comprobar si un estudiante de esa seccion ya esta registrado como asistencia

		$asistenciaVerify =AsistenciasEstudiantes::whereHas('estudiante')
				->where('f_fecha',$fecha)
				->where('expedienteestudiante_id',$students[0]->estudiante_id)
				->get();
		//dd($asistenciaVerify);

		if(count($asistenciaVerify) > 0 ){// 
			//dd('si hay asistencia de ese dia');
			//dd($students);
			foreach ($students as $student) {
				$asistencia[] =AsistenciasEstudiantes::whereHas('estudiante')
				->where('f_fecha',$fecha)
				->where('expedienteestudiante_id',$student->estudiante_id)
				->first();
				
				}
				//dd($asistencia);
				return view('admin.configuraciones.administracionacademica.secciones.asistencia.verdetalleasistencia',compact('params','students','asistencia'));
			}//cierro if
			 
		else
		{	
		 //va registrar la asistencia de ese dia
			
		
//dd('va para registro');


			 foreach ($students as $key => $student) 
		 {
				$asistencia[] =AsistenciasEstudiantes::whereHas('estudiante')
				->where('f_fecha',$fecha)
				->where('expedienteestudiante_id',$students[$key]->estudiante_id)
				->first();
		}
		return view('admin.configuraciones.administracionacademica.secciones.asistencia.view_asistencias',compact('params','students','asistencia'));

		}

}
else{//si no hay estudiante matriculados entonces no haga nada
	Flash::error('La seccion no tiene estudiantes matriculados')->important();
	return redirect()->route('tomarasistencia_view',$request->seccion_id);
}
		}

		
public function guardarasistenciaadmin(Request $request)
{
//dd($request);
         $params=$request->all();
		 $hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
		 $fecha = $hoy->format('Y-m-d');


$sqlQuery = "SELECT tb_matriculaestudiante.seccion_id, tb_matriculaestudiante.estudiante_id, tb_expedienteestudiante.id, tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_nie
		FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id where tb_matriculaestudiante.estado = 1 AND seccion_id = ".$request->get('seccion_id');
		
$students = DB::select( DB::raw($sqlQuery) );

if(count($students)>0)//si hay estudiantes en seccin para que no de error
{
if(isset($request->falto))
{
	//dd(@$request->falto);
	for ($i=0; $i<count($request->ids); $i++) 
	{ 
		$regasistencia=new AsistenciasEstudiantes();
		 	$regasistencia->expedienteestudiante_id=$request->ids[$i];
		 	$regasistencia->f_fecha=$fecha;
//dd($request->ids[$i]);
		if(array_key_exists($request->ids[$i], @$request->falto))
		{
			//dd('siarray');
			$regasistencia->v_asistenciaSN='N';
		 	$regasistencia->v_pidiopermisoSN=0;
		 	$regasistencia->justificacion=$request->justificacion[$i];
		 	$regasistencia->observacion=$request->observacion[$i];
		}
		else
		{
		$regasistencia->v_asistenciaSN='S';
		 	$regasistencia->v_pidiopermisoSN=0;
		 	$regasistencia->justificacion=null;
		 	$regasistencia->observacion=null;	
		}
 	
		 	$regasistencia->año=$hoy->format('Y');
		 	$regasistencia->save();	 

	}//fin for	
 }//fin if isset
else//entonces guarde todo de un solo como asistencia
{
for ($i=0; $i<count($request->ids) ; $i++) 
{ 
		 	$regasistencia=new AsistenciasEstudiantes();
		 	$regasistencia->expedienteestudiante_id=$request->ids[$i];
		 	$regasistencia->f_fecha=$fecha;
		 	$regasistencia->v_asistenciaSN='S';
		 	$regasistencia->v_pidiopermisoSN=0;
		 	$regasistencia->año=$hoy->format('Y');
		 	$regasistencia->save();	 	
}//fin for asistencia normal

}


		  //recuero la informacion de asistencias apra presentarla en la tabla
		 foreach ($students as $key => $student) 
		 {
				$asistencia[] =AsistenciasEstudiantes::whereHas('estudiante')
				->where('f_fecha',$fecha)
				->where('expedienteestudiante_id',$students[$key]->estudiante_id)
				->first();
		}
$secbitacora=Seccion::find($request->get('seccion_id'));
$this->bitacora(array(
			"operacion" => 'Tomar asistencia para la sección'.$secbitacora->descripcion
		));

//dd($asistencia);
		return view('admin.configuraciones.administracionacademica.secciones.asistencia.verdetalleasistencia',compact('params','students','asistencia'));
}
else{//si no hay estudiante matriculados entonces no haga nada
	Flash::error('La seccion no tiene estudiantes matriculados')->important();
	return redirect()->route('marcarasistencia_view',$request->seccion_id);
}
}

		


}
