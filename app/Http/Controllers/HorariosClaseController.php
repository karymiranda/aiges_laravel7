<?php

namespace App\Http\Controllers;
use App\Seccion; 
use App\Periodoactivo;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\BloqueHorarios;
use App\Asignaturas;
use App\Empleado;
use App\HorarioClases;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Bitacora;
use App\Usuario;
use Illuminate\Support\Facades\Auth;


class HorariosClaseController extends Controller
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

    public function index(){
    	
    	$this->bitacora(array(
			"operacion" => 'Consutar horarios de clases'
		));

    	$anio = $this->anio();
    	if(!isset($anio)){
    		//dd('no existe');
    		Flash::warning("ACTUALMENTE NO CUENTA CON UN CICLO O AÑO ESCOLAR ACTIVO.<br> SE RECOMIENDA COMPLETAR EL REGISTRO DE UN NUEVO CICLO ESCOLAR E INICIAR LAS CONFIGURACIONES PARA SECCIONES, HORARIOS DE CLASES, Y PERIODOS DE EVALUACION PARA UN OPTIMO FUNCIONAMIENTO DE LA APLICACION.")->important(); 
    return redirect()->route('registrarcicloacademico');	
    	}
    	else
    		{
    	$secciones = Seccion::where([['estado','=','1'],['anio','=',$anio]])
    	->whereHas('seccion_horario',function($filtro) use ($anio){	
			$filtro->where([['tb_horario_clases.anio',$anio],['tb_horario_clases.estado','=','1']]);
		})
    	->orderBy('id','ASC')->get();
    	$secciones->each(function($secciones){ 
			$secciones->seccion_empleado;
			$secciones->seccion_grado; 
			$secciones->seccion_turno; 
		});
		return view('admin.academica.horarios.listahorariosclase')->with('secciones',$secciones)->with('anio',$anio);}
    }

    public function crearhorariosclase(){
    	$anio = $this->anio();
		$secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where([['tb_secciones.estado','=','1'],['tb_secciones.anio','=',$anio]])
            ->whereDoesntHave('seccion_horario', function ($query) use($anio) {
			    $query->where([['tb_horario_clases.anio',$anio],['tb_horario_clases.estado','=','1']]);
			})
            ->pluck('grado', 'tb_secciones.id');
    	$bloques=new BloqueHorarios;
    	$numBloq=0;
    	return view('admin.academica.horarios.crearhorariosclase')->with('secciones',$secciones)->with('seccion','0')->with('bloques',$bloques)->with('numBloq',$numBloq);
    }

    public function cargarhorarios(Request $request){
		if($request->seccion==''){
			Flash::warning("No ha seleccionado un grado y sección")->important(); 
		  	return redirect()->route('crearhorariosclase');
		}else{
			$seccion=Seccion::find($request->seccion);
			$seccion->each(function($seccion){ 
				$seccion->seccion_turno; 
			});
			$bloques=BloqueHorarios::where('estado','=','1')->whereBetween('hora_inicio', array($seccion->seccion_turno->horadesde, $seccion->seccion_turno->horahasta))->orderBy('correlativo_clase','ASC')->get();
			//dd($bloques);
			$asignaturas=Asignaturas::where('estado','=','1')->orderBy('id','ASC')->pluck('asignatura','id');
			$empleados=Empleado::select(\DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombre'),'tb_empleado.id')->where('tb_empleado.estado','=','1')
			->join('tb_tipopersonal', 'tb_tipopersonal.id', '=', 'tb_empleado.tipopersonal_id')->where([['tb_tipopersonal.estado','=','1'],['tb_tipopersonal.v_tipopersonal','like','Docente']])
			->orderBy('tb_empleado.id','ASC')->pluck('nombre','tb_empleado.id');
			if ($bloques->first()!=null) {
				$numBloq=$bloques->count();
				$secciones = $this->secciones();
				
				foreach ($bloques as $bloque) {
					$bloque->hora_inicio=date('g:i A',strtotime($bloque->hora_inicio));
					$bloque->hora_fin=date('g:i A',strtotime($bloque->hora_fin));
				}

				return view('admin.academica.horarios.crearhorariosclase')->with('secciones',$secciones)->with('seccion',$request->seccion)->with('bloques',$bloques)->with('asignaturas',$asignaturas)->with('docentes',$empleados)->with('numBloq',$numBloq);
			}else{
				Flash::warning("No existe un horario establecido para el turno ".$seccion->seccion_turno->turno)->important(); 
				return redirect()->route('crearhorariosclase');
			}			
		}
	}

	public function guardarhorarios(Request $request){
		
		$numBloq=$request->numBloq;
		$dias=['Lunes','Martes','Miercoles','Jueves','Viernes'];
		$seccion=Seccion::find($request->seccion);
			$seccion->each(function($seccion){ 
				$seccion->seccion_turno; 

			});

	   		$bloques=BloqueHorarios::where('estado','=','1')->whereBetween('hora_inicio', array($seccion->seccion_turno->horadesde, $seccion->seccion_turno->horahasta))->orderBy('correlativo_clase','ASC')->get();
		$anio = $this->anio();
		foreach ($bloques as $bloque) {
			$bloque->hora_inicio=date('g:i A',strtotime($bloque->hora_inicio));
			$bloque->hora_fin=date('g:i A',strtotime($bloque->hora_fin));
		 	for ($c=0; $c < 5; $c++) { 
				$horario = new HorarioClases();
				$horario->dia=$dias[$c];

				if ($bloque->tipo_bloque!='Clase') {
					$horario->asignatura_id=null;
					$horario->docente_id=null;
				} else {
					switch ($dias[$c]) {
						case 'Lunes':
							$campo='asignatura_idL_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Lunes '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->asignatura_id=$request->$campo;
							$campo='docente_idL_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Lunes '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No Establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->docente_id=$request->$campo;
							
							break;
						case 'Martes':
							$campo='asignatura_idM_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Martes '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->asignatura_id=$request->$campo;
							$campo='docente_idM_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Martes '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->docente_id=$request->$campo;
							break;
						case 'Miercoles':
							$campo='asignatura_idMi_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Miercoles '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->asignatura_id=$request->$campo;
							$campo='docente_idMi_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Miercoles '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->docente_id=$request->$campo;
							break;
						case 'Jueves':
							$campo='asignatura_idJ_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Jueves '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->asignatura_id=$request->$campo;
							$campo='docente_idJ_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Jueves '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->docente_id=$request->$campo;
							break;
						case 'Viernes':
							$campo='asignatura_idV_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Viernes '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->asignatura_id=$request->$campo;
							$campo='docente_idV_'.$bloque->id;
							$validator = Validator::make($request->all(), [
					            $campo => 'required'
					        ],[$campo.'.required' => 'Horario Viernes '.$bloque->hora_inicio.' - '.$bloque->hora_fin.' No establecido. Complete todo el horario']);
 
					        if ($validator->fails()) {
					        	$deletedRows = HorarioClases::where([['seccion_id', $request->seccion],['anio',$anio]])->delete();
					        	return redirect()->route('cargarhorarios', ['seccion' => $request->seccion])
					                        ->withErrors($validator)
					                        ->withInput();
					        }
							$horario->docente_id=$request->$campo;
							break;
						default:
							# code...
							break;
					}
				}

				$horario->bloque_id=$bloque->id;
				$horario->seccion_id=$request->seccion;
				$horario->anio=$anio;
				$horario->estado=1;
				$horario->save();	
			}
		 } 

		 $this->bitacora(array(
			"operacion" => 'Crear horario de clases para la sección '.$seccion->descripcion
		));

		Flash::success("El horario ha sido guardado exitosamente.")->important();
		return redirect()->route('listadohorariosclase');
	}

	public function verhorariosclase($id){
		$anio = $this->anio();
		$horario = HorarioClases::where([['estado','=','1'],['anio','=',$anio],['tb_horario_clases.seccion_id','=',$id]])
    	->orderBy('id','ASC')->get();
    	$horario->each(function($horario){ 
			$horario->horario_asignatura;
			$horario->horario_docente; 
			$horario->horario_bloque;
		});
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
		return view('admin.academica.horarios.verhorariosclase')->with('horario',$lista)->with('seccion',$seccion->grado)->with('b',$b);
	}

	public function editarhorariosclase($id){
		$asignaturas=Asignaturas::where('estado','=','1')->orderBy('id','ASC')->pluck('asignatura','id');
		$empleados=Empleado::select(\DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombre'),'tb_empleado.id')->where('tb_empleado.estado','=','1')
		->join('tb_tipopersonal', 'tb_tipopersonal.id', '=', 'tb_empleado.tipopersonal_id')->where([['tb_tipopersonal.estado','=','1'],['tb_tipopersonal.v_tipopersonal','like','Docente']])
		->orderBy('tb_empleado.id','ASC')->pluck('nombre','tb_empleado.id');
		$anio = $this->anio();
		$horario = HorarioClases::where([['estado','=','1'],['anio','=',$anio],['tb_horario_clases.seccion_id','=',$id]])
    	->orderBy('id','ASC')->get();
    	$horario->each(function($horario){ 
			$horario->horario_asignatura;
			$horario->horario_docente; 
			$horario->horario_bloque;
		});
		$seccion=Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'),'tb_secciones.id')
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
			$lista[$b][$d][4] = $horario->asignatura_id;
			$lista[$b][$d][5] = $horario->docente_id;
			$lista[$b][$d][6] = $horario->id;
			$d++;						
		}
		return view('admin.academica.horarios.editarhorariosclase')->with('horario',$lista)->with('seccion',$seccion->grado)->with('seccion_id',$seccion->id)->with('b',$b)->with('asignaturas',$asignaturas)->with('docentes',$empleados);
	}

	public function actualizarhorarios(Request $request){
		$anio = $this->anio();
		$horario = HorarioClases::where([['estado','=','1'],['anio','=',$anio],['seccion_id','=',$request->seccion_id]])
    	->orderBy('id','ASC')->get();
		foreach ($horario as $horario) {
			$registro = HorarioClases::where('id','=',$horario->id)->first();
				$registro->each(function($registro){ 
				$registro->horario_bloque;
				$registro->horario_seccion;
			});
			if ($registro->horario_bloque->tipo_bloque=='Clase') {
				$campo='docente_id_'.$registro->id;
				$validator = Validator::make($request->all(), [
		            $campo => 'required'
		        ],[$campo.'.required' => 'Horario '.$registro->dia.' '.$registro->horario_bloque->hora_inicio.' - '.$registro->horario_bloque->hora_fin.' No pudo ser Actualizado']);
		        if ($validator->fails()) {
		        	return redirect()->route('editarhorariosclase', ['id' => $request->seccion_id])
		                        ->withErrors($validator)
		                        ->withInput();
		        }
				$registro->docente_id=$request->$campo;
				$campo='asignatura_id_'.$registro->id;
				$validator = Validator::make($request->all(), [
		            $campo => 'required'
		        ],[$campo.'.required' => 'Horario '.$registro->dia.' '.$registro->horario_bloque->hora_inicio.' - '.$registro->horario_bloque->hora_fin.' No pudo ser Actualizado']);
		        if ($validator->fails()) {
		        	return redirect()->route('editarhorariosclase', ['id' => $request->seccion_id])
		                        ->withErrors($validator)
		                        ->withInput();
		        }
				$registro->asignatura_id=$request->$campo;
				$registro->save();
			}			
		}
		Flash::success("El horario de ".$registro->first()->horario_seccion->seccion_grado->grado.' '.$registro->first()->horario_seccion->seccion." ha sido actualizado exitosamente.")->important();
		return redirect()->route('listadohorariosclase');
	}

	public function eliminarhorariosclase($id){
		$anio = $this->anio();
		$horario = HorarioClases::where([['estado','=','1'],['anio','=',$anio],['seccion_id','=',$id]])->get();
		$horario->each(function($horario){ 
			$horario->horario_seccion;
		});
    	$grado=$horario->first()->horario_seccion->seccion_grado->grado.' '.$horario->first()->horario_seccion->seccion;
    	foreach ($horario as $horario) {
    		$horario->delete();
    	}
    	
		Flash::error("El Horario de " .$grado." ha sido Eliminado")->important();
		return redirect()->route('listadohorariosclase');
	}

	protected function secciones(){
		$anio = $this->anio();
		$secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where([['tb_secciones.estado','=','1'],['tb_secciones.anio','=',$anio]])
            ->whereDoesntHave('seccion_horario', function ($query) use($anio) {
			    $query->where([['tb_horario_clases.anio',$anio],['tb_horario_clases.estado','=','1']]);
			})
            ->pluck('grado', 'tb_secciones.id');
        return $secciones;
    }

    protected function anio(){
		$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
		if($periodoescolaractivo==null){$anio=null;}
		else{$anio=$periodoescolaractivo->anio;}
		

        return $anio;
    }
}
