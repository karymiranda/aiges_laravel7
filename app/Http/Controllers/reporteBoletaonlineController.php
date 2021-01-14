<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\pdfBoletaonlineController;

use App\Notas;
use App\Seccion;
use App\NotasItems;
use App\EvaluacionesPeriodo;
use App\InfoCentroEducativo;
use App\Periodoevaluacion;
use App\Expedienteestudiante;
use App\AsistenciasEstudiantes;
use App\Competenciasciudadanas;
use Laracasts\Flash\Flash;

class reporteBoletaonlineController extends Controller
{
  public function index($id, $anio)
  {
  	//dd($id);
 $sec=Seccion::whereHas('seccion_estudiante', function($query) use ($anio,$id){
$query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estudiante_id','=',$id],['tb_matriculaestudiante.v_estadomatricula','aprobada']]);
})->first();

if($sec!=null)//si esta matriculado
{
    $centroEscolar = InfoCentroEducativo::first();
    $seccion_id = $sec->id;
    $notasEst   = Notas::where('seccion_id', $seccion_id)->get();
 
    if(!count($notasEst)>0)//si no hay notas registradas
    {
      
    }
    $itemsNotasEst = $this->orderStudentNota($notasEst);
    $evaluaciones = EvaluacionesPeriodo::orderby('codigo_eval', 'asc')->get();
    $profesor = $sec->seccion_empleado;
    $students = DB::table('tb_expedienteestudiante')
      ->join('tb_matriculaestudiante', 'tb_matriculaestudiante.estudiante_id', '=', 'tb_expedienteestudiante.id')
      ->where('tb_matriculaestudiante.estudiante_id', $id)
      ->where('tb_matriculaestudiante.seccion_id', $seccion_id)
      ->select(
        "tb_expedienteestudiante.id",
        "tb_expedienteestudiante.v_nombres",
        "tb_expedienteestudiante.v_apellidos",
        "tb_expedienteestudiante.v_nie",
        "tb_expedienteestudiante.v_expediente")
      ->orderBy('tb_expedienteestudiante.v_apellidos', 'asc')
      ->orderBy('tb_expedienteestudiante.v_nombres', 'asc')
      ->get();

    $asistenciaEst= $this->getAsistencia($students,$sec);
    $competenciasEst= $this->getCompetencias($students,$sec);

    $pdf = new pdfBoletaonlineController("L");
    foreach ($students as $value) {
      $pdf->AddPage();
      $pdf->headerBoletaNotas($centroEscolar);

      $pdf->boletaTitulo([
        "seccion" =>  $sec,
        "alumno" => $value,
        "profesor"  => $profesor
      ]);
    
     $pdf->asistenciaTable($asistenciaEst[$value->v_expediente]);
      $pdf->tableNotesBoleta([
        //"varnotasS"   => @$itemsNotasEst[$value->v_expediente]['notasEst'],
       "varnotasS"   => @$itemsNotasEst[$value->v_expediente],
        "eva"     => $evaluaciones 
      ]);

     $criterios=Competenciasciudadanas::where('estado',1)->get();
     $pdf->competenciasTable($competenciasEst[$value->v_expediente],$criterios);


      $pdf->footerNotesBoletas([
        "profesor"  => $profesor,
        "centro"    => $centroEscolar
      ]);

      $pdf->FooterConstancia();
    }

    return response()->make($pdf->Output(), 200, [
      'Content-Type' => 'application/pdf',
      'Content-Disposition' => 'inline; filename="doc.pdf"'
    ]);
}//fin del else
  }

  public function getAsistencia($students,$sec)
{
 $res = array();
foreach ($students as $key => $value) {
$res[$value->v_expediente]['asistencia']=AsistenciasEstudiantes::where([['expedienteestudiante_id',$value->id],['año',$sec->anio]])->count();

$res[$value->v_expediente]['inasisinjust']=AsistenciasEstudiantes::where([['expedienteestudiante_id',$value->id],['año',$sec->anio],['v_asistenciaSN','N'],['justificacion','Sin justificar']])->count();

$res[$value->v_expediente]['inasjust']=AsistenciasEstudiantes::where([['expedienteestudiante_id',$value->id],['año',$sec->anio],['v_asistenciaSN','N'],['justificacion','!=','Sin justificar']])->count();
}
return $res;
}


public function getCompetencias($students,$sec)
{
  $idseccion=$sec->id;
$conductaArray=[];
foreach ($students as $value) {
  $conductaArray[$value->v_expediente]=
$conducta=self::getStudentConducta($value->id,$idseccion);
}
return $conductaArray;
}

private function getStudentConducta($id,$idseccion) {
        $sqlQuery = "SELECT cda.criterio_1, cda.criterio_2, cda.criterio_3, cda.criterio_4, cda.criterio_5, tbe.v_nombres, tbe.v_nie, tbe.v_apellidos, tbm.seccion_id FROM tb_expedienteestudiante as tbe INNER JOIN tb_matriculaestudiante as tbm ON tbm.estudiante_id = tbe.id and tbm.seccion_id={$idseccion} INNER JOIN conducta_alumno as cda ON cda.alumno_id =  tbe.id where cda.alumno_id={$id}";
        return DB::select(
            DB::raw($sqlQuery)
        );
    }

   public function orderStudentNota($notas = array())
  {
    $result = array();
    foreach ($notas as $item) {      
      foreach ($item->notas as $value) {
         $result[$value->alumno->v_expediente]['notas'][$item->asignatura->asignatura][$item->periodo->nombre][$item->evaluacion->codigo_eval] = floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);


      }
    }
    return $result;
  }
}


