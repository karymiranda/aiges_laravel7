<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PdfController;
use App\Notas;
use App\Seccion; 
use App\NotasItems;
use App\EvaluacionesPeriodo;
use App\InfoCentroEducativo;
use App\Periodoevaluacion;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class pdfcuadrorendimientoController extends Controller
{
     public function rendimientoescolar($id, $asignatura_id) 
  {

    $centroEscolar = InfoCentroEducativo::first();
    $seccion = Seccion::find($id);

$sqlQuerycargaacademica = "SELECT tb_empleado.v_nombres,tb_empleado.v_apellidos, tb_asignaturas.asignatura FROM tb_asignaturas inner join tb_horario_clases inner join tb_empleado  where tb_empleado.id=tb_horario_clases.docente_id AND tb_horario_clases.seccion_id = '".$id."'  AND tb_horario_clases.asignatura_id=tb_asignaturas.id  AND  tb_horario_clases.asignatura_id = '".$asignatura_id."' AND tb_horario_clases.anio ='".$seccion->anio." groupBy(tb_empleado.id)'";
$docente_asignatura=DB::select( DB::raw($sqlQuerycargaacademica));
$asig=collect($docente_asignatura)->first();//convierto a coleccion
$encargadomateriaverify=collect($docente_asignatura)->count();
//$encargadomateriaverify=$asig;
if($encargadomateriaverify>0)
{
$evaluaciones = EvaluacionesPeriodo::orderby('codigo_eval', 'asc')->get();
    $profesor = $seccion->seccion_empleado;
    $periodo = Periodoevaluacion::where('estado',1)->get();

    $notas   = Notas::where('seccion_id', $id)->where('asignatura_id', $asignatura_id)->get();
if(count($notas)>0)
{//verifico si hay notas guardadas para esa materia
    $itemsNotas = $this->orderStudentNota($notas); 
    
    //dd($periodo);
    $students = DB::table('tb_expedienteestudiante')
      ->join('tb_matriculaestudiante', 'tb_matriculaestudiante.estudiante_id', '=', 'tb_expedienteestudiante.id')
     // ->where('tb_matriculaestudiante.estado', 1)
      ->where('tb_matriculaestudiante.seccion_id', $id)
      ->select(
        "tb_expedienteestudiante.v_nombres",
        "tb_expedienteestudiante.v_apellidos",
        "tb_expedienteestudiante.v_nie",
        "tb_expedienteestudiante.v_expediente")
      //->orderBy('tb_expedienteestudiante.v_apellidos', 'asc')
      //->orderBy('tb_expedienteestudiante.v_nombres', 'asc')

      ->orderBy('tb_expedienteestudiante.v_expediente', 'desc')

      ->get();

    $pdf = new rendimientoescolarporasignaturaController ("L","mm","Letter");
    $pdf->AddPage();
      $pdf->headerBoletaNotas($centroEscolar);     
     /* $pdf->boletaTitulo([
        "seccion" =>  $seccion
      ]); */

    $pdf->boletasubtitulo($asig,$seccion);
    $pdf->headertablarendimientoescolar();

      $pdf->tableNotesBoleta([
        "periodo" => $periodo,
        "notas"   => @$itemsNotas,
        "eva"     => $evaluaciones,
        "students"  => $students
      ]);



      $pdf->footerNotesBoletas([
        "profesor"  => $profesor,
        "centro"    => $centroEscolar
      ]);

      $pdf->FooterConstancia();
    //}

    return response()->make($pdf->Output(), 200, [
      'Content-Type' => 'application/pdf',
      'Content-Disposition' => 'inline; filename="doc.pdf"'
    ]);
}
else//SI NO HAY NOTAS PARA LA ASIGNATURA MANDO ESTO PARA QUE NO ME DE ERROR
{
 $pdf = new rendimientoescolarporasignaturaController ("L","mm","Letter");
    $pdf->AddPage();
      $pdf->headerBoletaNotas($centroEscolar);     
      $pdf->boletaTitulo([
        "seccion" =>  $seccion
      ]); 
    $pdf->boletasubtitulo($asig,$seccion);
    $pdf->headertablarendimientoescolar();
   $pdf->Cell(260, 50, 'NO HAY NOTAS REGISTRADAS PARA ESTA ASIGNATURA' , 1, 1, 'C');
   $titulo='Rendimientoescolar'.Carbon::now();

    return response()->make($pdf->Output(), 200, [
      'Content-Type' => 'application/pdf',
      'Content-Disposition' => 'inline; filename="'.$titulo.'",'
    ]);

}//cierro else verifynotas
}//cierre if verifidocenteasignatura
else//else verifidocenteresponsable de asignatura
{
Flash::error('No hay información para mostrar.')->important();
return redirect()->route('listareportes/secciones');
}

}

  public function orderStudentNota($notas = array())
  {

    foreach ($notas as $item) {
      foreach ($item->notas as $value) {
      //foreach ($item->notas as $value) {
       /* $result[$value->alumno->v_expediente]['notas'][$item->asignatura->asignatura][$item->periodo->descripcion][$item->evaluacion->codigo_eval] = floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);  */ 
      		//}

             $result[$value->alumno->v_expediente]['notas'][$item->periodo->nombre][$item->evaluacion->codigo_eval] = floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100); 

  		}
    }

    
    return $result;
  }


}
