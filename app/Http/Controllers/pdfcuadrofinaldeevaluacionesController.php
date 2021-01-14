<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use \Codedge\Fpdf\Fpdf\Fpdf;

class pdfcuadrofinaldeevaluacionesController extends Fpdf
{
 var $height = 6;

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
  
 }
