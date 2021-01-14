<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Codedge\Fpdf\Fpdf\Fpdf;

class pdfBoletaonlineController extends Fpdf
{
  var $height = 6; 

  // Para la boleta de notas encabezado
  public function headerBoletaNotas($centro)
  {
   // $routeImage = __DIR__."..\..\..\..\public\\".$centro['logo'];
     $routeImage = __DIR__."..\..\..\..\public\logoce.jpg";
    $routeImageMINED = __DIR__."..\..\..\..\public\EscudoDeElSalvador.jpg";

   $this->Image($routeImage, 10, 4, 15);
    $this->Image($routeImageMINED, 255, 6, 20);
    
    $this->SetFont('Arial','', 11);
    $this->Cell(0, $this->height - 1, utf8_decode('Ministerio de Educación, Ciencia y Tecnologia'), 0, 1, 'C');
    $this->SetFont('Arial','B',12);
    $this->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
  }

  public function boletaTitulo($object = array())
  {

    //$this->Ln(5);
    $this->SetFont('Arial','B', 10);
    $this->Cell(0, $this->height - 1, 'REGISTRO DE EVALUACION DEL RENDIMIENTO ESCOLAR', 0, 1, 'C');
    //$this->Cell(0, $this->height - 1, 'POR ASIGNATURA Y TRIMESTRE', 0, 1, 'C');
   // $this->Cell(0, $this->height - 1, 'EDUCACION BASICA', 0, 1, 'C');
    $this->SetFont('Helvetica','BU', 10);
    $this->Cell(0, $this->height - 1, utf8_decode($object['seccion']['descripcion']), 0, 1, 'C');

    $this->Ln(2);
    $this->SetFont('Arial','', 10);
    $this->Cell(38, $this->height + 1, 'Nombre del Alumno/a: ', 0, 0, 'R');
    $this->Cell(190, $this->height, utf8_decode($object['alumno']->v_apellidos.', '.$object['alumno']->v_nombres), 'B');
    $this->Cell(15, $this->height, 'NIE:', 0, 0, 'R');
    $this->Cell(0, $this->height, $object['alumno']->v_nie, 'B', 1, 'C');

    $this->Cell(38, $this->height + 2, 'Profesor/a Encargado: ', 0, 0, 'R');
    $this->Cell(190, $this->height + 2, utf8_decode($object['profesor']->v_apellidos).", ".utf8_decode($object['profesor']->v_nombres), 'B', 0);

    $this->Cell(22, $this->height + 2, utf8_decode('Año:'), 0, 0, 'C');
    $this->Cell(0, $this->height + 2, $object['seccion']['anio'], 'B', 1, 'C');
      }

public function asistenciaTable($object = array())
{
 $this->Ln(4);
 $this->SetFillColor(210);
 $this->SetFont('Arial','',9);
 $this->Cell(70,$this->height,"Cuadro de Asistencia",1,0,'C',1);
  $this->Cell(30,$this->height,"Asistencia",1,0,'C',1);
 $this->Cell(30,$this->height,$object['asistencia'],1,0,'C',0);
 $this->Cell(45,$this->height,"Inasistencia Injustificada",1,0,'C',1);
 $this->Cell(30,$this->height,$object['inasisinjust'],1,0,'C',0);
 $this->Cell(45,$this->height,"Inasistencia Justificada",1,0,'C',1);
 $this->Cell(27,$this->height,$object['inasjust'],1,0,'C',0);

 $this->Ln(4);
}


  public function tableNotesBoleta($object = array())
	{

    $suma = 0.0;
    $evaluaciones = $object['eva'];   

    $this->Ln(4);
    $this->SetFillColor(210);
    $this->SetFont('Arial','B', 9);
    $this->Cell(70, 18, "ASIGNATURAS", 1, 0, 'C', 1);
    $this->Cell(0, $this->height, strtoupper("NOTAS POR PERIODO"), 1, 1, 'C', 1);
    $this->Cell(70);
    $this->Cell(60, $this->height, "PRIMER PERIODO", 1, 0, 'C', 1);
    $this->Cell(60, $this->height, "SEGUNDO PERIODO", 1, 0, 'C', 1);
    $this->Cell(60, $this->height, "TERCER PERIODO", 1, 1, 'C', 1);
    
    $this->Cell(70);    
    $this->Cell(12, $this->height, "A1", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "A2", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "A3", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "RF", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "PR.", 1, 0, 'C', 1);

    $this->Cell(12, $this->height, "A1", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "A2", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "A3", 1, 0, 'C', 1);
      $this->Cell(12, $this->height, "RF", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "PR.", 1, 0, 'C', 1);

    $this->Cell(12, $this->height, "A1", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "A2", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "A3", 1, 0, 'C', 1);
      $this->Cell(12, $this->height, "RF", 1, 0, 'C', 1);
    $this->Cell(12, $this->height, "PR.", 1, 0, 'C', 1);
    

    $this->SetXY( $this->getX() , $this->getY() - 6);
    $this->Cell(27, 12, "PROMEDIO", 1, 1, 'C', 1);
    $this->SetFont('Arial','', 10);

$array = (array) $object['varnotasS'];//convierto el objeto en un array para recorrerlo

foreach ($array as $peri) 
{
 foreach ($peri as  $materia => $periodo) 
{
  //dd($periodo);
  $suma=0;

  $this->Cell(70, $this->height , utf8_decode($materia) , 1, 0, 'L');
      $this->Cell(12, $this->height , number_format(@$periodo['P1']['ACT1'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P1']['ACT2'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P1']['ACT3'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P1']['RF'], 2), 1, 0, 'C');


(@$periodo['P1'])!=null ? number_format($suma += $this->avg(@$periodo['P1']),2):  $this->Cell(12, $this->height , number_format(0.00, 2) , 1, 0, 'C');     
     
      $this->Cell(12, $this->height , number_format(@$periodo['P2']['ACT1'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P2']['ACT2'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P2']['ACT3'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P2']['RF'], 2), 1, 0, 'C');

(@$periodo['P2'])!=null ?  number_format($suma += $this->avg(@$periodo['P2'],2)):  $this->Cell(12, $this->height , number_format(0.00, 2) , 1, 0, 'C');  
      //$suma += $this->avg(@$periodo['P2']);
      
      $this->Cell(12, $this->height , number_format(@$periodo['P3']['ACT1'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P3']['ACT2'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P3']['ACT3'], 2), 1, 0, 'C');
      $this->Cell(12, $this->height , number_format(@$periodo['P3']['RF'], 2), 1, 0, 'C');

     // $suma += $this->avg(@$periodo['P3']);
     (@$periodo['P3'])!=null ?  number_format($suma += $this->avg(@$periodo['P3'],2)): $this->Cell(12, $this->height , number_format(0.00, 2) , 1, 0, 'C'); 

      $this->Cell(27, $this->height, number_format((@$suma/3), 1), 1, 1, 'C', 1);


}
}

//dd($object['varnotasS']);
    if($object['varnotasS']==null){
      $this->Cell(0, $this->height + 10, 'NO HAY CALIFICACIONES REGISTRADAS' , 1, 1, 'C');
    }

  }

  public function competenciasTable($object = array(),$criterios)
{
  #dd($object);
$a=[];
foreach ($criterios as $key => $value) 
{
    array_push($a, $value->competencia);
}

#dd($object[0]);
$this->Ln(2);
$this->SetFillColor(210);
$this->SetFont('Arial','B',10);
$this->Cell(130,12,"ASPECTOS DE CONDUCTA DEL ESTUDIANTE",1,0,'C',1);
$this->Cell(60,$this->height,"CALIFICACION POR PERIODO",1,1,'C',1);
$this->Cell(130);
$this->Cell(20,$this->height,"P1",1,0,'C',1);
$this->Cell(20,$this->height,"P2",1,0,'C',1);
$this->Cell(20,$this->height,"P3",1,1,'C',1);
$this->SetFont('Arial','',10);
//dd($a);
$this->Cell(130,$this->height,utf8_decode($a[0]),1,0,'L',0);

$this->Cell(20,$this->height, isset($object[0]->criterio_1) ? $object[0]->criterio_1 : '-',1,0,'C',0);
$this->Cell(20,$this->height, isset($object[1]->criterio_1) ? $object[1]->criterio_1 : '-',1,0,'C',0);
$this->Cell(20,$this->height, isset($object[2]->criterio_1) ? $object[2]->criterio_1 : '-',1,1,'C',0);

$this->Cell(130,$this->height,utf8_decode($a[1]),1,0,'L',0);
$this->Cell(20,$this->height, isset($object[0]->criterio_2) ? $object[0]->criterio_2 : '-',1,0,'C',0);
$this->Cell(20,$this->height,isset($object[1]->criterio_2) ? $object[1]->criterio_2 : '-',1,0,'C',0);
$this->Cell(20,$this->height,isset($object[2]->criterio_2) ? $object[2]->criterio_2 : '-',1,1,'C',0);

$this->Cell(130,$this->height,utf8_decode($a[2]),1,0,'L',0);
$this->Cell(20,$this->height,isset($object[0]->criterio_3) ? $object[0]->criterio_3 : '-',1,0,'C',0);
$this->Cell(20,$this->height,isset($object[1]->criterio_3) ? $object[1]->criterio_3 : '-',1,0,'C',0);
$this->Cell(20,$this->height,isset($object[2]->criterio_3) ? $object[2]->criterio_3 : '-',1,1,'C',0);

$this->Cell(130,$this->height,utf8_decode($a[3]),1,0,'L',0);
$this->Cell(20,$this->height,isset($object[0]->criterio_4) ? $object[0]->criterio_4 : '-',1,0,'C',0);
$this->Cell(20,$this->height,isset($object[1]->criterio_4) ? $object[1]->criterio_4 : '-',1,0,'C',0);
$this->Cell(20,$this->height,isset($object[2]->criterio_4) ? $object[2]->criterio_4 : '-',1,1,'C',0);

$this->Cell(130,$this->height,utf8_decode($a[4]),1,0,'L',0);
$this->Cell(20,$this->height,isset($object[0]->criterio_5) ? $object[0]->criterio_5 : '-',1,0,'C',0);
$this->Cell(20,$this->height,isset($object[1]->criterio_5) ? $object[1]->criterio_5 : '-',1,0,'C',0);
$this->Cell(20,$this->height,isset($object[2]->criterio_5) ? $object[2]->criterio_5 : '-',1,1,'C',0);
 $this->Ln(5);
}


 public function avg(array $array)
  {
     $promedio = $this->promedio($array);
    if($promedio <= 4.9) {
      $this->SetTextColor(255, 0, 0);
    }
    $this->SetFont('Arial','B', 9);
    $this->Cell(12, $this->height , number_format($promedio, 2) , 1, 0, 'C');
    self::getSetClearFont();

    return $promedio;
  } 

  public function footerNotesBoletas($object = array())
  {
    $this->Ln(1);
    $this->SetFont('Arial','', 10);
    $this->Cell(95, $this->height, "F._____________________________________", 0, 0, 'C');
     $this->Cell(94);
    $this->Cell(95, $this->height, "F._____________________________________", 0, 1, 'C');
    
    $this->Cell(95, $this->height-2, "  ".utf8_decode($object['centro']->nombre_director_ar), 0, 0, 'C');
     $this->Cell(94);
    $this->Cell(100, $this->height-2, (utf8_decode($object['profesor']->v_nombres)).", ". (utf8_decode($object['profesor']->v_apellidos)), 0, 1, 'C');
    $this->Cell(95, $this->height-2, "  Director del Centro Escolar", 0, 0, 'C');
    $this->Cell(94);
    $this->Cell(100, $this->height-2, "Profesor/a encargado/a", 0, 0, 'C');
  }


  // Funciones privadas
  private function promedio($notas)
  {
    return (
      (isset($notas['ACT1']) ? floatval($notas['ACT1']) : 0) +
      (isset($notas['ACT2']) ? floatval($notas['ACT2']) : 0) +
      (isset($notas['ACT3']) ? floatval($notas['ACT3']) : 0) 
    );
  } 

  private function getSetClearFont()
  {
    $this->SetFont('Arial','', 10);
    $this->SetTextColor(0, 0, 0);
  }

  public function FooterConstancia(){
    $this->SetFont('Arial','B',7);
    $this->Ln(2);
    $this->Cell(0,10,utf8_decode('Este documento tendrá validéz con el sello de la dirección y será entregado al padre de familia'), 0,0,'C');
  }
}
