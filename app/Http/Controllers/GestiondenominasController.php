<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignaturas;
use App\Grados;
use App\Seccion;
use App\Turnos;
use App\Empleados;
use App\Periodoactivo;
use App\Periodoevaluacion;
use App\Expedienteestudiante;
use App\Faltasestudiantes;
use App\Usuario;
use App\Departamentos;
use App\Municipios;
use App\Familiares;
use App\RolUsuario;
use App\Datosmedicosestudiante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class GestiondenominasController extends Controller
{
   public function missecciones()
{
$anio=Periodoactivo::periodoescolar()->first();//uso el scope para sacar el periodo activo
$anio=$anio->anio;
$secciones = $this->secciones_docente();
return view('admin.personaldocente.gestionacademica.nominas.missecciones')->with('secciones',$secciones);			
}
	public function nominadeestudiantes($id)
	{
$seccion_id=$id;
$anio=Periodoactivo::periodoescolar()->first();//uso el scope para sacar el periodo activo
$anio=$anio->anio;
$datos=Expedienteestudiante::with(['estudiante_familiares'=>function($q) use ($anio){
$q->where('tb_estudiante_familiar.encargado','like','SI')->get();}])->whereHas('estudiante_seccion', function ($q) use ($anio,$id){
	$q->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1'],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->where('estado','=','1')->get();

foreach ($this->secciones_docente() as $seccion ) {
	$seccion=$seccion->grado;
}
$asignaturas=Asignaturas::where('estado','1')->get();
/*
$datos=Expedienteestudiante::with('estudiante_familiares')->whereHas('estudiante_seccion', function ($q) use ($anio,$id){
	$q->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1'],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->where('estado','=','1')->get();//obtengo la informacion de los familiares que estan */
return view('admin.personaldocente.gestionacademica.nominas.vernominadeestudiantes',compact('datos','seccion','seccion_id','asignaturas'));	

	}

	public function encargados()
	{
		return view('admin.personaldocente.gestionacademica.nominas.vernominadeencargados');	
	}

protected function secciones_docente_horario()
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




 protected function secciones_docente() //saca las secciones qu pertenecen al docente logeado
{ 
		    $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where([['tb_secciones.empleado_id','=',Auth::user()->empleado->id],['tb_secciones.estado','=',1]])->get();
		    return $secciones; 
}

	public function expedientecompleto_modulodocente($id,$seccion_id)
		{
		$estudiante=Expedienteestudiante::find($id);
		$user=Usuario::where('estudiante_id','=',$id)->get();
		$familiares=Expedienteestudiante::with('estudiante_familiares')->whereHas('estudiante_familiares')->where('id','=',$id)->get();//obtengo la informacion de los familiares que estan relaciondos con ese estudiante en particular
		
$datosmedicos=$estudiante->estudiante_datosmedicos()->first();
$datosmedicos->discapacidades=explode(',',$datosmedicos->discapacidades);
$datosmedicos->alimentos_consume=explode(',',$datosmedicos->alimentos_consume);
$datosmedicos->tiempos_comida=explode(',', $datosmedicos->tiempos_comida);

		$estudiante->sacramentos=explode(',',$estudiante->sacramentos);
		$formato = Carbon::createFromFormat('Y-m-d',$estudiante->f_fnacimiento);
		$edad=Carbon::parse($formato)->age;
		$estudiante->f_fnacimiento = $formato->format('d/m/Y');

	
		if($estudiante->f_fechaIngresoCE!=null)
			{
				$formato2 = Carbon::createFromFormat('Y-m-d',$estudiante->f_fechaIngresoCE);
				$estudiante->f_fechaIngresoCE=$formato2->format('d/m/Y');
			}
		
		$muni = Municipios::orderBy('id','ASC')->where('id','=',$estudiante->municipio_id)->first();
		$municipios=$muni->pluck('v_municipio','id'); 
		$dept = Departamentos::orderBy('v_departamento','ASC')->where('id','=',$muni->id)->pluck('v_departamento','id');			
	

$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q){
$q->where('tb_matriculaestudiante.v_estadomatricula','like','aprobada');}])->where('id',$id)->get();
#dd($datos);

$faltas=Faltasestudiantes::orderBy('fecha')->where('estudiante_id',$id)->get();
foreach($faltas as $f)
	    {
 $formato = Carbon::createFromFormat('Y-m-d',$f->fecha);
 $f->fecha = $formato->format('d/m/Y');
 #$f->fecha = $formato->toFormattedDateString();
	    }



		return view('admin.personaldocente.gestionacademica.nominas.consultarinformacionindividual.expedientecompleto_modulodocente')->with('estudiante',$estudiante)->with('edad',$edad)->with('datosmedicos',$datosmedicos)->with('familiares',$familiares)->with('user',$user)->with('municipios',$municipios)->with('dept',$dept)->with('datos',$datos)->with('seccion_id',$seccion_id)->with('faltas',$faltas);

		}

public function vernotasdeestudiantes($seccion,$asignatura)
{
dd($asignatura,$seccion);
}

}
