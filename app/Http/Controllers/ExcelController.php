<?php

namespace App\Http\Controllers;
use App\Catalogodecuenta;
use App\ActivoFijo;
use App\Permiso;
use App\Expedienteestudiante;
use App\Seccion;
use App\Empleado;
use App\AsistenciasRH;
use App\Grados;
use App\Familiares;
use App\Notas;
use App\NotasItems;
use App\Asignaturas;
use App\Periodoevaluacion;
use App\AsistenciasEstudiantes;
use App\Exports\BitacoraExport;
use App\Exports\UsuariosExport;
use App\Exports\RrhhExport;
use App\Exports\CalificacionesExport;
use App\Exports\AsistenciadocentesExport;
use App\Exports\AsistenciaestudiantesExport;
use App\Exports\NominaalumnosseccionExport;
use App\Exports\NominaalumnoswithViewExport;
use App\Exports\NominafamiliareswithViewExport;
use App\Exports\permisosRhExport;
use App\Exports\ListaactivofijoExport;
use App\Exports\CatalogoactivofijoExport;
use App\Exports\TrasladoactivosExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Http\Controllers\ConsultasyreportesController;
use App\Http\Controllers\ResporteController;

class ExcelController extends Controller
{
	public function exportUsuarios() 
    {
    	$today = Carbon::now()->format('d_m_Y');
    	$name = 'Usuarios_'.$today.'.xlsx';
        return Excel::download(new UsuariosExport, $name);
    }

/////RECURSO HUMANO
    public function exportRrhh() 
    {
    	$today = Carbon::now()->format('d_m_Y');
    	$name = 'RecursoHumano_'.$today.'.xlsx';
        return Excel::download(new RrhhExport, $name);
    }

 public function permisosrrhh_excel($mes,$anio)
 {
 // dd('permisos');
  $meses=$this->mes($mes);

 $hoy = Carbon::now();
        $anio = $anio;
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d",strtotime($anio."-".$mes."-".$primer_dia));
        $fecha_final=date("Y-m-d", strtotime($anio."-".$mes."-".$ultimo_dia) );

$permisos=Permiso::orderBy('solicitante_id','ASC')->whereHas('empleado', function($q)
    {
      $q->where('estado',1); 
    })->with('empleado')->with('motivoPermiso')->where('estado','Aprobada')
    ->WhereBetween('f_desde',[$fecha_inicial,$fecha_final])
    ->WhereBetween('f_hasta',[$fecha_inicial,$fecha_final])
    ->get();
    $name = 'Permisoseincapacidades_'.$meses.'_'.$anio.'.xlsx';
return Excel::download(new permisosRhExport($permisos),$name);
 }

 public function getUltimoDiaMes($elAnio,$elMes)
  {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
  }

////////////////////////////////
    public function asistencia_Excel($fechadesde,$fechahasta,$idseccion)
    {
   $seccion=Seccion::find($idseccion); 
   $anio=$seccion->anio;

  $sqlQueryasistencia = "SELECT tb_secciones.seccion,tb_secciones.codigo,tb_asistenciaestudiantes.f_fecha,tb_expedienteestudiante.v_nie,tb_asistenciaestudiantes.v_asistenciaSN,tb_asistenciaestudiantes.justificacion,tb_asistenciaestudiantes.observacion FROM tb_asistenciaestudiantes INNER JOIN tb_expedienteestudiante INNER JOIN tb_secciones INNER JOIN tb_matriculaestudiante WHERE tb_asistenciaestudiantes.expedienteestudiante_id=tb_expedienteestudiante.id and tb_matriculaestudiante.estudiante_id=tb_expedienteestudiante.id and tb_matriculaestudiante.seccion_id=tb_secciones.id and tb_secciones.id = ".$seccion->id." AND tb_asistenciaestudiantes.f_fecha Between '".$fechadesde."' AND '".$fechahasta." '";
    
$asistencias= DB::select( DB::raw($sqlQueryasistencia));
$asistencias=collect($asistencias);//convirto el array a una colleccion para que no me de problemas al exportarlo a la vista
//dd($asistencias);
     
        $today = Carbon::now()->format('d_m_Y');
        $name = 'Asistencias_'.$seccion->descripcion.'_'.$today.'.xlsx';

 return Excel::download(new AsistenciaestudiantesExport($asistencias), $name);

    }
/////////////////////////////////////

    public function nominaestudiantes_excelView($idseccion)//esta es la que estoy usando
    {
$id=$idseccion;
$seccion=Seccion::find($id);
$listaestudiantes=Expedienteestudiante::with(['estudiante_familiares'=>function($q){
$q->where('tb_estudiante_familiar.encargado','like','SI')->get();}])->whereHas('estudiante_seccion', function ($q) use ($id){
  $q->where([['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->groupBy('id')->orderBy('v_apellidos','ASC')->get();

        $today = Carbon::now()->format('d_m_Y');
        $name = 'Nominaestudiantes_'.$today.'.xlsx';

 return Excel::download(new NominaalumnoswithViewExport($listaestudiantes), $name);
    }
  
//////////////////////////////
  public function nominafamiliares_excelView($idseccion)//esta es la que estoy usando
    {
$id=$idseccion;
$seccion=Seccion::find($id);
$anio=$seccion->anio;
$listafamiliares=Expedienteestudiante::with(['estudiante_familiares'=>function($q){
$q->with('parentesco')->where('tb_familiares.estado',1)->get();}])->whereHas('estudiante_seccion', function ($q) use ($anio,$id){
  $q->where([['tb_matriculaestudiante.anio','=',$anio],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->orderBy('v_apellidos','ASC')->get();


        $today = Carbon::now()->format('d_m_Y');
        $name = 'Nominafamiliares_'.$today.'.xlsx';

 return Excel::download(new NominafamiliareswithViewExport($listafamiliares), $name);
    } 

///////////////////////////////////////////////////////////////////////////////////////////////



     public function nominaestudiantes_Excel($idseccion)//fuera de uso
    {
$id=$idseccion;
$seccion=Seccion::find($id);
$listaestudiantes=Expedienteestudiante::with(['estudiante_familiares'=>function($q){
$q->with('parentesco')->where('tb_familiares.encargado','like','SI')->get();}])->whereHas('estudiante_seccion', function ($q) use ($id){
  $q->where([['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->groupBy('id')->get();

return (new NominaalumnosseccionExport($listaestudiantes))->download('nominaestudiantes.xlsx');
    }
//////////////////////////////////////////////////////////////////////////////////////////// 
 
    public function calificaciones_Excel($idseccion,$idperiodo,$idasignatura)
    {    
      $seccion=Seccion::find($idseccion);
      $asignatura=Asignaturas::find($idasignatura);
      $periodo=Periodoevaluacion::find($idperiodo);



$notasEst   = Notas::where('seccion_id', $idseccion)->get();
$notas = $this->orderStudentNota($notasEst,$idperiodo,$idasignatura);
$students = DB::table('tb_expedienteestudiante')
      ->join('tb_matriculaestudiante', 'tb_matriculaestudiante.estudiante_id', '=', 'tb_expedienteestudiante.id')
      ->where('tb_matriculaestudiante.seccion_id', $idseccion)
      ->select(
        "tb_expedienteestudiante.id",
        "tb_expedienteestudiante.v_nombres",
        "tb_expedienteestudiante.v_apellidos",
        "tb_expedienteestudiante.v_nie",
        "tb_expedienteestudiante.v_expediente")
      ->orderBy('tb_expedienteestudiante.v_apellidos', 'asc')
      ->orderBy('tb_expedienteestudiante.v_nombres', 'asc')
      ->get();


      //$notas=Notas::with('notas')->where([['seccion_id',$idseccion],['periodo_id',$idperiodo],['asignatura_id',$idasignatura]])->get();

  $name = 'calificaciones_'.$seccion->descripcion.'_'.$asignatura->asignatura.'_'.$periodo->nombre.'.xlsx';
  return Excel::download(new CalificacionesExport($notas,$seccion,$asignatura,$periodo,$students), $name);
      
    }

     public function orderStudentNota($varnotas = array(),$idperiodo,$idasignatura)
  {
    $result = array();
    foreach ($varnotas as $item) {
      foreach ($item->notas as $value) {
        $result[$value->alumno->v_expediente][$item->asignatura->asignatura][$item->periodo->nombre][$item->evaluacion->codigo_eval] =  floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);

        if($item->evaluacion->codigo_eval=='RF'){
         $result[$value->alumno->v_expediente][$item->asignatura->asignatura][$item->periodo->nombre][$item->evaluacion->codigo_eval] = floatval($value->calificacion);
       }

      }
    }
    return $result;
  }



    public function rptasistenciaexcelrrhh($mes,$anio)
    {
 $meses=$this->mes($mes);
 $primer_dia=1;
 $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
 $fecha_inicial=date("Y-m-d", strtotime($anio."-".$mes."-".$primer_dia) );
  $fecha_final=date("Y-m-d", strtotime($anio."-".$mes."-".$ultimo_dia) );

$docentes = Empleado::whereHas('tipoPersonal', function ($q){
  $q->where('v_tipopersonal','like','Docente');
})->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->get();

$datos=array();
  foreach ($docentes as $key => $docentes) 
  {
    for($d=$fecha_inicial;$d<=$fecha_final;$d++)
  {
      $permisos=Permiso::where([['solicitante_id','=',$docentes->id],['f_desde','<=',$d],['f_hasta','>=',$d],['estado','=','Aprobada']])->count();
      if($permisos>0)
      {
        $datos[$docentes->v_nombres.' '.$docentes->v_apellidos][$d]='P';
      }
      else
      {
        $asistencia = AsistenciasRH::where('expedientepersonal_id','=',$docentes->id)->where('fecha', '=',$d)->first();

        if(count($asistencia)>0)
        {
 if($asistencia->asistenciaSN=='S')
           {
           $datos[$docentes->v_nombres.' '.$docentes->v_apellidos][$d]='+';
            }
            else
            {
             $datos[$docentes->v_nombres.' '.$docentes->v_apellidos][$d]='-'; 
            }
        }
        else
        {
          $datos[$docentes->v_nombres.' '.$docentes->v_apellidos][$d]='N';
        }
      }


 }//fin
 }//fin foreach

 //dd($datos); 
 $name = 'asistenciaRH_'.$meses.'_'.$anio.'.xlsx';    
    return Excel::download(new AsistenciadocentesExport($datos,$docentes,$ultimo_dia),$name);
    }

public function exportListadoactivofijo_excel($categoria,$estado)
    {
      if($categoria==0){$categoria=null;}
    $lista=new ConsultasyreportesController();
    $hoy = Carbon::now();
    $hoy = $hoy->format('dmY');
  $name = 'listadoactivofijo_'.$hoy.'.xlsx';
  $activos=$lista->activosrpt($estado,$categoria);
  return Excel::download(new ListaactivofijoExport($activos),$name);
    }

  public function exportcatalogoactivos_excel($categoria,$estado)
    {
if($categoria==0)
{
  $catalogo = Catalogodecuenta::orderBy('v_codigocuenta','ASC')->where([['v_codigocuenta','LIKE','12%'],['v_nivel',4]])->get();
      
}
  else{ 
   $catalogo = Catalogodecuenta::where([['v_codigocuenta','LIKE',$categoria.'%'],['v_nivel',4]])->get();  
  }  
    $hoy = Carbon::now();
    $hoy = $hoy->format('dmY');
  $name = 'catalogoactivofijo_'.$hoy.'.xlsx';
  $cuentas=Catalogodecuenta::Orderby('v_codigocuenta','Desc')->where('estado',1)->get();
  return Excel::download(new CatalogoactivofijoExport($cuentas),$name); 
    }

public function exportrasladosactivos_excel($categoria,$tipotraslado)
    {
  if($categoria==0){$categoria=null;}
  $tras=new ConsultasyreportesController();
  $traslados=$tras->trasladosrpt($tipotraslado,$categoria);
  $hoy = Carbon::now();
  $hoy = $hoy->format('dmY');
  $name = 'activostrasladados_'.$hoy.'.xlsx'; 
  return Excel::download(new TrasladoactivosExport($traslados),$name); 
    }

public function mes($mes)
{
switch ($mes) {
  case '1':
   $meses="ENERO";
    break;
    case '2':
   $meses="FEBRERO";
    break;
  case '3':
   $meses="MARZO";
    break;
  case '4':
   $meses="ABRIL";
    break;
  case '5':
   $meses="MAYO";
    break;
  case '6':
   $meses="JUNIO";
    break;
  case '7':
   $meses="JULIO";
    break;
  case '8':
   $meses="AGOSTO";
    break;
    case '9':
   $meses="SEPTIEMBRE";
    break;
  case '10':
   $meses="OCTUBRE";
    break;
  case '11':
   $meses="NOVIEMBRE";
    break;
  case '12':
   $meses="DICIEMBRE";
    break;
  default:
    # code...
    break;
}
return $meses;
}

public function exportBitacora() 
    {
      $today = Carbon::now()->format('d_m_Y');
      $name = 'BitacoraAIGES_'.$today.'.xlsx';
        return Excel::download(new BitacoraExport, $name);
    }

}
