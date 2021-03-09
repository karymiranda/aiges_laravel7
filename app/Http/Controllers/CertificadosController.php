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
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;


class CertificadosController extends Controller
{
     var $height = 6; 
    public function generarcertificados($seccion_id)
    {
    
 $rc=new ResporteController();

 $centroEscolar = InfoCentroEducativo::first();
 $seccion=Seccion::find($seccion_id);
 $cuadroseccion=$this->comprobarcuadrofinal($seccion_id);
 $cuadro=  self::getArrayNotesStudents($seccion_id); 
 $conducta= self::getArrayConductaStudents($seccion_id,$seccion);
 $criterios=Competenciasciudadanas::where('estado',1)->get();



if($seccion->nivel<9)//de primero a octavo
{
if(!count($cuadroseccion)>0)
  {
    Flash::error("No es posible generar los certificados. Genere el cuadro final de su sección e intente nuevamente.")->important();
    return redirect()->route('listareportes/secciones');
  }


 //$cuadros = CuadroFinal::where("seccion_id", $seccion_id)->first();
 $fpdf= new Fpdf("P","mm","Letter");

foreach ($cuadro as $key => $value) 
{
$fpdf->AddPage();
$fpdf->SetMargins(10,30,10,10);
$this->cabeceracertificadoprimerciclo($fpdf,$centroEscolar,$seccion,$value,$key);
$this->subcabeceraprimerciclo($fpdf,$seccion,$cuadro,$key);
$this->tabla($fpdf,$cuadro,$key,$criterios,$conducta,$seccion);
$this->footerbasica($fpdf);
}

$fpdf->SetTitle("certificados".$seccion->descripcion.date('_Ymd'));
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;

}
  else // solo noveno
{
if(!count($cuadroseccion)>0)
  {
    Flash::error("No es posible generar los certificados. Genere el cuadro final de su sección e intente nuevamente.")->important();
    return redirect()->route('listareportes/secciones');
  }

$fpdf= new Fpdf("P","mm","Letter");

foreach ($cuadro as $key => $value) 
{
$fpdf->AddPage();
$fpdf->SetMargins(10,30,10,10);
$this->cabeceracertificadoprimerciclo($fpdf,$centroEscolar,$seccion,$value,$key);
$this->subcabeceraprimerciclo($fpdf,$seccion,$cuadro,$key);
$this->tabla($fpdf,$cuadro,$key,$criterios,$conducta,$seccion);
$this->footernoveno($fpdf);
}

$fpdf->SetTitle("certificados".$seccion->descripcion.date('_Ymd'));
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;
}

}


 public function comprobarcuadrofinal($seccion_id)
 {
$res=CuadroFinal::where('seccion_id',$seccion_id)->get();
return  $res;
 }


public function tabla($fpdf,$cuadro,$key,$criterios,$conducta,$seccion)
{
$formatter = new NumeroALetras();

$fpdf->Ln(4);
$fpdf->SetFillColor(210);
$fpdf->SetFont('Arial','B', 9);
$fpdf->Cell(80, 12, "Componente plan de estudio", 1, 0, 'C', 1);
$fpdf->Cell(70, $this->height, strtoupper("Nota final"), 1, 1, 'C', 1);
$fpdf->Cell(80);
$fpdf->Cell(35, $this->height, utf8_decode("Número o concepto"), 1, 0, 'C', 1);
$fpdf->Cell(35, $this->height, "Letras", 1, 0, 'C', 1);
$fpdf->SetXY(155,109);
$fpdf->Cell(50, 12, "Resultado", 1, 1, 'C', 1);

$fpdf->SetFillColor(250);
$fpdf->SetFont('Arial','B', 8);
$fpdf->Cell(80, $this->height, utf8_decode("ÁREA BÁSICA"), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, utf8_decode(""), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, "", 1, 0, 'C', 1);
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);

$fpdf->SetFont('Arial','', 8);
$fpdf->Cell(80, $this->height, utf8_decode('LENGUAJE'), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, number_format($cuadro[$key]->lenguaje,0), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, $formatter->toWords($cuadro[$key]->lenguaje, 0), 1, 0, 'C', 1);
if($cuadro[$key]->lenguaje>=5)
{$fpdf->Cell(50, $this->height, "Aprobado", 1, 1, 'C', 1);}
else
{$fpdf->Cell(50, $this->height, "Reprobado", 1, 1, 'C', 1);}


$fpdf->Cell(80, $this->height, utf8_decode('MATEMÁTICAS'), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, number_format($cuadro[$key]->matematica,0), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, $formatter->toWords($cuadro[$key]->matematica, 0), 1, 0, 'C', 1);
if($cuadro[$key]->matematica>=5)
{$fpdf->Cell(50, $this->height, "Aprobado", 1, 1, 'C', 1);}
else
{$fpdf->Cell(50, $this->height, "Reprobado", 1, 1, 'C', 1);}


$fpdf->Cell(80, $this->height, utf8_decode('CIENCIA, SALUD Y MEDIO AMBIENTE'), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, number_format($cuadro[$key]->ciencia,0), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, $formatter->toWords($cuadro[$key]->ciencia, 0), 1, 0, 'C', 1);
if($cuadro[$key]->ciencia>=5)
{$fpdf->Cell(50, $this->height, "Aprobado", 1, 1, 'C', 1);}
else
{$fpdf->Cell(50, $this->height, "Reprobado", 1, 1, 'C', 1);}


$fpdf->Cell(80, $this->height, utf8_decode('ESTUDIOS SOCIALES'), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, number_format($cuadro[$key]->sociales,0), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, $formatter->toWords($cuadro[$key]->sociales, 0), 1, 0, 'C', 1);
if($cuadro[$key]->sociales>=5)
{$fpdf->Cell(50, $this->height, "Aprobado", 1, 1, 'C', 1);}
else
{$fpdf->Cell(50, $this->height, "Reprobado", 1, 1, 'C', 1);}

if($seccion->nivel<7)//si es seccion de tercer ciclo entonces mostrara ingles en lugar de artistica
{
$fpdf->Cell(80, $this->height, utf8_decode('EDUCACIÓN ARTISTICA'), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, number_format($cuadro[$key]->artistica,0), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, $formatter->toWords($cuadro[$key]->artistica, 0), 1, 0, 'C', 1);
if($cuadro[$key]->artistica>=5)
{$fpdf->Cell(50, $this->height, "Aprobado", 1, 1, 'C', 1);}
else
{$fpdf->Cell(50, $this->height, "Reprobado", 1, 1, 'C', 1);}
}
else
{ 
$fpdf->Cell(80, $this->height, utf8_decode('INGLÉS'), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, number_format($cuadro[$key]->ingles,0), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, $formatter->toWords($cuadro[$key]->ingles, 0), 1, 0, 'C', 1);
if($cuadro[$key]->ingles>=5)
{$fpdf->Cell(50, $this->height, "Aprobado", 1, 1, 'C', 1);}
else
{$fpdf->Cell(50, $this->height, "Reprobado", 1, 1, 'C', 1);}
}


$fpdf->Cell(80, $this->height, utf8_decode('EDUCACIÓN FÍSICA'), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, number_format($cuadro[$key]->fisica,0), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, $formatter->toWords($cuadro[$key]->fisica, 0), 1, 0, 'C', 1);
if($cuadro[$key]->fisica>=5)
{$fpdf->Cell(50, $this->height, "Aprobado", 1, 1, 'C', 1);}
else
{$fpdf->Cell(50, $this->height, "Reprobado", 1, 1, 'C', 1);}


$fpdf->SetFillColor(250);
$fpdf->SetFont('Arial','B', 8);
$fpdf->Cell(80, $this->height, utf8_decode("ÁREA COMPLEMENTARIA"), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, utf8_decode(""), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, "", 1, 0, 'C', 1);
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);
$fpdf->SetFont('Arial','', 8);
$fpdf->Cell(80, $this->height, utf8_decode('MORAL, URBANIDAD Y CÍVICA'), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, number_format($cuadro[$key]->urbanida,0), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, $formatter->toWords($cuadro[$key]->urbanida, 0), 1, 0, 'C', 1);
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);


$fpdf->SetFillColor(250);
$fpdf->SetFont('Arial','B', 8);
$fpdf->Cell(80, $this->height, utf8_decode("COMPETENCIAS CIUDADANAS"), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height, utf8_decode(""), 1, 0, 'C', 1);
$fpdf->Cell(30, $this->height, "", 1, 0, 'C', 1);
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);


$fpdf->SetFont('Arial','', 8);
//$fpdf->Cell(80, $this->height,strtoupper(utf8_decode($criterios[0]->competencia)), 1, 0, 'L', 1);

//$fpdf->SetY(20);
$fpdf->Image('CC1.png',100, 6, 20);



$fpdf->Cell(35, $this->height,isset($conducta[$key]->criterio_1)?$conducta[$key]->criterio_1 :'-', 1, 0, 'C', 1);
if(isset($conducta[$key]->criterio_1)){
if($conducta[$key]->criterio_1=='E'){
$fpdf->Cell(30, $this->height, utf8_decode("EXCELENTE"), 1, 0, 'C', 1);
}else if($conducta[$key]->criterio_1=='MB')
{$fpdf->Cell(30, $this->height, utf8_decode("MUY BUENO"), 1, 0, 'C', 1);}
else{$fpdf->Cell(30, $this->height, utf8_decode("BUENO"), 1, 0, 'C', 1);}
}else
{$fpdf->Cell(30, $this->height, '-', 1, 0, 'C', 1);}
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);



$fpdf->Cell(80, $this->height,strtoupper(utf8_decode($criterios[1]->competencia)), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height,isset($conducta[$key]->criterio_2)?$conducta[$key]->criterio_2 :'-', 1, 0, 'C', 1);
if(isset($conducta[$key]->criterio_2)){
if($conducta[$key]->criterio_2=='E'){
$fpdf->Cell(30, $this->height, utf8_decode("EXCELENTE"), 1, 0, 'C', 1);
}else if($conducta[$key]->criterio_2=='MB')
{$fpdf->Cell(30, $this->height, utf8_decode("MUY BUENO"), 1, 0, 'C', 1);}
else{$fpdf->Cell(30, $this->height, utf8_decode("BUENO"), 1, 0, 'C', 1);}
}else{$fpdf->Cell(30, $this->height,'-', 1, 0, 'C', 1);}
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);


$fpdf->Cell(80, $this->height,utf8_decode(strtoupper($criterios[2]->competencia)), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height,isset($conducta[$key]->criterio_3)?$conducta[$key]->criterio_3:'-', 1, 0, 'C', 1);
if(isset($conducta[$key]->criterio_3)){
if($conducta[$key]->criterio_3=='E'){
$fpdf->Cell(30, $this->height, utf8_decode("EXCELENTE"), 1, 0, 'C', 1);
}else if($conducta[$key]->criterio_3=='MB')
{$fpdf->Cell(30, $this->height, utf8_decode("MUY BUENO"), 1, 0, 'C', 1);}
else{$fpdf->Cell(30, $this->height, utf8_decode("BUENO"), 1, 0, 'C', 1);}
}else{$fpdf->Cell(30, $this->height,'-', 1, 0, 'C', 1);}
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);


$fpdf->Cell(80, $this->height,strtoupper(utf8_decode($criterios[3]->competencia)), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height,isset($conducta[$key]->criterio_4)?$conducta[$key]->criterio_4:'-', 1, 0, 'C', 1);
if(isset($conducta[$key]->criterio_4)){
if($conducta[$key]->criterio_4=='E'){
$fpdf->Cell(30, $this->height, utf8_decode("EXCELENTE"), 1, 0, 'C', 1);
}else if($conducta[$key]->criterio_4=='MB')
{$fpdf->Cell(30, $this->height, utf8_decode("MUY BUENO"), 1, 0, 'C', 1);}
else{$fpdf->Cell(30, $this->height, utf8_decode("BUENO"), 1, 0, 'C', 1);}
}else{$fpdf->Cell(30, $this->height,'-', 1, 0, 'C', 1);}
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);


$fpdf->Cell(80, $this->height,strtoupper(utf8_decode($criterios[4]->competencia)), 1, 0, 'L', 1);
$fpdf->Cell(35, $this->height,isset($conducta[$key]->criterio_5)?$conducta[$key]->criterio_2:'-', 1, 0, 'C', 1);
if(isset($conducta[$key]->criterio_5)){
if($conducta[$key]->criterio_5=='E'){
$fpdf->Cell(30, $this->height, utf8_decode("EXCELENTE"), 1, 0, 'C', 1);
}else if($conducta[$key]->criterio_5=='MB')
{$fpdf->Cell(30, $this->height, utf8_decode("MUY BUENO"), 1, 0, 'C', 1);}
else{$fpdf->Cell(30, $this->height, utf8_decode("BUENO"), 1, 0, 'C', 1);}
}
else{$fpdf->Cell(30, $this->height,'-', 1, 0, 'C', 1);}
$fpdf->Cell(50, $this->height, "", 1, 1, 'C', 1);

}

public function footernoveno($fpdf)
{
$fecha = Carbon::now()->locale('es');;
  $mfecha = $fecha->monthName;
  $dfecha = $fecha->day;
  $afecha = $fecha->year;
$fpdf->Ln(10);
$fpdf->SetFont('Arial','','10');
$fpdf->MultiCell(0,$this->height,utf8_decode("POR TANTO: queda facultado para matricularse en el nivel inmediato superior, se extiende la presente en el departamento de SAN VICENTE, el dia ").$dfecha ." de ".$mfecha." de ".$afecha.".",0,1,"L"); 

$fpdf->Ln(15);
//$fpdf->Cell(95, $this->height, "_________________________________", 0, 0, 'C');   
//$fpdf->Cell(95, $this->height, "__________________________", 0, 1, 'C');
$fpdf->SetFont('Arial','B','10');  
$fpdf->Cell(95, $this->height, "  Director (a) del Centro Educativo", 0, 0, 'C');
$fpdf->Cell(100, $this->height, "Persona Responsable", 0, 0, 'C');
$fpdf->SetFont('Arial','','8'); 
$fpdf->SetY(-30);
//$fpdf->Cell(0, $this->height, "Obtenido del sistena AIGES", 0, 0, ' L');
}


public function footerbasica($fpdf)
{
$fecha = Carbon::now()->locale('es');;
  $mfecha = $fecha->monthName;
  $dfecha = $fecha->day;
  $afecha = $fecha->year;
$fpdf->Ln(10);
$fpdf->SetFont('Arial','','10');
$fpdf->MultiCell(0,$this->height,utf8_decode("POR TANTO: queda facultado para matricularse en el grado inmediato superior, se extiende la presente en el departamento de SAN VICENTE, el dia ").$dfecha ." de ".$mfecha." de ".$afecha.".",0,1,"L"); 

$fpdf->Ln(15);
//$fpdf->Cell(95, $this->height, "_________________________________", 0, 0, 'C');   
//$fpdf->Cell(95, $this->height, "__________________________", 0, 1, 'C');
$fpdf->SetFont('Arial','B','10');  
$fpdf->Cell(95, $this->height, "  Director (a) del Centro Educativo", 0, 0, 'C');
$fpdf->Cell(100, $this->height, "Persona Responsable", 0, 0, 'C');
$fpdf->SetFont('Arial','','8'); 
$fpdf->SetY(-30);
//$fpdf->Cell(0, $this->height, "Obtenido del sistena AIGES", 0, 0, ' L');
}

/*public function subcabeceranoveno($fpdf,$seccion,$cuadro,$key)
{
$fpdf->Ln(10);
$fpdf->SetFillColor(250);
$fpdf->SetFont('Arial','','10');
$fpdf->MultiCell(0,$this->height,utf8_decode("El(la) infrascrito Director(a) certifica que ".strtoupper($cuadro[$key]->v_nombres)." ".strtoupper($cuadro[$key]->v_apellidos)." con NIE ".$cuadro[$key]->v_nie." durante el año ".$seccion->anio.", ha cursado y aprobado el ".$seccion->seccion_grado->grado." Grado - de - Educación Básica - Regular obteniendo las siguientes calificaciones: "),0,1,"L");


}*/

public function subcabeceraprimerciclo($fpdf,$seccion,$cuadro,$key)
{
$fpdf->Ln(10);
$fpdf->SetFillColor(250);
$fpdf->SetFont('Arial','','10');
$fpdf->MultiCell(0,$this->height,utf8_decode("El(la) infrascrito Director(a) certifica que ".strtoupper($cuadro[$key]->v_nombres)." ".strtoupper($cuadro[$key]->v_apellidos)." con NIE ".$cuadro[$key]->v_nie." durante el año ".$seccion->anio.", ha cursado y aprobado el ".$seccion->seccion_grado->grado." Grado - de - Educación Básica - Regular obteniendo las siguientes calificaciones: "),0,1,"L");


}

public function cabeceracertificadoprimerciclo($fpdf,$centroEscolar,$seccion,$value,$key)
 {
$fpdf->SetY(20);
$fpdf->SetFont('Arial','','10');
$fpdf->Image('EscudoDeElSalvador.jpg',100, 6, 20);
$fpdf->SetY(30);
$fpdf->Cell(0,$this->height,utf8_decode("MINISTERIO DE EDUCACIÓN, CIENCIA Y TECNOLOGÍA"),0,1,"C");
$fpdf->Cell(0,$this->height,utf8_decode("DIRECCIÓN NACIONAL DE GESTIÓN EDUCATIVA"),0,1,"C");
$fpdf->Cell(0,$this->height,utf8_decode("DEPARTAMENTO DE ACREDITACIÓN INSTITUCIONAL"),0,1,"C");
$fpdf->SetFont('Arial','B','10');
$fpdf->Cell(0,$this->height,utf8_decode("CERTIFICADO DE PROMOCIÓN"),0,1,"C");

$fpdf->Ln(5);
$fpdf->SetFont('Arial','B','8');
$fpdf->SetFillColor(210);
$fpdf->SetX(35);
$fpdf->Cell(55,$this->height,"Sede Educativa",1,0,'L',0);
$fpdf->SetFont('Arial','','8');
$fpdf->Cell(95,$this->height,$centroEscolar->v_codigoinfraestructura.'-'.utf8_decode($centroEscolar->v_nombrecentro),1,1,'L',0);
$fpdf->SetFont('Arial','B','8');
$fpdf->SetX(35);
$fpdf->Cell(55,$this->height,"Servicio Educativo",1,0,'L',0);
$fpdf->SetFont('Arial','','8');
$fpdf->Cell(95,$this->height,$seccion->seccion_grado->grado.utf8_decode(" Grado-de-Educación Básica-Regular"),1,1,'L',0);
$fpdf->SetFont('Arial','B','8');
$fpdf->SetX(35);
$fpdf->Cell(55,$this->height,"Plan de Estudio",1,0,'L',0);
$fpdf->SetFont('Arial','','8');
$fpdf->Cell(95,$this->height,utf8_decode("Plan de Educación Básica"),1,1,'L',0);
$fpdf->SetFont('Arial','B','8');
$fpdf->SetX(35);
$fpdf->Cell(55,$this->height,"Grado",1,0,'L',0);
$fpdf->SetFont('Arial','','8');
$fpdf->Cell(30,$this->height,$seccion->seccion_grado->grado,1,0,'L',0);
$fpdf->Cell(15,$this->height,utf8_decode("Sección"),1,0,'L',0);
$fpdf->Cell(20,$this->height,$seccion->seccion."-".utf8_decode($seccion->seccion_turno->turno),1,0,'L',0);
$fpdf->Cell(15,$this->height,utf8_decode("Año"),1,0,'L',0);
$fpdf->Cell(15,$this->height,$seccion->anio,1,1,'L',0);
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
