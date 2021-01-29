<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \Codedge\Fpdf\Fpdf\Fpdf;
use App\CuadroFinal;
use App\CuadroFinalNota;
use App\Competenciasciudadanas;
use App\Seccion;
use App\InfoCentroEducativo;
use App\Http\Controllers\CuadroFinalController;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;


class CertificadosController extends Controller
{
    public function generarcertificados($seccion_id,$formato)
{
 $centroEscolar = InfoCentroEducativo::first();
 $seccion=Seccion::find($seccion_id);
 $cuadroseccion=$this->comprobarcuadrofinal($seccion_id);
 $students=$this->estudiantes($seccion_id);
 //$cuadro= self::getArrayNotesStudents($seccion_id);
 //$conducta= self::getArrayConductaStudents($seccion_id,$seccion);


switch ($formato) {
	case '2'://estudiantes de primer y segundo ciclo
	
	if(!count($cuadroseccion)>0)
	{
    Flash::error("No es posible generar los certificados. Genere el cuadro final de su sección e intente nuevamente.")->important();
    return redirect()->route('listareportes/secciones');
	}

$fpdf= new Fpdf("L","mm","Letter");

foreach ($students as $value) 
{
$fpdf->AddPage();
}

$fpdf->SetTitle("certificados".$seccion->descripcion.date('_Ymd'));
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;

		break;

	case '3':
		dd('segundo');
		break;

	case '4': 
		dd('9');
		break;

	
	default:
		# code...
		break;
}


//$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal



}

public function estudiantes($seccion_id)
{

  $students = DB::table('tb_expedienteestudiante')
      ->join('tb_matriculaestudiante', 'tb_matriculaestudiante.estudiante_id', '=', 'tb_expedienteestudiante.id')
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
      return $students;
 
}


 public function comprobarcuadrofinal($seccion_id)
 {
$res=CuadroFinal::where('seccion_id',$seccion_id)->get();
return  $res;
 }

 public function cabeceracertificado()
 {

 }


    public function getArrayNotesStudents($id)
    {
        $sqlQuery = "SELECT cuadro_final_notas.id, cuadro_final_notas.alumno_id, cuadro_final_notas.lenguaje, cuadro_final_notas.matematica, cuadro_final_notas.ciencia, cuadro_final_notas.sociales, cuadro_final_notas.ingles, cuadro_final_notas.artistica, cuadro_final_notas.fisica, cuadro_final_notas.urbanida, cuadro_final_notas.estado, tb_expedienteestudiante.v_nie, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_apellidos FROM cuadro_final INNER JOIN cuadro_final_notas ON cuadro_final_notas.cuadro_final_id = cuadro_final.id INNER JOIN tb_expedienteestudiante ON cuadro_final_notas.alumno_id = tb_expedienteestudiante.id where cuadro_final.seccion_id = {$id}  order by tb_expedienteestudiante.id"; 
        return DB::select( DB::raw($sqlQuery));
    }

 public function getArrayConductaStudents($id,$seccion)
    {
      $sqlQuery = "SELECT conducta_alumno.* FROM conducta_alumno INNER JOIN tb_expedienteestudiante ON conducta_alumno.alumno_id = tb_expedienteestudiante.id INNER JOIN tb_periodoevaluaciones ON conducta_alumno.periodo_id = tb_periodoevaluaciones.id INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id WHERE tb_matriculaestudiante.seccion_id = {$id} AND conducta_alumno.periodo_id = (  SELECT tbp.id FROM tb_periodoevaluaciones tbp inner join tb_periodo_activo pa WHERE tbp.nombre = 'P3' and tbp.periodo_id=pa.id and pa.anio={$seccion->anio} ) ORDER BY alumno_id";
                       return DB::select( DB::raw($sqlQuery));
       }

}
