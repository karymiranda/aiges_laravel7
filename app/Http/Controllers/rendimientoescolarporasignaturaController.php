<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use \Codedge\Fpdf\Fpdf\Fpdf;

class rendimientoescolarporasignaturaController extends Fpdf
{
   var $height = 6;
    var $interlineado = 4;

  // Para la boleta de notas encabezado
  public function headerBoletaNotas($centro)
  {

     $routeImage = __DIR__."..\..\..\..\public\logoce.jpg";
    $routeImageMINED = __DIR__."..\..\..\..\public\EscudoDeElSalvador.jpg";

    $this->Image($routeImage, 10, 4, 15);
    $this->Image($routeImageMINED, 250, 6, 20);
    
    $this->SetFont('Arial','', 11);
    $this->Cell(0, $this->height - 1, utf8_decode('Ministerio de Educación, Ciencia y Tecnologia'), 0, 1, 'C');
    $this->SetFont('Arial','B',12);
    $this->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
    $this->SetFont('Arial','IB', 10);
   // $this->Cell(0, $this->height - 1, utf8_decode('"ABRIENDO PUERTAS AL FUTURO"'), 0, 1, 'C');
    $this->SetFont('Arial','I',10);
   $this->Cell(0, $this->height-2, utf8_decode($centro->v_direccion), 0, 1, 'C');		
   $this->Cell(0, $this->height-2, utf8_decode('Teléfono '.$centro->v_telefono.' E-mail: '.$centro->correo_electronico), 0, 1, 'C');
    $this->Cell(0, $this->height, '', 'B', 1, 'C');
 }

  public function boletaTitulo($object = array())
  {
    $this->Ln(3);
    $this->SetFont('Arial','B', 10);
    $this->Cell(0, $this->height - 1, 'REGISTRO DE EVALUACION DEL RENDIMIENTO ESCOLAR', 0, 1, 'C');
    $this->Cell(0, $this->height - 1, 'EDUCACION BASICA', 0, 1, 'C');
    $this->SetFont('Helvetica','BU', 13);
    $this->Cell(0, $this->height - 1, utf8_decode($object['seccion']['descripcion']), 0, 1, 'C');
  }

  /*public function boletasubtitulo($datos,$seccion)
  {
  	//dd($datos);
  	$this->SetFont('Arial','', 8);
  	$this->Cell(0,$this->height - 1,"ASIGNATURA: ". utf8_decode(mb_strtoupper($datos->asignatura))."    RESPONSABLE ASIGNATURA:  ".utf8_decode(mb_strtoupper($datos->v_nombres))."  ".utf8_decode(mb_strtoupper($datos->v_apellidos))."   ASESOR DE SECCION :  ".utf8_decode(mb_strtoupper($seccion->seccion_empleado->v_nombres))." ".utf8_decode(mb_strtoupper($seccion->seccion_empleado->v_apellidos)), 0, 1, 'C');
  }*/

   public function boletasubtitulo($datos,$seccion)
  {
    $this->Ln(2);
    $this->SetFont('Arial','B', 10);
    $this->Cell(0, $this->height - 1, 'REGISTRO DE EVALUACION DEL RENDIMIENTO ESCOLAR - EDUCACION BASICA', 0, 1, 'C');
   // $this->Cell(0, $this->height - 1, 'POR ASIGNATURA Y TRIMESTRE', 0, 1, 'C');
    //$this->Cell(0, $this->height - 1, 'EDUCACION BASICA', 0, 1, 'C');
    $this->SetFont('Helvetica','BU', 13);
    $this->Cell(0, $this->height - 1, utf8_decode(mb_strtoupper($seccion->descripcion)), 0, 1, 'C');

    $this->SetFont('Arial','', 10);
    $this->Cell(38, $this->height + 1,'Asignatura:                    ', 0, 0, 'R');
    $this->Cell(190, $this->height,utf8_decode($datos->asignatura), 'B');

    $this->Cell(15, $this->height, utf8_decode('Año:'), 0, 0, 'R');
    $this->Cell(0, $this->height,$seccion->anio, 'B', 1, 'C');

    $this->Cell(38, $this->height + 2, 'Profesor/a Encargado:  ', 0, 0, 'R');
    $this->Cell(190, $this->height + 2, utf8_decode($datos->v_nombres)."  ".utf8_decode($datos->v_apellidos), 'B', 0);

//$this->Cell(38, $this->height-1,utf8_decode("A1=Actividad 1 A=Actividad 2 A3=Actividad 3 PR.=Promedio"),0,1, "C",0);
  }

public function headertablarendimientoescolar()
{ 
$this->SetFont('Arial','', 8);

$this->SetXY(10,65);
$this->SetFont('Arial','B',9);
    $this->SetFillColor(229,229,229);
    $this->SetFont('Arial','B','7');
    $this->Cell(5, 15, "No", 1, 0, "C",1); 
    $this->Cell(20, 15, "NIE", 1, 0, "C",1); 
    $this->Cell(60, 15,"NOMBRE ALUMNO/A", 1, 0, "C",1); 
    $this->Cell(45, 5, utf8_decode("1° PERIODO"), 1, 0, "C",1);
    $this->SetXY(95,70);
    $this->Cell(45, 5, utf8_decode("ACTIVIDADES"), 1, 0, "C",1);
    $this->SetXY(95,75); 
    $this->Cell(15, 5,"A1", 1, 0, "C",1);
    $this->Cell(15, 5,"A2", 1, 0, "C",1);
    $this->Cell(15, 5,"A3", 1, 1, "C",1);
    $this->SetXY(140,65);
     $this->SetFont('Arial','B','7');
    $this->Cell(10,15,"PROM", 1, 1, "C",1);
     $this->SetFont('Arial','B','7');
   $this->SetXY(150,65);
   $this->Cell(45, 5,utf8_decode("2° PERIODO"), 1, 0, "C",1);
   $this->SetXY(150,70); 
   $this->Cell(45, 5, utf8_decode("ACTIVIDADES"), 1, 0, "C",1);
   $this->SetXY(150,75); 
   $this->Cell(15, 5,"A1", 1, 0, "C",1);
   $this->Cell(15, 5,"A2", 1, 0, "C",1);
   $this->Cell(15, 5,"A3", 1, 1, "C",1);
   $this->SetXY(195,65);
   $this->SetFont('Arial','B','7');
   $this->Cell(10,15,"PROM", 1, 1, "C",1);
   $this->SetFont('Arial','B','7');
    $this->SetXY(205,65);
   $this->Cell(45, 5,utf8_decode("3° PERIODO"), 1, 1, "C",1);
   $this->SetXY(205,70);     
   $this->Cell(45, 5, utf8_decode("ACTIVIDADES"), 1, 0, "C",1);
   $this->SetXY(205,75); 
   $this->Cell(15, 5,"A1", 1, 0, "C",1);
   $this->Cell(15, 5,"A2", 1, 0, "C",1);
   $this->Cell(15, 5,"A3", 1, 1, "C",1);
   $this->SetXY(225,65);
   $this->SetFont('Arial','B','7');
   $this->SetXY(250,65);
   $this->Cell(10,15,"PROM", 1, 1, "C",1);
   $this->SetXY(260,65);
   $this->Cell(10,15,utf8_decode("PF"), 1, 1, "C",1);

}

  public function tableNotesBoleta($object = array())
	{
$cont=count($object ['notas']);
//dd($object['students']);
foreach ($object['students'] as $key => $estudiantes) {

   $this->SetFont('Arial','', 8);
   $this->Cell(5, $this->interlineado + 1,utf8_decode($key+1), 1, 0, 'L');
   $this->Cell(20, $this->interlineado + 1,utf8_decode($estudiantes->v_nie), 1, 0, 'L');
   $this->Cell(60, $this->interlineado + 1,utf8_decode($estudiantes->v_apellidos).", ".utf8_decode($estudiantes->v_nombres),1, 1, 'L',0);

} //fin estudiante

 
 //$this->SetXY(95,0);
 $this->SetY(80);
 //dd($object ['notas']); 
 foreach ($object ['notas'] as  $y => $value) { 

 $this->SetX(95);
  $acumuladorpuntajeperiodo=0;
  foreach (@$value as $v) {//bajo al array de periodos
foreach (@$v as  $pos) {//bajo al array de evaluaciones por periodo
 /* foreach ($pos as $calificacion) {   
  $this->Cell(15, $this->height + 1, number_format($calificacion, 1), 1, 0, 'C');
  }
      $promedio = self::promedio($pos);
     if($promedio <= 5.9)
      $this->SetTextColor(255, 0, 0);             
    //  $this->Cell(10, $this->height + 1, number_format($promedio, 1) , 1, 0, 'C');
      self::getSetClearFont();
$acumuladorpuntajeperiodo=$acumuladorpuntajeperiodo+$promedio;*/
      }//cierrro foreach para cada ciclo
  //$this->SetXY(205,60);
$this->SetFont('Arial','', 8);
$this->Cell(15, $this->interlineado + 1, (isset($v['P1']['ACT1']) ? number_format($v['P1']['ACT1'],1) : 0), 1, 0, 'C');
$this->Cell(15, $this->interlineado + 1, (isset($v['P1']['ACT2']) ? number_format($v['P1']['ACT2'],1) : 0), 1, 0, 'C');
$this->Cell(15, $this->interlineado + 1, (isset($v['P1']['ACT3']) ? number_format($v['P1']['ACT3'],1) : 0), 1, 0, 'C');
 $promedioP1 = self::promedioP1($v);
     if($promedioP1 <= 5.9)
   $this->SetTextColor(255, 0, 0);             
   $this->Cell(10, $this->interlineado + 1, number_format($promedioP1, 1) , 1, 0, 'C');
   self::getSetClearFont();

$this->SetFont('Arial','', 8);
$this->Cell(15, $this->interlineado + 1, (isset($v['P2']['ACT1']) ? number_format($v['P2']['ACT1'],1) : 0), 1, 0, 'C');
$this->Cell(15, $this->interlineado + 1, (isset($v['P2']['ACT2']) ? number_format($v['P2']['ACT2'],1) : 0), 1, 0, 'C');
$this->Cell(15, $this->interlineado + 1, (isset($v['P2']['ACT3']) ? number_format($v['P2']['ACT3'],1) : 0), 1, 0, 'C');

 $promedioP2 = self::promedioP2($v);
     if($promedioP2 <= 5.9)
   $this->SetTextColor(255, 0, 0);             
   $this->Cell(10, $this->interlineado + 1, number_format($promedioP2, 1) , 1, 0, 'C');
   self::getSetClearFont();
 $this->SetFont('Arial','', 8);  

$this->Cell(15, $this->interlineado+ 1, (isset($v['P3']['ACT1']) ? number_format($v['P3']['ACT1'],1) : 0), 1, 0, 'C');
$this->Cell(15, $this->interlineado + 1, (isset($v['P3']['ACT2']) ? number_format($v['P3']['ACT2'],1) : 0), 1, 0, 'C');
$this->Cell(15, $this->interlineado + 1, (isset($v['P3']['ACT3']) ? number_format($v['P3']['ACT3'],1) : 0), 1, 0, 'C');

 $promedioP3 = self::promedioP3($v);
     if($promedioP3 <= 5.9)
   $this->SetTextColor(255, 0, 0);             
   $this->Cell(10, $this->interlineado + 1, number_format($promedioP3, 1) , 1, 0, 'C');
   self::getSetClearFont(); 
$this->SetFont('Arial','B', 8);
$promedioFinal = self::promedioFinal($v);
$promedioFinal=$promedioFinal/3;
if($promedioFinal <= 5.9)
      $this->SetTextColor(255, 0, 0);             
     $this->Cell(10, $this->interlineado + 1, number_format($promedioFinal, 1) , 1, 1, 'C');
      self::getSetClearFont();
     }//cierro foreach notas
 }//fin foreach notas 


 
    if(count($object['notas']) == 0){
      $this->Cell(190, $this->height + 10, 'NO HAY NOTAS EN ESTE PERIODO PARA ESTE ALUMNO' , 1, 1, 'C');
    }
  }


 private function promedioP1($notas)
  {
    return (
      (isset($notas['P1']['ACT1']) ? floatval($notas['P1']['ACT1']) : 0) +
      (isset($notas['P1']['ACT2']) ? floatval($notas['P1']['ACT2']) : 0) +
      (isset($notas['P1']['ACT3']) ? floatval($notas['P1']['ACT3']) : 0) 
    );
  } 
   private function promedioP2($notas)
  {
    return (
      (isset($notas['P2']['ACT1']) ? floatval($notas['P2']['ACT1']) : 0) +
      (isset($notas['P2']['ACT2']) ? floatval($notas['P2']['ACT2']) : 0) +
      (isset($notas['P2']['ACT3']) ? floatval($notas['P2']['ACT3']) : 0) 
    );
  } 

   private function promedioP3($notas)
  {
    return (
      (isset($notas['P3']['ACT1']) ? floatval($notas['P3']['ACT1']) : 0) +
      (isset($notas['P3']['ACT2']) ? floatval($notas['P3']['ACT2']) : 0) +
      (isset($notas['P3']['ACT3']) ? floatval($notas['P3']['ACT3']) : 0) 
    );
  } 

   private function promedioFinal($notas)
  {
    return (
      (isset($notas['P1']['ACT1']) ? floatval($notas['P1']['ACT1']) : 0) +
      (isset($notas['P1']['ACT2']) ? floatval($notas['P1']['ACT2']) : 0) +
      (isset($notas['P1']['ACT3']) ? floatval($notas['P1']['ACT3']) : 0)+
      (isset($notas['P2']['ACT1']) ? floatval($notas['P2']['ACT1']) : 0) +
      (isset($notas['P2']['ACT2']) ? floatval($notas['P2']['ACT2']) : 0) +
      (isset($notas['P2']['ACT3']) ? floatval($notas['P2']['ACT3']) : 0) +
      (isset($notas['P3']['ACT1']) ? floatval($notas['P3']['ACT1']) : 0) +
      (isset($notas['P3']['ACT2']) ? floatval($notas['P3']['ACT2']) : 0) +
      (isset($notas['P3']['ACT3']) ? floatval($notas['P3']['ACT3']) : 0)  
    );
  } 

 

  public function footerNotesBoletas($object = array())
  {
    $this->Ln(15);
    $this->SetFont('Arial','', 8);
    $this->Cell(95, $this->height, "F._____________________________________", 0, 0, 'C');
    $this->Cell(94); 
     $this->Cell(65, $this->height, "F._____________________________________", 0, 1, 'C');
      
    $this->Cell(94, $this->height, "  ".utf8_decode($object['centro']->nombre_director_ar), 0, 0, 'C'); 
    $this->Cell(94);
    $this->Cell(65, $this->height, (utf8_decode($object['profesor']->v_nombres)).", ". (utf8_decode($object['profesor']->v_apellidos)), 0, 1, 'C');
    

    $this->Cell(94, $this->height, "Director del Centro Escolar", 0, 0, 'C');
    $this->Cell(94);
    $this->Cell(65, $this->height, "Profesor/a encargado/a", 0, 0, 'C');
    $this->Ln(2);
  }


  // Funciones privadas
 

  private function getSetClearFont()
  {
    $this->SetFont('Arial','', 10);
    $this->SetTextColor(0, 0, 0);
  }

  public function FooterConstancia(){
    $this->SetFont('Arial','B',7);
    $this->Ln(5);
    $this->Cell(0,10,utf8_decode('Este documento tendrá validéz con el sello de la dirección y será entregado al padre de familia'), 0,0,'C');
  }
}
