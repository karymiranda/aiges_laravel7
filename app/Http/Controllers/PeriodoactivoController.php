<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PeriodoactivoRequest;
use App\Periodoactivo;
use App\Seccion;
use App\HorarioClases;
use App\Expedienteestudiante;
use App\Usuarios;
use App\EvaluacionesPeriodo;
use App\Periodoevaluacion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Laracasts\Flash\Flash;


class PeriodoactivoController extends Controller
{
    public function index()
	{
$ciclos=Periodoactivo::orderBy('anio','DESC')->where('tipo_periodo','like','ACADEMICO')->get();
//$mostrarboton=Periodoactivo::where('estado','=','1')->count();
$mostrarboton=null;
return view('admin.configuraciones.administracionacademica.cicloacademico.controlciclosacademicos')->with('ciclos',$ciclos)->with('mostrarboton',$mostrarboton);
	}

public function definircicloacademicoactivo($id)
{
//DB::beginTransaction(); 
$desactivarcicloacademico=Periodoactivo::where([['tipo_periodo','ACADEMICO'],['estado',1]])->first();

if(!empty($desactivarcicloacademico))
{

$desactivarcicloacademico->estado='0';//desactivo el ciclo actual ara reactivar el que se eligio
$desactivarcicloacademico->save();	

$horariosinactivos=HorarioClases::where('anio',$desactivarcicloacademico->anio)->get();
	//dd($cicloacademico->anio);
	if(count($horariosinactivos)>0){
		foreach ($horariosinactivos as $key => $horariosinactivos) {
		$horariosinactivos->estado='0';
		$horariosinactivos->save();
		}
		
	}
}

	 $cicloacademico=Periodoactivo::find($id);	//reactivo el nuevo ciclo
	 $cicloacademico->estado='1';
     $cicloacademico->save();


	//cambiar estado a horarios de clases
	$horariosactivos=HorarioClases::where('anio',$cicloacademico->anio)->get();
	//dd($cicloacademico->anio);
	if(count($horariosactivos)>0){
		foreach ($horariosactivos as $key => $horariosactivos) {
		$horariosactivos->estado='1';
		$horariosactivos->save();
		}
		
	}
	
	

		//cambiar de estado a matriculas activas de ese año
	$sqlQuery="UPDATE tb_matriculaestudiante SET estado=1 where anio=
	".$cicloacademico->anio." AND v_estadomatricula like 'aprobada'";

$consulta=DB::update(DB::raw($sqlQuery));
//$consulta=DB::select(DB::raw($sqlQuery));

	

if(!empty($desactivarcicloacademico)){
	//cambiar de estado a matriculas del año a desactivar
	$sqlQuery1="UPDATE tb_matriculaestudiante SET estado=0 where anio=
	".$desactivarcicloacademico->anio." AND v_estadomatricula like 'aprobada'";

	$consulta=DB::update(DB::raw($sqlQuery1));
}
		//desactivar periodos y evaluaciones de este año escolar
	$sqlQuery="UPDATE tb_periodoevaluaciones inner join tb_periodo_activo on tb_periodoevaluaciones.periodo_id=tb_periodo_activo.id set tb_periodoevaluaciones.estado=1 where tb_periodo_activo.anio=".$cicloacademico->anio;
	$consulta = DB::update( DB::raw($sqlQuery));
	
	if(!empty($desactivarcicloacademico)){
	$sqlQuery="UPDATE tb_periodoevaluaciones inner join tb_periodo_activo on tb_periodoevaluaciones.periodo_id=tb_periodo_activo.id set tb_periodoevaluaciones.estado=0 where tb_periodo_activo.anio=".$desactivarcicloacademico->anio;
	$consulta = DB::update( DB::raw($sqlQuery));
	}
		//cambiar estado a secciones activas
	$sqlQuery="UPDATE tb_secciones inner join tb_periodo_activo on tb_secciones.anio=tb_periodo_activo.anio set tb_secciones.estado=1 where tb_periodo_activo.id=".$id;
	$consulta = DB::update( DB::raw($sqlQuery));

if(!empty($desactivarcicloacademico)){
		//cambiar estado a secciones activas 
	$sqlQuery="UPDATE tb_secciones inner join tb_periodo_activo on tb_secciones.anio=tb_periodo_activo.anio set tb_secciones.estado=0 where tb_periodo_activo.id=".$desactivarcicloacademico->id;
	$consulta = DB::update( DB::raw($sqlQuery));
}
	   
		//$cicloacademico->estado='1';//actualizo estado del año escolar		
		//$fecha=Carbon::now();
        //$cicloacademico->fechacierreciclo= $fecha->format('Y-m-d');
       // $cicloacademico->save();
   //  DB::commit();
   
     Flash::success($cicloacademico->nombre ." activado exitosamente")->important(); 
    return redirect()->route('ciclosacademicos');	

}

	public function clausurarcicloacademico($id)
	{
	
//DB::beginTransaction();   
	 $cicloacademico=Periodoactivo::find($id);	
	$fecha = Carbon::today();	

	$f_fecha = $fecha->format('Y-m-d');
	//verificar que no existan secciones activas antes de cerrar el año academico
	$seccionesactivas=Seccion::where([['anio',$cicloacademico->anio],['estado',1]])->get();



if(count($seccionesactivas)>0)
{ 
     Flash::error("No se puede clausurar ciclo escolar. Debe cerrar todos los expedientes estudiantiles y secciones para poder continuar.")->important(); 
    return redirect()->route('ciclosacademicos');
}
else
{	
 
//desactivar periodos y evaluaciones de este año escolar

	/*$sqlQuery="UPDATE tb_periodoevaluaciones inner join tb_periodo_activo on tb_periodoevaluaciones.periodo_id=tb_periodo_activo.id set tb_periodoevaluaciones.estado=0 where tb_periodo_activo.anio=".$cicloacademico->anio;
	$consulta = DB::select(\DB::raw($sqlQuery));
*/


	$sqlQuery="UPDATE tb_periodoevaluaciones inner join tb_periodo_activo on tb_periodoevaluaciones.periodo_id=tb_periodo_activo.id set tb_periodoevaluaciones.estado=0 where tb_periodo_activo.anio=".$cicloacademico->anio;
	$students = DB::update( DB::raw($sqlQuery) );

	
		$cicloacademico->estado='0';//actualizo estado del año escolar		
		$fecha=Carbon::now();
        $cicloacademico->fechacierreciclo= $fecha->format('Y-m-d');
        $cicloacademico->save();
    // DB::commit();
   
     Flash::success($cicloacademico->nombre ." CLAUSURADO EXITOSAMENTE")->important();
     Flash::warning("SE RECOMIENDA COMPLETAR EL REGISTRO DE UN NUEVO CICLO ESCOLAR E INICIAR LAS CONFIGURACIONES PARA SECCIONES, HORARIOS DE CLASES, Y PERIODOS DE EVALUACION PARA UN OPTIMO FUNCIONAMIENTO DE LA APLICACION.")->important(); 
    return redirect()->route('registrarcicloacademico');	

	}
	}
	
	public function guardarcicloacademico(PeriodoactivoRequest $request)
	{
	$cicloacademico=new Periodoactivo($request->all());	
	$cicloacademico->tipo_periodo="ACADEMICO";
	$fecha=Carbon::now();
    $cicloacademico->fechainiciociclo= $fecha->format('Y-m-d');
    $cicloacademico->fechacierreciclo=null;
    $cicloacademico->estado='1';		
	$cicloacademico->save();
    Flash::success($cicloacademico->nombre ." guardado exitosamente")->important();
    return redirect()->route('ciclosacademicos');	
	}
public function registrarcicloacademico()
	{
$periodos=$this->anyos();
return view('admin.configuraciones.administracionacademica.cicloacademico.registrarcicloacademico')->with('periodos',$periodos);
	}

	public function editarcicloacademico($id)
	{
$periodos=$this->anyos();
$ciclos=Periodoactivo::find($id);
return view('admin.configuraciones.administracionacademica.cicloacademico.editarcicloacademico')->with('periodos',$periodos)->with('ciclos',$ciclos);
	}

	public function actualizarcicloacademico(PeriodoactivoRequest $request,$id)
	{
$ciclos=Periodoactivo::find($id);
$ciclos->nombre = $request->nombre;
$ciclos->anio = $request->anio;
$ciclos->save();
Flash::success("El ciclo académico ha sido actualizado")->important();
return redirect()->route('ciclosacademicos');
	}

	public function generarcertificados(Request $request)
	{
		dd('exito');
	}

	protected function anyos()
	{
	$anio = Carbon::now()->year;
for ($i=$anio+1; $i >2000 ; $i--) { //ara qu me envie la lista de los años a partir del 2000 al año actual+1
	$periodos[$i]=$i;}	
	return $periodos;	
	}
	
	
}
