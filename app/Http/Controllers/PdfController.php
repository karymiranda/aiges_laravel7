<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Codedge\Fpdf\Fpdf\Fpdf;

class PdfController extends Fpdf
{
  var $height = 6; 

  // Para la boleta de notas encabezado
  public function headerBoletaNotas($centro)
  {
   // $routeImage = __DIR__."..\..\..\..\public\\".$centro['logo'];
    $routeImage = __DIR__."..\..\..\..\public\logoce.jpg";
    $routeImageMINED = __DIR__."..\..\..\..\public\EscudoDeElSalvador.jpg";

    //$this->Image($routeImage, 10, 4, 25);
    //$this->Image($routeImageMINED, 255, 6, 30);

    $this->Image($routeImage, 10, 4, 15);
    $this->Image($routeImageMINED, 255, 6, 20);
    
    $this->SetFont('Arial','', 11);
    $this->Cell(0, $this->height - 1, utf8_decode('Ministerio de Educación, Ciencia y Tecnologia'), 0, 1, 'C');
    $this->SetFont('Arial','B',12);
    $this->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
    /*$this->SetFont('Arial','IB', 10);
    $this->Cell(0, $this->height - 1, utf8_decode('"VEN CON NOSOTROS A CAMINAR"'), 0, 1, 'C');
    $this->SetFont('Arial','I',10);
    $this->Cell(0, $this->height-2, utf8_decode($centro->v_direccion), 0, 1, 'C');		
    $this->Cell(0, $this->height-2, utf8_decode('Teléfono '.$centro->v_telefono.' E-mail: '.$centro->correo_electronico), 0, 1, 'C');
    $this->Cell(0, $this->height, '', 'B', 1, 'C');*/
  }

  public function boletaTitulo($object = array())
  {
    $this->Ln(2);
    $this->SetFont('Arial','B', 10);
    $this->Cell(0, $this->height - 1, 'BOLETA DE CALIFICACIONES', 0, 1, 'C');
    //$this->Cell(0, $this->height - 1, 'EDUCACION BASICA', 0, 1, 'C');
    $this->SetFont('Arial','BU', 10);
    $this->Cell(0, $this->height - 1, utf8_decode($object['seccion']['descripcion']), 0, 1, 'C');

    $this->SetFont('Arial','', 10);
    $this->Cell(38, $this->height + 1, 'Nombre del Alumno/a: ', 0, 0, 'R');
    $this->Cell(190, $this->height, utf8_decode($object['alumno']->v_apellidos.', '.$object['alumno']->v_nombres), 'B');
    $this->Cell(15, $this->height, 'NIE:', 0, 0, 'R');
    $this->Cell(0, $this->height, $object['alumno']->v_nie, 'B', 1, 'C');

    $this->Cell(38, $this->height , 'Profesor/a Encargado: ', 0, 0, 'R');
    $this->Cell(190, $this->height , utf8_decode($object['profesor']->v_apellidos).", ".utf8_decode($object['profesor']->v_nombres), 'B', 0);

    $this->Cell(22, $this->height , utf8_decode('Año:'), 0, 0, 'C');
    //$this->Cell(0, $this->height , date('Y'), 'B', 1, 'C');
     $this->Cell(0, $this->height , $object['seccion']['anio'], 'B', 1, 'C');
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

foreach ($array as $materia => $periodo) 
{$suma=0;

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

    if(count($object['varnotasS']) == 0){
      $this->Cell(190, $this->height + 10, 'NO HAY NOTAS EN ESTE PERIODO PARA ESTE ALUMNO' , 1, 1, 'C');
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
$this->SetFont('Arial','B',9);
$this->Cell(130,12,"ASPECTOS DE CONDUCTA DEL ESTUDIANTE",1,0,'C',1);
$this->Cell(60,$this->height,"CALIFICACION POR PERIODO",1,1,'C',1);
$this->Cell(130);
$this->Cell(20,$this->height,"P1",1,0,'C',1);
$this->Cell(20,$this->height,"P2",1,0,'C',1);
$this->Cell(20,$this->height,"P3",1,1,'C',1);
$this->SetFont('Arial','',9);
//dd($a);
$this->Cell(130,$this->height-2,utf8_decode($a[0]),1,0,'L',0);

$this->Cell(20,$this->height-2, isset($object[0]->criterio_1) ? $object[0]->criterio_1 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2, isset($object[1]->criterio_1) ? $object[1]->criterio_1 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2, isset($object[2]->criterio_1) ? $object[2]->criterio_1 : '-',1,1,'C',0);

$this->Cell(130,$this->height-2,utf8_decode($a[1]),1,0,'L',0);
$this->Cell(20,$this->height-2, isset($object[0]->criterio_2) ? $object[0]->criterio_2 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2,isset($object[1]->criterio_2) ? $object[1]->criterio_2 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2,isset($object[2]->criterio_2) ? $object[2]->criterio_2 : '-',1,1,'C',0);

$this->Cell(130,$this->height-2,utf8_decode($a[2]),1,0,'L',0);
$this->Cell(20,$this->height-2,isset($object[0]->criterio_3) ? $object[0]->criterio_3 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2,isset($object[1]->criterio_3) ? $object[1]->criterio_3 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2,isset($object[2]->criterio_3) ? $object[2]->criterio_3 : '-',1,1,'C',0);

$this->Cell(130,$this->height-2,utf8_decode($a[3]),1,0,'L',0);
$this->Cell(20,$this->height-2,isset($object[0]->criterio_4) ? $object[0]->criterio_4 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2,isset($object[1]->criterio_4) ? $object[1]->criterio_4 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2,isset($object[2]->criterio_4) ? $object[2]->criterio_4 : '-',1,1,'C',0);

$this->Cell(130,$this->height-2,utf8_decode($a[4]),1,0,'L',0);
$this->Cell(20,$this->height-2,isset($object[0]->criterio_5) ? $object[0]->criterio_5 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2,isset($object[1]->criterio_5) ? $object[1]->criterio_5 : '-',1,0,'C',0);
$this->Cell(20,$this->height-2,isset($object[2]->criterio_5) ? $object[2]->criterio_5 : '-',1,1,'C',0);
 $this->Ln(8);
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
    #$this->Ln(5);
    $this->SetFont('Arial','', 10);
    $this->Cell(95, $this->height, "F._____________________________________", 0, 0, 'C');
    $this->Cell(94);
    $this->Cell(95, $this->height, "F._____________________________________", 0, 1, 'C');
    
    $this->Cell(95, $this->height, "  ".utf8_decode($object['centro']->nombre_director_ar), 0, 0, 'C');
    $this->Cell(94);
    $this->Cell(100, $this->height, (utf8_decode($object['profesor']->v_nombres)).", ". (utf8_decode($object['profesor']->v_apellidos)), 0, 1, 'C');
    
    $this->Cell(95, $this->height, "  Director del Centro Escolar", 0, 0, 'C');
    $this->Cell(94);
    $this->Cell(100, $this->height, "Profesor/a encargado/a", 0, 0, 'C');
  }


  // Funciones privadas
  private function promedio($notas)
  {
    return (
      (isset($notas['ACT1']) ? floatval($notas['ACT1']) : 0) +
      (isset($notas['ACT2']) ? floatval($notas['ACT2']) : 0) +
      (isset($notas['ACT3']) ? floatval($notas['ACT3']) : 0) +
      (isset($notas['RF']) ? floatval($notas['RF']) : 0) 
    );
  } 

  private function getSetClearFont()
  {
    $this->SetFont('Arial','', 10);
    $this->SetTextColor(0, 0, 0);
  }

  public function FooterConstancia(){
    $this->SetFont('Arial','B',7);
    $this->Ln(1);
    $this->Cell(0,10,utf8_decode('Este documento tendrá validéz con el sello de la dirección y será entregado al padre de familia'), 0,0,'C');
  }

  // Funciones para el cuadro final
  public function cuadroFinal(array $args)
  {
    $this->AddPage();
    $this->SetAutoPageBreak(true, 0);
    $this->getHeaderCuadroFinal($args['seccion']);
    $this->getCuadroHeaderFinal();

    $this->CuadroDeDatos($args['items'], array( "init" => 1, "max" => 23 ), $args['conductas']);
    $this->CuadroEstadistica($args['estadistica']);

    // segunda pagina
    $this->AddPage();
    $this->getCuadroHeaderFinal(array(), false, 1);
    if(count($args['items']) > 22)
		  $this->CuadroDeDatos($args['items'], array("init" => 24, "max" => 50), $args['conductas']);
	  else
		  $this->CuadroDeDatos(array(), array("init" => 24, "max" => 50), array());
    
    $this->promedioGlobalModificado($args['promedios'][0]);
    $this->getDatosSchoolModificado($args['seccion']);
  }

  public function getDatosSchoolModificado($array = array(), $institucion = array())
  {
    $this->SetTextColor(0);
    $this->SetFont('Arial','', 10);

    $this->SetXY(26.0, 1);
    $this->Cell(1.2, 0.45, 'Lugar: ', 0, 0, 'L');
    $this->Cell(7, 0.45, utf8_decode('4ta av. Norte Barrio Los Angeles '), 'B', 0, 'L');
    $this->SetXY(26.0, 1.6);
    $this->Cell(8.2, 0.45, utf8_decode(''), 'B');

    $this->SetXY(26.0, 3.2);
    $this->Cell(1.2, 0.45, 'Fecha: ', 0, 0, 'L');
    $this->Cell(7, 0.45, utf8_decode(''), 'B', 0, 'L');
    $this->SetXY(26.0, 3.8);
    $this->Cell(1.9, 0.45, '', 'B', 0, 'L');
    $this->Cell(6.3, 0.45, utf8_decode(''), 'B');

    $this->SetXY(26.0, 5);
    $this->Cell(0.5, 0.45, 'F: ', 0, 0, 'L');
    $this->Cell(7.7, 0.45, '', 'B', 0, 'L');

    $this->SetXY(26.0, 5.65);
    $this->Cell(4.2, 0.45, 'Nombre del (la) docente:', 0, 0, 'L');
    $this->Cell(4, 0.45, utf8_decode(@$array->seccion_empleado->v_nombres), 'B');

    $this->SetXY(26.0, 6.15);
    $this->Cell(2.6, 0.45, '', 'B', 0, 'L');
    $this->Cell(5.6, 0.45, utf8_decode(@$array->seccion_empleado->v_apellidos), 'B', 0, 'L');


    $this->SetXY(26.0, 7.8);
    $this->Cell(0.5, 0.45, 'F: ', 0, 0, 'L');
    $this->Cell(7.7, 0.45, '', 'B', 0, 'L');

    $this->SetXY(26.0, 8.5);
    $this->Cell(3.8, 0.45, 'Director(a) del centro:', 0, 0, 'L');
    $this->Cell(4.4, 0.45,utf8_decode('Jorge Alberto'), 'B');

    $this->SetXY(26.0, 9);
    $this->Cell(3.8, 0.45, '', 'B', 0, 'L');
    $this->Cell(4.4, 0.45, utf8_decode('Melara'), 'B', 0, 'L');

    $this->SetLineWidth(0.07);
    $this->SetXY(26.5, 15.4);	
    $this->Cell(8, 4.5, '', 1);
    $this->SetLineWidth(0.02);
    $this->SetXY(28.2, 19.4);
    $this->Cell(4.5, 0.5, 'SELLO', 0, 0, 'C');
  }
    
  public function promedioGlobalModificado($promedios = array(), $array = array())
  {
    $TercerNivel = intval(@$array['NIVEL']) > 6 ? true : false;
    $this->SetFont('Arial','', 11);
    $this->Cell(0.85, 0.55, '', 1, 0, 'C');
    $this->Cell(12.15, 0.55, 'Total de puntos', 1, 0, 'C');
    $this->SetFont('Arial','B', 9.5);

    $this->Cell(0.95, 0.55, number_format($promedios->lenguaje, 0), 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format($promedios->matematica, 0), 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format($promedios->ciencia, 0), 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format($promedios->sociales, 0), 1, 0, 'C');
    if($TercerNivel)
      $this->Cell(0.95, 0.55, number_format($promedios->ingles, 0), 1, 0, 'C');
    else
      $this->Cell(0.95, 0.55, number_format($promedios->artistica, 0), 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format($promedios->fisica, 0), 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format($promedios->urbanida, 0), 1, 0, 'C');

    $this->Cell(1, 0.55, '', 1, 0, 'C');
    $this->Cell(1, 0.55, '', 1, 0, 'C');
    $this->Cell(1, 0.55, '', 1, 0, 'C');
    $this->Cell(1, 0.55, '', 1, 0, 'C');
    $this->Cell(1, 0.55, '', 1, 1, 'C');

    $this->Cell(0.85, 0.55, '', 1, 0, 'C');
    $this->SetFont('Arial','B', 11);
    $this->Cell(12.15, 0.55, 'Promedio', 1, 0, 'C');
    $this->SetFont('Arial','B', 9.5);

    $this->SetTextColor(255, 0, 0);
    $this->Cell(0.95, 0.55, number_format(($promedios->lenguajePromedio), 0) , 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format(($promedios->matematicaPromedio), 0) , 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format(($promedios->cienciaPromedio), 0) , 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format(($promedios->socialesPromedio), 0) , 1, 0, 'C');
    if($TercerNivel)
      $this->Cell(0.95, 0.55, number_format(($promedios->inglesPromedio), 0) , 1, 0, 'C');
    else
      $this->Cell(0.95, 0.55, number_format(($promedios->artisticaPromedio), 0) , 1, 0, 'C');

    $this->Cell(0.95, 0.55, number_format(($promedios->fisicaPromedio), 0) , 1, 0, 'C');
    $this->Cell(0.95, 0.55, number_format(($promedios->urbanidaPromedio), 0) , 1, 0, 'C');

    $this->Cell(1, 0.55, '', 1, 0, 'C');			
    $this->Cell(1, 0.55, '', 1, 0, 'C');
    $this->Cell(1, 0.55, '', 1, 0, 'C');
    $this->Cell(1, 0.55, '', 1, 0, 'C');
    $this->Cell(1, 0.55, '', 1, 0, 'C');
  }

  public function getHeaderCuadroFinal($array = array(), $institucion = array())
  {
    $height = 0.6;
    $this->Cell(7.0);

    if(@$array->nivel > 6 ) {
      $routeImage = __DIR__."..\..\..\..\public\logo-modificado.jpg";
      $this->Image($routeImage, 0.8, 0.3, 4.6);
    }else{
      $routeImage = __DIR__."..\..\..\..\public\logo1-modificado.jpg";
      $this->Image($routeImage, 0.8, 0.3, 4.4);
    }
    
    $this->SetFont('Arial','B',13);
    $this->Cell(0, $height, 
      utf8_decode("REGISTRO DE EVALUACIÓN DEL RENDIMIENTO ESCOLAR DE ".  $array->seccion_grado->nivel. " ° GRADO DE EDUCACIÓN BÁSICA"), 0, 1
    );
    
    $this->SetFont('Arial','', 10);
    $this->Ln(0.2);
    $this->Cell(5.0);
    $this->Cell(11, $height, 
      utf8_decode("CUADRO FINAL DE EVALUACIÓN DE {$array->seccion_grado->nivel}° GRADO, SECCIÓN"), 0, 0
    );
    $this->Cell(1.8, $height,  "'{$array->seccion}'", 'B', 0, 'C' );

    //$this->Cell(5);
    $this->Cell(7.5, $height,utf8_decode(' CÓDIGO DE INFRAESTRUCTURA: '), 0, 0, 'L' );
    $this->Cell(7.7, $height, "11810" ,'B', 1, 'C');
    
    $this->Cell(5.0);
    $this->Cell(8.5, $height,  'NOMBRE DEL CENTRO EDUCATIVO', 0, 0 );			
    $this->Cell(19.5, $height, utf8_decode('Centro Escolar Catolico "Santa María del Camino"') ,'B', 1, 'C');

    
    $this->Cell(5.0);
    $this->Cell(2.5,  $height,utf8_decode('DIRECCIÓN: '), 0, 0, 'L' );
    $this->Cell(16, $height, utf8_decode('4ta av. Norte Barrio Los Angeles'), 'B', 0, 'C');
    $this->Cell(4,  $height, 'MUNICIPIO: ', 0, 0, 'C' );
    $this->Cell(5.5, $height, utf8_decode('Apastepeque'), 'B', 1, 'C');

    $this->Cell(5.0);
    $this->Cell(3.7,  $height + 0.4, 'DEPARTAMENTO: ', 0, 0, 'L' );
    $this->Cell(7.4, $height , utf8_decode('San Vicente'), 'B', 0, 'C');
    $this->Cell(6,  $height + 0.4, utf8_decode('N° DE ACUERDO DE CREACIÓN: '), 0, 0, 'L' );
    $this->Cell(3.6, $height, utf8_decode('123'), 'B', 0, 'C');

    $this->Cell(2.0, $height, ' DE FECHA: ', 0, 0, 'C');
    $this->Cell(5.4, $height, utf8_decode('11-02-2019') , 'B', 1, 'C');
  }
  
  public function getCuadroHeaderFinal($array = array(), $salto = true, $aumento = 4.8)
  {
    $height = 4;
    $TercerNivel = intval(@$array['NIVEL']) > 6 ? true : false;
    
    if($salto)
      $this->Ln(0.6);
    $this->SetFont('Arial','B', 9);
    $this->Cell(0.85, $height + 0.4, '', 1, 0, 'C');
    $routeImage = __DIR__."..\..\..\..\public\\numero-orden.png";
    $this->Image($routeImage, 1.2, $aumento + 1.30);

    if ($TercerNivel) {
      $this->Cell(12.14, $height + 0.4, utf8_decode ('NOMBRE DE LOS ESTUDIANTES'), 1, 0, 'C');
      $this->SetFont('Arial','', 9);
      $this->SetXY(1.85, $aumento + 2.4);
      $this->Cell(12.14, 0.4, utf8_decode ('EN ORDEN ALFABÉTICO DE APELLIDOS'), 0, 0, 'C');
    } else {
      $this->Cell(18.3, $height + 0.4, utf8_decode ('                Nombre de los estudiantes en orden alfabético de apellidos'), 'T', 1, 'L');
    }

    $this->SetFont('Arial','B', 7.5);
    $this->SetXY(14, $aumento);
    $this->Cell(6.65, 1, 'ASIGNATURA', 1, 0, 'C');
    
    $this->SetXY(14, $aumento + 1.0);
    $this->Cell(0.95, 2.6, '', 1, 0, 'C');

    $routeImage = __DIR__."..\..\..\..\public\materias";
    if($TercerNivel)
      $this->Image("{$routeImage}\lenguaje-tercer.png", 14.30, $aumento + 1.1, 0.37);
    else
      $this->Image("{$routeImage}\lenguaje.png", 14.25, $aumento - 1.30, 0.45);

    $this->Cell(0.95, 2.6, '', 1, 0, 'C');
    $this->Image("{$routeImage}\matematica.png", 15.2, $aumento + 0.55, 0.45);

    $this->Cell(0.95, 2.6, '', 1, 0, 'C');
    $this->Image("{$routeImage}\ciencia-salud-medio-ambiente.png", 16, $aumento + 0.45, 0.8);

    $this->Cell(0.95, 2.6, '', 1, 0, 'C');
    if($TercerNivel)
      $this->Image("{$routeImage}\\estudio-sociales-tercer.png", 16.95, $aumento + 1.1, 0.7);
    else
      $this->Image("{$routeImage}\\estudio-sociales.png", 17.1, $aumento + 1.30, 0.39);
    
    $this->Cell(0.95, 2.6, '', 1, 0, 'C');
    if($TercerNivel)
      $this->Image("{$routeImage}\ingles.png", 17.9, $aumento, 0.9);
    else
      $this->Image("{$routeImage}\\educacion-artistica.png", 18.1, $aumento - 0.75, 0.4);
    
    $this->Cell(0.95, 2.6, '', 1, 0, 'C');
    $this->Image("{$routeImage}\\educacion-fisica.png", 18.9, $aumento + 0.45, 0.8);

    $this->Cell(0.95, 2.6, '', 1, 0, 'C');
    $this->Image("{$routeImage}\moral-urbanidad-civica.png", 19.8, $aumento + 1.35, 0.75);

    $this->SetFont('Arial','', 10);
    $this->SetXY(14, $aumento + 3.60);
    $this->Cell(6.65, 0.8, utf8_decode('CALIFICACIÓN'), 1, 0, 'C');

    $this->SetXY(20.65, $aumento);
    $this->SetFont('Arial','B', 7.5);
    $this->MultiCell(5, 1, 'COMPETENCIAS CIUDADANAS', 1, 'C', 0);
    
    $this->SetXY(20.8, $aumento + 0.5);
    $this->SetFont('Arial','', 7);
    //$this->Cell(4.5, 0.5, 'Aspectos de la conducta', 0, 0, 'C');

    $routeImage = __DIR__."..\..\..\..\public\conductas";
    $this->SetXY(20.65, $aumento + 1.0);
    $this->Cell(1, 3.4, '', 1, 0, 'C');
    $this->Image("{$routeImage}\\conducta-1.png", 20.9, $aumento + 1, 0.53);

    $this->Cell(1, 3.4, '', 1, 0, 'C');
    $this->Image("{$routeImage}\\conducta-2.png", 21.9, $aumento + 0.55, 0.6);

    $this->Cell(1, 3.4, '', 1, 0, 'C');
    $this->Image("{$routeImage}\\conducta-3.png", 22.9, $aumento + 0.96, 0.54);
    
    $this->Cell(1, 3.4, '', 1, 0, 'C');
    $this->Image("{$routeImage}\\conducta-4.png", 23.9, $aumento + 1, 0.53);
    $this->Cell(1, 3.4, '', 1, 1, 'C');
    $this->Image("{$routeImage}\\conducta-5.png", 24.85, $aumento + 1, 0.53);
  }

  private function row($item, $num, $TercerNivel = false, $conducta = array(), $show = true) {
    $heightFile = 0.516;
    $promedios = array();
    
 
    if($show) $alumno = $item->alumno;
    
    $this->SetFillColor( ($num % 2 == 0 ) ? 120 : 190 );
    $this->Cell(0.85, $heightFile,  ($num), 1, 0, 'C', 1);
    $this->Cell(3.2, $heightFile, ($show) ? "{$alumno->v_nie}" : '', 'BTR', 0, 'R', 0);
    $this->Cell(8.95, $heightFile, ($show) ? utf8_decode("{$alumno->getFullName()}") : '', 'BT', 0, 'L', 0);

    $this->Cell(0.95, $heightFile, isset($item->lenguaje) ? number_format($item->lenguaje, 0) : "", 1, 0, 'C', 0);
    $this->Cell(0.95, $heightFile, isset($item->matematica) ? number_format($item->matematica, 0) : "", 1, 0, 'C', 0);
    $this->Cell(0.95, $heightFile, isset($item->ciencia) ? number_format($item->ciencia, 0) : "", 1, 0, 'C', 0);
    $this->Cell(0.95, $heightFile, isset($item->sociales) ? number_format($item->sociales, 0) : "", 1, 0, 'C', 0);

    if($TercerNivel)
      $this->Cell(0.95, $heightFile,isset($item->ingles) ? number_format($item->ingles, 0) : "", 1, 0, 'C', 0);
    else
      $this->Cell(0.95, $heightFile,isset($item->artistica) ? number_format($item->artistica, 0): "", 1, 0, 'C', 0);
    $this->Cell(0.95, $heightFile,isset($item->fisica) ? number_format($item->fisica, 0) : "", 1, 0, 'C', 0);
    $this->Cell(0.95, $heightFile,isset($item->urbanida) ? number_format($item->urbanida, 0) : "", 1, 0, 'C', 0);

    if(@count($conducta) > 0){
      $this->Cell(1, $heightFile, $conducta->criterio_1, 1, 0, 'C', 0);
      $this->Cell(1, $heightFile, $conducta->criterio_2, 1, 0, 'C', 0);
      $this->Cell(1, $heightFile, $conducta->criterio_3, 1, 0, 'C', 0);
      $this->Cell(1, $heightFile, $conducta->criterio_4, 1, 0, 'C', 0);
      $this->Cell(1, $heightFile, $conducta->criterio_5, 1, 1, 'C', 0);
    }else{
      $this->Cell(1, $heightFile, '', 1, 0, 'C', 0);
      $this->Cell(1, $heightFile, '', 1, 0, 'C', 0);
      $this->Cell(1, $heightFile, '', 1, 0, 'C', 0);
      $this->Cell(1, $heightFile, '', 1, 0, 'C', 0);
      $this->Cell(1, $heightFile, '', 1, 1, 'C', 0);
    }
  }

  public function getLineEndCuadroFinal ( $getX, $getY , $max) {
    $getYEnd = ($max == 50) ? 18.8 : 20.8;
    $this->SetLineWidth(0.04);
    $this->Line($getX, $getY, 25.60, $getYEnd);
    $this->SetLineWidth(0.02);
  }

  public function getConductaEstudiante($alumno, $conductas) {
    $conducta = null;
    foreach ($conductas as $value) {
      if( strcmp($value->alumno_id, $alumno->alumno_id) == 0 ) {
        $conducta = $value;
        break;
      }
    }
    return $conducta;
  }

  private function CuadroDeDatos( $array = array(), $limit = array(), $conducta = array()) {
    $i = $limit['init'];
    $resultados = array();
    $this->SetFillColor(220);
    $this->SetFont('Arial','', 10);
    $TercerNivel = false;

    for ($count = count($array); $i <= $limit['max'] && $i < ($count + 1); $i++) {
      self::row($array[$i-1], $i, $TercerNivel, self::getConductaEstudiante($array[$i - 1], $conducta));
    }

    if($i <= $limit['max']){
      $getX = $this->GetX();
      $getY = $this->GetY();
        
      for($j = $i; $j <= $limit['max']; $j++) {
        self::row(array(
          "v_nie" => '', "v_apellidos" => null, "v_nombres" => null
        ), $j, false, array(), false);
      }
      self::getLineEndCuadroFinal($getX, $getY, $limit['max']);
    }
  }

  public function CuadroEstadistica($r = array())
  {
    $this->SetFillColor(210);
    $this->SetXY(26.0, 4.8);
    $this->SetLineWidth(0.03);
    $this->SetFont('Arial','B', 9);
    $this->MultiCell(8.10, 1.0, '', 'TLR', 'C', 1 );

    $this->SetXY(26, 4.9);
    $this->Cell(8.1, 0.55, utf8_decode('ESCALA DE VALORACIÓN PARA LAS'), 0, 1, 'C');
    $this->SetXY(26, 5.2);
    $this->Cell(8.1, 0.55, utf8_decode('COMPETENCIAS CIUDADANAS'), 0, 1, 'C');
    
    $this->SetFont('Arial','', 9);

    $this->SetXY(26.0, 5.8);
    $this->Cell(2.70, 0.75, "     Excelente", 1, 0 ,'L', 0 );
    $this->Cell(2.70, 0.75, "     Muy Bueno", 1, 0 ,'C', 0 );
    $this->Cell(2.70, 0.75, "     Bueno", 1, 1 ,'C', 0 );
    
    $this->SetFont('Arial','B', 9);
    $this->SetXY(26.0, 5.8);
    $this->Cell(10, 0.75, "E:", 0, 0 ,'L', 0 );
    $this->SetXY(28.7, 5.8);
    $this->Cell(10, 0.75, "MB:", 0, 0 ,'L', 0 );
    $this->SetXY(31.7, 5.8);
    $this->Cell(10, 0.75, "B:", 0, 0 ,'L', 0 );

    $this->SetFont('Arial','', 8);
    $this->SetXY(26.0, 6.56);
    $this->MultiCell(2.7, 0.45, "Dominio alto de la competencia", 1, 'L');
    $this->SetXY(28.7, 6.56);
    $this->MultiCell(2.7, 0.45, "Dominio medio de la competencia", 1, 'L');
    $this->SetXY(31.4, 6.56);
    $this->MultiCell(2.7, 0.45, "Dominio bajo de la competencia", 1, 'L');

    $this->SetXY(26.0, 7.8);
    $this->SetFont('Arial','B', 11);
    $this->Cell(8.1, 0.6, utf8_decode("Estadística"), 1, 0 ,'C', 1 );
    
    $this->SetFont('Arial','', 6);
    $this->SetXY(26.0, 8.4);
    $this->Cell(1.35, 0.8, utf8_decode("Sexo"), 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.8, utf8_decode("Matricula"), 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.8, utf8_decode("Retirados"), 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.8, utf8_decode("Matricula"), 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.8, utf8_decode("Promovidos"), 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.8, utf8_decode("Retenidos"), 1, 0 ,'C', 0 );
    
    $this->SetXY(27.4, 8.9);
    $this->Cell(1.35, 0.3, utf8_decode("Inicial"), 0, 0 ,'C', 0 );
    $this->SetXY(30.0, 8.9);
    $this->Cell(1.35, 0.3, utf8_decode("Final"), 0, 0 ,'C', 0 );

    $this->SetXY(26.0, 9.2);
    $this->Cell(1.35, 0.5, utf8_decode("Masculino"), 1, 0 ,'L', 0 );
    
    $this->SetFont('Arial','', 10);
    $this->Cell(1.35, 0.5, @$r->m_ini_m , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, @$r->retirados_m , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, @$r->m_fin_m , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, @$r->promovidos_m , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, @$r->retenidos_m , 1, 1,'C', 0 );

    $this->SetXY(26.0, 9.7);
    $this->SetFont('Arial','', 7);
    $this->Cell(1.35, 0.5, utf8_decode("Femenino"), 1, 0 ,'L', 0 );

    $this->SetFont('Arial','', 10);
    $this->Cell(1.35, 0.5, @$r->m_ini_f , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, @$r->retirados_f , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, @$r->m_fin_f , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, @$r->promovidos_f , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, @$r->retenidos_f , 1, 1,'C', 0 );

    $this->SetXY(26.0, 10.2);
    $this->SetFont('Arial','B', 8);
    $this->Cell(1.35, 0.5, utf8_decode("TOTAL"), 1, 0 ,'L', 0 );
    
    $this->SetFont('Arial','', 10);
    $this->Cell(1.35, 0.5, (@$r->m_ini_m + @$r->m_ini_f ) , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, (@$r->retirados_m + @$r->retirados_f ) , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, (@$r->m_fin_m + @$r->m_fin_f ) , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, (@$r->promovidos_m + @$r->promovidos_f ) , 1, 0 ,'C', 0 );
    $this->Cell(1.35, 0.5, (@$r->retenidos_m + @$r->retenidos_f ) , 1, 1,'C', 0 );

    $this->SetXY(26.0, 15);
    $this->Cell(3, 0.7, 'Promovidos: ', 0, 0);
    $this->Cell(5, 0.7, (@$r->promovidos_m + @$r->promovidos_f ), 'B', 1, 'C');

    $this->SetXY(26.0, 16.5);	
    $this->Cell(3, 0.7, 'Retenidos: ', 0, 0);
    //dd(@$r);
    $this->Cell(5, 0.7, (@$r->retenidos_m + @$r->retenidos_f ), 'B', 0, 'C');
    $this->SetLineWidth(0.02);
  }
}
