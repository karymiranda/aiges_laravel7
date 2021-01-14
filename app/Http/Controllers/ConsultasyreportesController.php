<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivoFijo;
use App\TrasladosActivo;
use App\Catalogodecuenta;
use App\Permiso;
use App\Estadistica;
use App\AsistenciasEstudiantes;
use App\HorarioClases;
use App\BloqueHorarios;
use App\Fondodisponible;
use App\InfoCentroEducativo;
use App\Expedienteestudiante;
use App\Faltasestudiantes;
use App\Usuario;
use App\Empleado;
use App\AsistenciasRH;
use App\Seccion;
use App\Asignaturas;
use App\Familiares;
use App\Discapacidades;
use App\Datosmedicosestudiante;
use App\Transaccionesbono; 
use App\Grados;
use App\Periodoactivo;
use App\Periodohabilmatriculaonline;
use App\Departamentos;
use App\Periodoevaluacion;
use App\Notas;
use App\NotasItems;
use App\EvaluacionesPeriodo;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Http\Controllers\PdfController;
use \Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AsistenciaestudiantesExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ConsultasyreportesController extends Controller
{  
//REPORTES BONO ESCOLAR
public function cuadroresumendegastos_pdf(Request $request)
{
  $id=$request->cuenta;
    $datos=Transaccionesbono::OrderBy('id','ASC')->with('transaccion_fondodisponible')->with('transaccion_rubro')->whereHas('transaccion_fondodisponible', function ($q) use ($id){$q->where('id','=',$id);})->where('tipo_transaccion','like','GASTO')->get();
 //dd($datos);
    $fpdf= new Fpdf("L","mm","Letter");
    $fpdf->AddPage();    
    $fpdf->SetTitle("librobancos".date('_Ymd'));
    $this->cabecerahorizontalbono($fpdf);
     $fpdf->Ln(5);
     $fpdf->SetFont('Helvetica','BU','10');
    $fpdf->Cell(0, 5, "CUADRO RESUMEN DE GASTOS DE FONDOS RECIBIDOS", 0, 1, "C"); 
    $fpdf->SetFont('Helvetica','','8');
    $fpdf->Cell(0, 5, $request->monto, 0, 1, "C");   
    $fpdf->Cell(0, 5, utf8_decode($request->titulo), 0, 0, "C");    
    $fpdf->Ln(10);
$fpdf->SetFont('Arial','','7');
$fpdf->MultiCell(0, 5, utf8_decode('1.Material educativo 2.Adquisición de equipo 3.Adquisición de mobiliario 4.Operación logística del centro educativo 5.Alimentación escolar 6.Capacitación local 7.Contratación de servicios profesionales 8.Otros'), 0, 'L', 0, 0, 'C', '', true);
//$fpdf->Ln(5);
    //header tabla
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','7');
    $fpdf->Cell(15, 5, "CHEQUE", 1, 0, "C",1); 
    $fpdf->Cell(20, 5,"FECHA", 1, 0, "C",1);
    $fpdf->Cell(55, 5, "CONCEPTO", 1, 0, "C",1); 
    $fpdf->Cell(150, 5,"RUBROS (SEGUN INSTRUCTIVO)", 1, 0, "C",1);
    $fpdf->Cell(20, 5, "TOTAL", 1, 1, "C",1);
//$fpdf->SetFont('Arial','','4');
    $fpdf->Cell(15, 5, "", 1, 0, "C",1); 
    $fpdf->Cell(20, 5,"", 1, 0, "C",1);
    $fpdf->Cell(55, 5, "", 1, 0, "C",1); 
    $fpdf->Cell(19, 5,"1", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"2", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"3", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"4", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"5", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"6", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"7", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"8", 1, 0, "C",1);
    $fpdf->Cell(20, 5, "", 1, 1, "C",1);

    $fpdf->SetFont('Arial', '','7');
     $fpdf->SetFillColor(255,255,255);
    $total=0;
    $totalrubro1=0;
    $totalrubro2=0;
    $totalrubro3=0;
    $totalrubro4=0;
    $totalrubro5=0;
    $totalrubro6=0;
    $totalrubro7=0;
    $totalrubro8=0;

    foreach ($datos as $value) {
    $fpdf->Cell(15, 5, $value->numero_cheque, 1, 0, "C",1); 
    $fpdf->Cell(20, 5,$value->fecha_transaccion, 1, 0, "C",1);
    $fpdf->Cell(55, 5, $value->concepto, 1, 0, "C",1);
    $total=$total+$value->gasto;
      switch ($value->rubro_id) { 
        case '1':  
    $totalrubro1=$totalrubro1+$value->gasto; 
    $fpdf->Cell(19, 5,"$ ".$value->gasto, 1, 0, "R",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"$ ".$value->gasto, 1,1, "R",1);
          break;
          case '2':
    $totalrubro2=$totalrubro2+$value->gasto;     
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"$ ".$value->gasto, 1, 0, "R",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
      $fpdf->Cell(20, 5,"$ ".$value->gasto, 1,1, "R",1);
          break;
          case '3': 
    $totalrubro3=$totalrubro3+$value->gasto;    
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"$ ".$value->gasto, 1, 0, "R",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"$ ".$value->gasto, 1,1, "R",1);
          break;
          case '4': 
    $totalrubro4=$totalrubro4+$value->gasto;    
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"$ ".$value->gasto, 1, 0, "R",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
      $fpdf->Cell(20, 5,"$ ".$value->gasto, 1,1, "R",1);
          break;
           case '5': 
    $totalrubro5=$totalrubro5+$value->gasto;    
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"$ ".$value->gasto, 1, 0, "R",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
      $fpdf->Cell(20, 5,"$ ".$value->gasto, 1,1, "R",1);
          break;
           case '6':
    $totalrubro6=$totalrubro6+$value->gasto;     
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"$ ".$value->gasto, 1, 0, "R",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
      $fpdf->Cell(20, 5,"$ ".$value->gasto, 1,1, "R",1);
          break;
          case '7': 
    $totalrubro7=$totalrubro7+$value->gasto;    
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"$ ".$value->gasto, 1, 0, "R",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
      $fpdf->Cell(20, 5,"$ ".$value->gasto, 1,1, "R",1);
          break;
            case '8':
    $totalrubro8=$totalrubro8+$value->gasto;     
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(19, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"", 1, 0, "C",1);
    $fpdf->Cell(18, 5,"$".$value->gasto, 1, 0, "R",1);
      $fpdf->Cell(20, 5,"$ ".$value->gasto, 1,1, "R",1);
          break;            
      }
      //$fpdf->Cell(20, 5,"$ ".$totalrubro1, 1,1, "R",1);
    }

    //$fpdf->Cell(15, 5, "", 1, 0, "C",1); 
   // $fpdf->Cell(20, 5,"", 1, 0, "C",1);
    $fpdf->Cell(90, 5, "TOTAL POR RUBROS $", 1, 0, "C",1); 
    $fpdf->Cell(19, 5, "$ ".$totalrubro1, 1, 0, "R",1);
    $fpdf->Cell(19, 5, "$ ".$totalrubro2, 1, 0, "R",1);
    $fpdf->Cell(19, 5, "$ ".$totalrubro3, 1, 0, "R",1);
    $fpdf->Cell(19, 5, "$ ".$totalrubro4, 1, 0, "R",1);
    $fpdf->Cell(19, 5, "$ ".$totalrubro5, 1, 0, "R",1);
    $fpdf->Cell(19, 5, "$ ".$totalrubro6, 1, 0, "R",1);
    $fpdf->Cell(18, 5, "$ ".$totalrubro7, 1, 0, "R",1);
    $fpdf->Cell(18, 5, "$ ".$totalrubro8, 1, 0, "R",1);
    $fpdf->Cell(20, 5, "$ ".$total, 1, 1, "R",1);

//$fpdf->Ln(10);
$fpdf->Ln(10);
     $fpdf->SetFont('Arial','', 10);
     $fpdf->Cell(95, $this->height, "F._____________________________________", 0, 0, 'C');
    $fpdf->Cell(225, $this->height, "F._____________________________________", 0, 1, 'C');
    
   /* $this->Cell(95, $this->height, "  ".utf8_decode($object['centro']->nombre_director_ar), 0, 0, 'C');
    $this->Cell(100, $this->height, (utf8_decode($object['profesor']->v_nombres)).", ". (utf8_decode($object['profesor']->v_apellidos)), 0, 1, 'C');*/
     $fpdf->Cell(95, $this->height, "  Director del Centro Escolar", 0, 0, 'C');
     $fpdf->Cell(230, $this->height, utf8_decode("Encargado/a área financiera"), 0, 0, 'C');
     $fpdf->Ln(5);

    $response=response($fpdf->Output("s"));
    $response->header('Content-Type', 'application/pdf');
    return $response;
}

public function librobancos(Request $request)
  {
$periodo=Periodoactivo::where('tipo_periodo','like','CONTABLE')->pluck('nombre','id');
    return view('admin.consultasyreportes.bonoescolar.librobancos')->with('periodo',$periodo);
  }

 public function librobancos_pdf(Request $request)
  {
    $periodo=$request->periodo;
    $datos=Transaccionesbono::with('transaccion_ciclocontable')->where('ciclocontable_id','=',$periodo)->get();

    //dd($datos); 
    $fpdf= new Fpdf("L","mm","Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
    $fpdf->AddPage();    //header para reporte  
    $fpdf->SetFillColor(0,128,128);//defino el color de fondo en codigo RGB
   
$fpdf->SetTitle("librobancos".date('_Ymd'));
$this->cabecerahorizontalbono($fpdf);
 $fpdf->Ln(5);

$fpdf->SetFont('Helvetica','BU','12');//tippo de letra, caracteristicas B negrita I cursiva
$titulo=Periodoactivo::find($request->periodo);
$titulo=$titulo->nombre;

    $fpdf->Cell(0, $this->height, "LIBRO BANCOS", 0, 1, "C");
    $fpdf->SetFont('Helvetica','B','10');
    $fpdf->Cell(0, 5, $titulo, 0, 0, "C");    
    $fpdf->Ln(10);

   //Cuerpo de reporte    
    //header tabla
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','10');
    $fpdf->Cell(25, 5, "Fecha", 1, 0, "C",1); 
    $fpdf->Cell(100, 5,"Concepto", 1, 0, "C",1);
    $fpdf->Cell(50, 5,"A favor de", 1, 0, "C",1);
    $fpdf->Cell(20, 5, "Cheque", 1, 0, "C",1); 
    $fpdf->Cell(20, 5,"Ingresos", 1, 0, "C",1);
    $fpdf->Cell(20, 5, "Gastos", 1, 0, "C",1); 
    $fpdf->Cell(20, 5, "Saldo", 1, 1, "C",1);

    //body tabla
     $fpdf->SetFont('Arial','','8');
    foreach ($datos as $value) {
      $fpdf->Cell(25, 5, $value->fecha_transaccion, 1, 0, "L"); 
      $fpdf->Cell(100, 5, $value->concepto, 1, 0, "L",0); 
      $fpdf->Cell(50, 5, $value->a_favor_de, 1, 0, "L",0); 
      if($value->tipo_transaccion=='INGRESO'){
        $fpdf->Cell(20, 5, "N/A", 1, 0, "C"); 
        $fpdf->Cell(20, 5,"$ ". $value->ingreso, 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 0, "C"); 
        $fpdf->Cell(20, 5,"$ ".$value->saldo_bancos, 1, 1, "C"); 
      }
        else if($value->tipo_transaccion=='GASTO'){
        $fpdf->Cell(20, 5,$value->numero_cheque, 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 0, "C"); 
        $fpdf->Cell(20, 5,"$ ". $value->gasto, 1, 0, "C"); 
        $fpdf->Cell(20, 5, "$ ".$value->saldo_bancos, 1, 1, "C");
        }
          else if($value->tipo_transaccion=='ANULADO'){
        $fpdf->Cell(20, 5,$value->numero_cheque, 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 1, "C");
          }
    }

 $fpdf->Ln(10);
     $fpdf->SetFont('Arial','', 10);
     $fpdf->Cell(95, $this->height, "F._____________________________________", 0, 0, 'C');
    $fpdf->Cell(185, $this->height, "F._____________________________________", 0, 1, 'C');
    
   /* $this->Cell(95, $this->height, "  ".utf8_decode($object['centro']->nombre_director_ar), 0, 0, 'C');
    $this->Cell(100, $this->height, (utf8_decode($object['profesor']->v_nombres)).", ". (utf8_decode($object['profesor']->v_apellidos)), 0, 1, 'C');*/
     $fpdf->Cell(95, $this->height, "  Director del Centro Escolar", 0, 0, 'C');
     $fpdf->Cell(190, $this->height, utf8_decode("Encargado/a área financiera"), 0, 0, 'C');
     $fpdf->Ln(5);


    $response=response($fpdf->Output("s"));
    $response->header('Content-Type', 'application/pdf');
    return $response;
  }

function cabecerahorizontalbono($fpdf)
{
   $centro = InfoCentroEducativo::first();
    $fpdf->Image('imagenes/recursosrpt/escudoce.jpg',60,8,20);
    $fpdf->Image('imagenes/recursosrpt/escudo.png',200,8,20);
    // Arial bold 15
    $fpdf->SetFont('Arial','',10); 
     $fpdf->Cell(0, $this->height - 1, utf8_decode('GERENCIA ADMINISTRATIVA FINANCIERA'), 0, 1, 'C');
    $fpdf->SetFont('Arial','B',10); 
    $fpdf->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
   // $fpdf->SetFont('Arial','IB', 10);
    //$fpdf->Cell(0, $this->height - 1, utf8_decode('"VEN CON NOSOSTROS A CAMINAR"'), 0, 1, 'C');
    $fpdf->SetFont('Arial','I',10);
    $fpdf->Cell(0, $this->height-2, utf8_decode($centro->v_direccion), 0, 1, 'C');    
    $fpdf->Cell(0, $this->height-2, utf8_decode('Teléfono '.$centro->v_telefono.' E-mail: '.$centro->correo_electronico), 0, 1, 'C');
    $fpdf->Cell(0, $this->height, '', 'B', 1, 'C');
}
//var $height = 6;
function cabecerabono($fpdf)
{
   $centro = InfoCentroEducativo::first();

    $fpdf->Image('imagenes/recursosrpt/escudoce.jpg',10,8,20);
    $fpdf->Image('imagenes/recursosrpt/escudo.png',185,8,20);
    // Arial bold 15
    $fpdf->SetFont('Arial','',10); 
     $fpdf->Cell(0, $this->height - 1, utf8_decode('GERENCIA ADMINISTRATIVA FINANCIERA'), 0, 1, 'C');
    $fpdf->SetFont('Arial','B',10); 
    $fpdf->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
    $fpdf->SetFont('Arial','IB', 10);
    $fpdf->SetFont('Arial','I',10);
    $fpdf->Cell(0, $this->height-2, utf8_decode($centro->v_direccion), 0, 1, 'C');    
    $fpdf->Cell(0, $this->height-2, utf8_decode('Teléfono '.$centro->v_telefono.' E-mail: '.$centro->correo_electronico), 0, 1, 'C');
    $fpdf->Cell(0, $this->height, '', 'B', 1, 'C');
}


  public function historialbancos(Request $request)
  {
    $id=$request->id;
   $datos=Transaccionesbono::with('transaccion_ciclocontable')->where('ciclocontable_id','=',$id)->get();
    return response()->json($datos);
  }

public function trasladosrpt($tipotraslado,$categoria)
{
  switch ($tipotraslado) 
  {
  case '0'://todos
  if($categoria==null)
  {//buscare todos los activos
  $traslados=TrasladosActivo::Orderby('f_fechatraslado','Asc')->with('activofijo')->with('tipotraslado')->with('destino')->where('v_estado',1)->get();
  }
  else
  {
    //buscaremos activos trasladados de una categoria especifica  
  $traslados=TrasladosActivo::Orderby('f_fechatraslado','Asc')->whereHas('activofijo', function ($q) use ($categoria){
    $q->whereHas('cuentacatalogo', function($a) use ($categoria){ $a->where([['v_codigocuenta','LIKE',$categoria.'%'],['v_nivel',4]]);
    });})->with('activofijo')->with('tipotraslado')->with('destino')->where('v_estado',1)->get();
}
       break;

  case '1'://prestamo
      
  if($categoria==null)
  {//buscare todos los activos
  $traslados=TrasladosActivo::Orderby('f_fechatraslado','Asc')->whereHas('tipotraslado', function($a){ 
    $a->where('v_descripcion','LIKE','PRESTAMO');
    })->with('tipotraslado')->with('activofijo')->with('destino')->where('v_estado',1)->get();
  }
  else
  {
    //buscaremos activos trasladados de una categoria especifica  
  $traslados=TrasladosActivo::Orderby('f_fechatraslado','Asc')->whereHas('activofijo', function ($q) use ($categoria){
    $q->whereHas('cuentacatalogo', function($a) use ($categoria){ $a->where([['v_codigocuenta','LIKE',$categoria.'%'],['v_nivel',4]]);
    });})->with('activofijo')->with('tipotraslado')->whereHas('tipotraslado', function($a) { 
    $a->where('v_descripcion','LIKE','PRESTAMO');
    })->with('destino')->where('v_estado',1)->get();
}
       break;

  case '2'://traslado
     if($categoria==null)
  {//buscare todos los activos
  $traslados=TrasladosActivo::Orderby('f_fechatraslado','Asc')->whereHas('tipotraslado', function($a){ 
    $a->where('v_descripcion','LIKE','PERMANENTE');
    })->with('tipotraslado')->with('activofijo')->with('destino')->where('v_estado',1)->get();
  }
  else
  {
    //buscaremos activos trasladados de una categoria especifica  
  $traslados=TrasladosActivo::Orderby('f_fechatraslado','Asc')->whereHas('activofijo', function ($q) use ($categoria){
    $q->whereHas('cuentacatalogo', function($a) use ($categoria){ $a->where([['v_codigocuenta','LIKE',$categoria.'%'],['v_nivel',4]]);
    });})->with('activofijo')->with('tipotraslado')->whereHas('tipotraslado', function($a) { 
    $a->where('v_descripcion','LIKE','PERMANENTE');
    })->with('destino')->where('v_estado',1)->get();
}
       break;
     
     default:
       # code...
       break;
   }

return $traslados;
}

public function consultatrasladosactivo(Request $request)
  {
  $tipotraslado=$request->tipotraslado;
  $categoria=$request->categoria;
  $traslados=$this->trasladosrpt($tipotraslado,$categoria);
  return response()->json($traslados);
  }

 public function consultalistabienes(Request $request)
  {
$estado=$request->estado;//estado del activo
$categoria=$request->categoria;//estado del activo
$activos=$this->activosrpt($estado,$categoria);  
    return response()->json($activos);
  }

 public function consultacatalogo(Request $request)
  {
if($request->categoria==null)
{
  $cuentas = Catalogodecuenta::orderBy('v_codigocuenta','ASC')->where([['v_codigocuenta','LIKE','12%'],['v_nivel',4]])->get();
      
}
  else{ 
   $cuentas = Catalogodecuenta::where([['v_codigocuenta','LIKE',$request->categoria.'%'],['v_nivel',4]])->get(); 
 
  }
   return response()->json($cuentas);
  }
  
    public function librooperacionyfuncionamiento()
    {  
      $cuentas=Fondodisponible::OrderBy('id','ASC')->pluck('descripcion','id');
   return view('admin.consultasyreportes.bonoescolar.librooperacionyfuncionamiento')->with('cuentas',$cuentas);
      //dd('exito');
    }

    public function librooperacionyfuncionamiento_pdf(Request $request)
  {
    $cuenta=$request->cuenta;
    $datos=Transaccionesbono::OrderBy('id','ASC')->with('transaccion_fondodisponible')->whereHas('transaccion_fondodisponible', function ($q) use($cuenta){$q->where('fondodisponible_id','=',$cuenta);})->get();
   
    $fpdf= new Fpdf("P","mm","Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
    $fpdf->AddPage();
    //header para reporte
   $fpdf->SetFont('Arial', '', 10);//OBLIGATORIO DEFINIR TIPOGRAFIA
    $fpdf->SetFillColor(0,128,128);
    $fpdf->SetTitle("librooperacionyfuncionamiento".date('_Ymd'));
$this->cabecerabono($fpdf);
 $fpdf->Ln(5);
 $fpdf->SetFont('Helvetica', 'BU', 10);
    $fpdf->Cell(0, 5, $request->titulo, 0, 1, "C");
 $fpdf->SetFont('Helvetica', '', 10);
    $fpdf->Cell(0, 5, $request->monto, 0, 0, "C");
    $fpdf->Ln(10);

   //Cuerpo de reporte    
    //header tabla
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','9');
    $fpdf->Cell(25, 5, "FECHA", 1, 0, "C",1); 
    $fpdf->Cell(90, 5,"CONCEPTO", 1, 0, "C",1);
    $fpdf->Cell(20, 5, "CHEQUE", 1, 0, "C",1); 
    $fpdf->Cell(20, 5,"INGRESOS", 1, 0, "C",1);
    $fpdf->Cell(20, 5, "GASTOS", 1, 0, "C",1); 
    $fpdf->Cell(20, 5, "SALDO", 1, 1, "C",1);

    //body tabla
     $fpdf->SetFont('Arial', '','8');
    foreach ($datos as $value) {
      $fpdf->Cell(25, 5, $value->fecha_transaccion, 1, 0, "L"); 
      $fpdf->Cell(90, 5, $value->concepto, 1, 0, "L",0); 
     
      if($value->tipo_transaccion=='INGRESO'){
        $fpdf->Cell(20, 5, "N/A", 1, 0, "C"); 
        $fpdf->Cell(20, 5, "$ ".$value->ingreso, 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 0, "C"); 
        $fpdf->Cell(20, 5, "$ ".$value->saldo, 1, 1, "C"); 
      }
        else if($value->tipo_transaccion=='GASTO'){
        $fpdf->Cell(20, 5,$value->numero_cheque, 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 0, "C"); 
        $fpdf->Cell(20, 5,"$ ".$value->gasto, 1, 0, "C"); 
        $fpdf->Cell(20, 5,"$ ".$value->saldo, 1, 1, "C");
        }
          else if($value->tipo_transaccion=='ANULADO'){
        $fpdf->Cell(20, 5,$value->numero_cheque, 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 0, "C"); 
        $fpdf->Cell(20, 5, "-", 1, 1, "C");
          }
    }

    $fpdf->Ln(10);
     $fpdf->SetFont('Arial','', 10);
     $fpdf->Cell(95, $this->height, "F._____________________________________", 0, 0, 'C');
    $fpdf->Cell(95, $this->height, "F._____________________________________", 0, 1, 'C');
    
       $fpdf->Cell(95, $this->height, "  Director del Centro Escolar", 0, 0, 'C');
     $fpdf->Cell(100, $this->height, utf8_decode("Encargado/a área financiera"), 0, 0, 'C');
     $fpdf->Ln(5);

    
    //PIE DE PAGINA
    // $this->footer($fpdf); 

    $response=response($fpdf->Output("s"));
    $response->header('Content-Type', 'application/pdf');
    return $response;
  }

    public function historialperacionyfuncionamiento(Request $request)
    {
    $id=$request->id;
    $datos=Transaccionesbono::OrderBy('id','ASC')->with('transaccion_fondodisponible')->whereHas('transaccion_fondodisponible', function ($q) use($id){$q->where('fondodisponible_id','=',$id);})->get();
    return response()->json($datos);
  }

  
////////////////////////////////////////////////////////////////////////////////////////////////
 //RECURSO HUMANO PDF Y EXCEL

  public function expedienterh_pdf($id)
{
$empleado=Empleado::with('empleado_estudio')->where('id',$id)->first();
     $user=Usuario::where('personal_id','=',$id)->first();
    $genero=$empleado->v_genero;
    $formato = Carbon::createFromFormat('Y-m-d',$empleado->f_fechanaci);
    $empleado->f_fechanaci = $formato->format('d/m/Y');
    if($empleado->f_fechaingresoalCE!=null)
    {
      $formato2 = Carbon::createFromFormat('Y-m-d',$empleado->f_fechaingresoalCE);
      $empleado->f_fechaingresoalCE = $formato2->format('d/m/Y');
    }
    if($empleado->f_fechaingresoministerio!=null)
    {
      $formato3 = Carbon::createFromFormat('Y-m-d',$empleado->f_fechaingresoministerio);
      $empleado->f_fechaingresoministerio = $formato3->format('d/m/Y');
    }
    $edad = Carbon::parse($formato)->age;   
    $fpdf=new Fpdf("P","mm","Letter");
    $fpdf->AddPage();
    $fpdf->SetTitle($empleado->v_numeroexp.date('_Ymd'));
    $fpdf->SetFillColor(128,128,128);//DEFINE EL COLOR DE FONDO DE LAS CELDAS Q LO REQIOERA
  $this->logo($fpdf);
   /* $titulo="";
    $subtitulo="";
   $this->cabecera($fpdf,$titulo,$subtitulo);*/
  //$fpdf->Ln(5);
  //$fpdf->SetFont('Arial','B',10);
  //$fpdf->Cell(0, $this->height - 1, 'ADMINISTRACION DE PERSONAL', 0, 1, 'C');
  //$fpdf->SetFont('Arial','BU',10);
  //$fpdf->Cell(0, $this->height - 1, 'EXPEDIENTE', 0, 1, 'C');
  //$fpdf->Image('imagenes/Recursohumano/'.$user->foto,90,60,30);
$fpdf->SetDrawColor(212,212,212);//color para formas
$fpdf->SetLineWidth(1.5);
$fpdf->SetFillColor(247,247,247);
//$fpdf->Rect(25,15,60,80,"DF");
$fpdf->Rect(29,20,52,68.5,"DF");
$fpdf->Image('imagenes/Recursohumano/'.$user->foto,30,$this->height+15,50);
$fpdf->SetTextColor(0,13,0); 
$fpdf->SetFont('Arial', 'B','16');
$fpdf->SetXY(90,$this->height+25);
$fpdf->Cell(0,5,utf8_decode($empleado->v_nombres).' '. utf8_decode($empleado->v_apellidos),0,1,"C");
$fpdf->SetFont('Arial', '','12');
$fpdf->SetTextColor(98,98,98); 
$fpdf->SetXY(90,$this->height+35);
$fpdf->Cell(0,$this->height,utf8_decode($empleado->v_tituloacademico),0,1,"C");
$fpdf->SetLineWidth(0.5);
$fpdf->SetDrawColor(209,209,209);//color para formas
$fpdf->Line(100, $this->height+45, 200, $this->height+45); 
$fpdf->SetFont('Arial', 'B','12');
$fpdf->SetTextColor(0,0,0); 
$fpdf->SetXY(90,$this->height+50);
$fpdf->Cell(0,$this->height,"CONTACTO",0,1,"C");
$fpdf->SetFont('Arial', '','10');
$fpdf->SetTextColor(98,98,98);
$fpdf->SetXY(90,$this->height+60);
$fpdf->Cell(0,$this->height,$empleado->v_celular,0,1,"C");
$fpdf->SetX(90);
$fpdf->Cell(0,$this->height,$empleado->v_telCasa,0,1,"C");
$fpdf->SetX(90);
$fpdf->Cell(0,$this->height,$empleado->v_correo,0,1,"C");


$fpdf->Ln(20); 
//$fpdf->SetFillColor(255,128,128);
$fpdf->SetTextColor(75,75,75);
$fpdf->SetFont('Arial', 'UB','12');
$fpdf->Cell(0,$this->height,"DATOS PERSONALES",0,1,"C");
$fpdf->Ln(5); 
$fpdf->SetFont('Arial', '','9');
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Género"),1,0,1,"L");$fpdf->Cell(0,$this->height,utf8_decode($empleado->v_genero),1,1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,5,utf8_decode("Fecha de nacimiento"),1,0,"L");$fpdf->Cell(0,5,utf8_decode($empleado->f_fechanaci),1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,5,utf8_decode("DUI"),1,0,1,"L");$fpdf->Cell(0,5,utf8_decode($empleado->v_dui),1,1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,5,utf8_decode("NIT"),1,0,"L");$fpdf->Cell(0,5,utf8_decode($empleado->v_nit),1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,5,utf8_decode("Dirección"),1,0,1,"L");$fpdf->Cell(0,5,utf8_decode($empleado->v_direccioncasa),1,1,1,"L");
/*
$fpdf->Cell(60,5,utf8_decode("Teléfono de residencia"),0,0,"L");
if($empleado->v_telCasa!=null) 
{$fpdf->Cell(0,5,utf8_decode($empleado->v_telCasa),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}  
$fpdf->Cell(60,5,utf8_decode("Teléfono celular"),0,0,"L");
if($empleado->v_celular!=null) 
{$fpdf->Cell(0,5,utf8_decode($empleado->v_celular),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");} 
$fpdf->Cell(60,5,utf8_decode("Correo electrónico"),0,0,"L");
if($empleado->v_correo!=null) 
{$fpdf->Cell(0,5,utf8_decode($empleado->v_correo),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}
 */
$fpdf->Ln(10); 
$fpdf->SetTextColor(75,75,75);
$fpdf->SetFont('Arial', 'UB','12');
$fpdf->Cell(0,$this->height,"INFORMACION INSTITUCIONAL",0,1,"C");
$fpdf->Ln(5); 
$fpdf->SetFont('Arial', '','9');
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,"Expediente",1,0,1,"L");$fpdf->Cell(0,$this->height,$empleado->v_numeroexp,1,1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Fecha de contratación"),1,0,"L");
$fpdf->Cell(0,$this->height,utf8_decode($empleado->f_fechaingresoalCE),1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Tipo personal"),1,0,1,"L");$fpdf->Cell(0,$this->height,utf8_decode($empleado->tipoPersonal->v_tipopersonal),1,1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Cargo"),1,0,"L");$fpdf->Cell(0,$this->height,utf8_decode($empleado->cargo->v_descripcion),1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Tipo contratación"),1,0,1,"L");
if($empleado->v_tipocontratacion=="SB") 
{$fpdf->Cell(0,$this->height,utf8_decode("Sueldo base"),1,1,1,"L");}
else if ($empleado->v_tipocontratacion=="SS") {$fpdf->Cell(0,$this->height,"Sobre sueldo",1,1,1,"L");}
else if ($empleado->v_tipocontratacion=="HC"){$fpdf->Cell(0,$this->height,"Horas clase",1,1,1,"L");} 
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Salario mensual"),1,0,"L");
if($empleado->d_sueldo!=null) 
{$fpdf->Cell(0,$this->height,"$ ".utf8_decode($empleado->d_sueldo),1,1,"L");}
else {$fpdf->Cell(0,$this->height,"---",0,1,"L");}
$fpdf->SetX(30); 
$fpdf->Cell(70,$this->height,utf8_decode("Especialidad"),1,0,"L");$fpdf->Cell(0,$this->height,utf8_decode($empleado->especialidad->v_especialidad),1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Título academico"),1,0,1,"L");
if($empleado->v_tituloacademico!=null) 
{$fpdf->Cell(0,$this->height,utf8_decode($empleado->v_tituloacademico),1,1,1,"L");}
else {$fpdf->Cell(0,$this->height,"---",1,1,1,"L");} 
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Fecha de ingreso al sistema educativo"),1,0,"L");$fpdf->Cell(0,$this->height,utf8_decode($empleado->f_fechaingresoministerio),1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Nivel escalafón"),1,0,1,"L");
$fpdf->Cell(0,$this->height,utf8_decode($empleado->v_nivelescalafon),1,1,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("Categoria escalafón"),1,0,"L");
switch ($empleado->v_categoriaescalafon) {
  case '0':
   $fpdf->Cell(0,$this->height,"Ninguno",1,1,"L");
    break;
    case 'UA':
   $fpdf->Cell(0,$this->height,"Uno-A",1,1,"L");
    break;
     case 'UB':
   $fpdf->Cell(0,$this->height,"Uno-B",1,1,"L");
    break;
     case 'UC':
   $fpdf->Cell(0,$this->height,"Uno-C",1,1,"L");
    break;
     case 'D':
   $fpdf->Cell(0,$this->height,"Dos",1,1,"L");
    break;
     case 'T':
   $fpdf->Cell(0,$this->height,"Tres",1,1,"L");
    break;
     case 'Cu':
   $fpdf->Cell(0,$this->height,"Cuatro",1,1,"L");
    break;
     case 'C':
   $fpdf->Cell(0,$this->height,"Cinco",1,1,"L");
    break;
     case 'S':
   $fpdf->Cell(0,$this->height,"Seis",1,1,"L");
    break;
   
  
  default:
    # code...
    break;
}
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("NIP"),1,0,1,"L");
if($empleado->v_nip!=null) 
{$fpdf->Cell(0,$this->height,utf8_decode($empleado->v_nip),1,1,1,"L");}
else {$fpdf->Cell(0,$this->height,"---",1,1,1,"L");} 
$fpdf->SetX(30);
$fpdf->Cell(70,$this->height,utf8_decode("NUP"),1,0,"L");
if($empleado->v_nup!=null) 
{$fpdf->Cell(0,$this->height,utf8_decode($empleado->v_nup),1,1,"L");}
else {$fpdf->Cell(0,$this->height,"---",1,1,"L");} 

 $fpdf->AddPage();
//$fpdf->Ln(20); 
$fpdf->SetTextColor(75,75,75);
$fpdf->SetFont('Arial', 'UB','12');
$fpdf->Cell(0,$this->height,"FORMACION ACADEMICA",0,1,"C");
$fpdf->SetFont('Arial', '','9');
foreach ($empleado->empleado_estudio as $key => $value) 
{
$fpdf->Ln(5); 
$fpdf->SetX(30);
$fpdf->Cell(60,$this->height,$value->anioinicio . " | " .  $value->aniofin,1,0,1,"L");
if($value->institucion!=null){
$fpdf->Cell(0,$this->height,$value->institucion,1,1,"L");
}else{$fpdf->Cell(0,"---",1,1,"L");}
$fpdf->SetX(30);
$fpdf->Cell(60,$this->height,"" ,0,0,"L");
if($value->titulo!=null){
$fpdf->Cell(0,$this->height,$value->titulo,1,1,"L");}
else{
  $fpdf->Cell(0,$this->height,"---",1,1,"L");
}
}

  //$this->piedepagina($fpdf);
  $response=response($fpdf->Output("s"));
  $response->header('Content-Type','application/pdf');
  return $response;
}

function logo($fpdf)
{
  // $fpdf->Line(20, 30, 205, 20);
  // $fpdf->Image('imagenes/recursosrpt/escudoce.jpg',10,8,20);
    //$fpdf->Image('imagenes/recursosrpt/escudo.png',185,15,10);
}

 //ACADEMICA REPORTES PDF Y EXCEL

public function expedientefamiliar_pdf($id)
{
$familiar=Familiares::find($id);
    $user=Usuario::where('familiar_id','=',$id)->first();
    if($familiar->fechanacimiento!=null){
    $formato = Carbon::createFromFormat('Y-m-d',$familiar->fechanacimiento);
    $familiar->fechanacimiento = $formato->format('d/m/Y');
  } 

    $fpdf=new Fpdf("P","mm","Letter");
    $fpdf->AddPage();
    $fpdf->SetTitle($familiar->expediente.date('_Ymd'));
    $fpdf->SetFillColor(128,128,128);//DEFINE EL COLOR DE FONDO DE LAS CELDAS Q LO REQIOERA
    $titulo="";
    $subtitulo="";
    $this->cabecera($fpdf,$titulo,$subtitulo);
  $fpdf->Ln(5);
   $fpdf->SetFont('Arial','B',12);
   $fpdf->Cell(0, $this->height - 1, 'ADMINISTRACION ACADEMICA', 0, 1, 'C');
   $fpdf->SetFont('Arial','BU',10);
    $fpdf->Cell(0, $this->height - 1, 'EXPEDIENTE FAMILIAR', 0, 1, 'C');
    //$fpdf->Line(30, 30, 205, 30);
   //$fpdf->Image('imagenes/Administracionacademica/Padresdefamilia/'.$user->foto,90,60,33);


$fpdf->SetDrawColor(212,212,212);//color para formas
$fpdf->SetLineWidth(1.5);
$fpdf->SetFillColor(247,247,247);
//$fpdf->Rect(25,15,60,80,"DF");
$fpdf->Rect(29,60,52,55,"DF");
$fpdf->Image('imagenes/Administracionacademica/Padresdefamilia/'.$user->foto,30,$this->height+55,50);
$fpdf->SetTextColor(0,13,0); 

$fpdf->SetFont('Arial', 'B','12');
$fpdf->SetXY(90,$this->height+65);
$fpdf->Cell(0,5,utf8_decode($familiar->nombres).' '.utf8_decode($familiar->apellidos),0,1,"C");
$fpdf->SetLineWidth(0.5);
$fpdf->SetDrawColor(209,209,209);//color para formas
$fpdf->Line(100, $this->height+75, 200, $this->height+75); 
$fpdf->SetFont('Arial', 'B','12');
$fpdf->SetTextColor(0,0,0); 

$fpdf->SetFont('Arial', '','10');
$fpdf->SetTextColor(98,98,98);
$fpdf->SetXY(120,$this->height+80);
$fpdf->SetX(140);
if($familiar->telefonocasa!=null) 
{$fpdf->Cell(0,$this->height,$familiar->telefonocasa,0,0,"L");}
else {$fpdf->Cell(0,$this->height,"---",0,1,"L");} 
$fpdf->SetX(140);
if($familiar->celular!=null) 
{$fpdf->Cell(0,$this->height,$familiar->celular,0,1,"L");}
else {$fpdf->Cell(0,$this->height,"---",0,1,"L");} 




   
$fpdf->Ln(40);
$fpdf->SetFont('Arial', '','10');
$fpdf->SetX(30);
$fpdf->Cell(60,5,"Expediente",0,0,"L");$fpdf->Cell(0,5,$familiar->expediente,0,1,"L");
//$fpdf->Line(70, 105, 200, 105);
$fpdf->SetX(30);
$fpdf->Cell(60,5,"Nombres",0,0,"L");$fpdf->Cell(0,5,utf8_decode($familiar->nombres),0,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(60,5,"Apellidos",0,0,"L");$fpdf->Cell(0,5,utf8_decode($familiar->apellidos),0,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(60,5,"DUI",0,0,"L");
if($familiar->dui!=null) 
{$fpdf->Cell(0,5,$familiar->dui,0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}  
$fpdf->SetX(30);   
$fpdf->Cell(60,5,utf8_decode("Género"),0,0,"L");$fpdf->Cell(0,5,$familiar->genero,0,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(60,5,"Fecha de nacimiento",0,0,"L");
if($familiar->fechanacimiento!=null){
$fpdf->Cell(0,5,$familiar->fechanacimiento,0,1,"L");
}else{$fpdf->Cell(0,5,"---",0,1,"L");}
$fpdf->SetX(30);
$fpdf->Cell(60,5,utf8_decode("Dirección"),0,0,"L");$fpdf->Cell(0,5,utf8_decode($familiar->direccionderesidencia),0,1,"L");
//$fpdf->SetX(30);
//$fpdf->Cell(60,5,"Encargado",0,0,"L");$fpdf->Cell(0,5,$familiar->encargado,0,1,"L");
//$fpdf->SetX(30);
//$fpdf->Cell(60,5,"Autorizado a retirar estudiante",0,0,"L");$fpdf->Cell(0,5,$familiar->autorizacion,0,1,"L");
$fpdf->SetX(30);
$fpdf->Cell(60,5,"Nivel educativo",0,0,"L");$fpdf->Cell(0,5,$familiar->niveleducativo,0,1,"L"); 
$fpdf->SetX(30);
$fpdf->Cell(60,5,utf8_decode("Profesión"),0,0,"L");
if($familiar->profesion!=null) 
{$fpdf->Cell(0,5,utf8_decode($familiar->profesion),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}
$fpdf->SetX(30); 
$fpdf->Cell(60,5,"Lugar de trabajo",0,0,"L");
if($familiar->lugardetrabajo!=null) 
{$fpdf->Cell(0,5,utf8_decode($familiar->lugardetrabajo),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");} 
$fpdf->SetX(30);
$fpdf->Cell(60,5,utf8_decode("Dirección de trabajo"),0,0,"L");
if($familiar->direcciondetrabajo!=null) 
{$fpdf->Cell(0,5,utf8_decode($familiar->direcciondetrabajo),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");} 
$fpdf->SetX(30);
$fpdf->Cell(60,5,utf8_decode("Teléfono de trabajo"),0,0,"L");
if($familiar->telefonotrabajo!=null) 
{$fpdf->Cell(0,5,$familiar->telefonotrabajo,0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");} 
$fpdf->SetX(30);
$fpdf->Cell(60,5,utf8_decode("Teléfono de residencia"),0,0,"L");
if($familiar->telefonocasa!=null) 
{$fpdf->Cell(0,5,$familiar->telefonocasa,0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");} 
$fpdf->SetX(30);
$fpdf->Cell(60,5,utf8_decode("Teléfono Celular"),0,0,"L");
if($familiar->celular!=null) 
{$fpdf->Cell(0,5,$familiar->celular,0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");} 
$fpdf->SetX(30);
$fpdf->Cell(60,5,utf8_decode("Correo electrónico"),0,0,"L");
if($familiar->correo!=null) 
{$fpdf->Cell(60,5,$familiar->correo,0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}

$this->piedepagina($fpdf);
    $response=response($fpdf->Output("s"));
    $response->header('Content-Type','application/pdf');
    return $response;
}


  //HORARIOS DE CLASES
public function horariosdeclases_pdf($idseccion)
{
  try
  {
    //DB::beginTransaction();
   // DB::commit();
$anio = Seccion::find($idseccion);
$anio=$anio->anio;
    $horario = HorarioClases::where([['anio','=',$anio],['tb_horario_clases.seccion_id','=',$idseccion]])
      ->orderBy('id','ASC')->get();
      $horario->each(function($horario){ 
      $horario->horario_asignatura;
      $horario->horario_docente; 
      $horario->horario_bloque;
    });

  //CODIGO PARA REPORTE
$fpdf=new Fpdf("L","mm","Letter");//Legal es pagina tamaño oficio, Letter para carta
$fpdf->AddPage();
$fpdf->SetTitle("horariodeclases".date('_Ymd'));
$this->cabecerahorizontal($fpdf);
$fpdf->Ln(5);
$fpdf->SetFont('Arial','B',12);
$fpdf->Cell(0, $this->height - 1, 'ADMINISTRACION ACADEMICA', 0, 1, 'C');
$fpdf->SetFont('Arial','BU',12);
$fpdf->Cell(0, $this->height - 1, 'HORARIO DE CLASES', 0, 1, 'C');
$fpdf->Cell(0, $this->height - 1, utf8_decode('AÑO ESCOLAR ').$anio, 0, 1, 'C');
//////////////////////////////////////////////  

//CONSULTA INFO  

  if(count($horario)>0){
  /*  $seccion=Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'))
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.id','=',$idseccion)
            ->first();*/
$seccion=Seccion::with('seccion_grado')->where('id','=',$idseccion)->first();
if($seccion->seccion_empleado==null){
 $asesor="SIN ASIGNAR";
}
else{
  $asesor=strtoupper(utf8_decode($seccion->seccion_empleado->v_nombres))." ".utf8_decode(strtoupper($seccion->seccion_empleado->v_apellidos));
}


    $lista[]=null;
    $d=0;
    $b=0;
    $nbloq=$horario->first()->horario_bloque->id;
    foreach ($horario as $horario) {
      if($nbloq!=$horario->horario_bloque->id){
        $b++;
        $d=0;
        $nbloq=$horario->horario_bloque->id;
      }
      $lista[$b][$d][0] = date('g:i A',strtotime($horario->horario_bloque->hora_inicio)) .' - '. date('g:i A',strtotime($horario->horario_bloque->hora_fin));
      $lista[$b][$d][1] = $horario->horario_bloque->tipo_bloque;
      if($horario->horario_bloque->tipo_bloque=='Clase') {
        $lista[$b][$d][2] = $horario->horario_asignatura->asignatura;
        $lista[$b][$d][3] = $horario->horario_docente->v_nombres . ' ' . $horario->horario_docente->v_apellidos;
        //  dd($lista[$b][$d][3]);
      }else{
        $lista[$b][$d][2] = null;
        $lista[$b][$d][3] = null;
      }
      $d++;           
    }//FOREACH
    //FIN CONSULTA
//dd($b);

$fpdf->Ln(5);
$fpdf->SetFont('Arial','',8);
$fpdf->Cell(14, $this->height - 1, 'Grado: ', 0, 0, 'R');
$fpdf->Cell(80, $this->height +1,utf8_decode($seccion->seccion_grado->grado), 'B');

$fpdf->Cell(15, $this->height - 1, utf8_decode('Sección: '), 0, 0, 'R');
$fpdf->Cell(56, $this->height +1,utf8_decode($seccion->seccion), 'B');

$fpdf->Cell(15, $this->height - 1, utf8_decode('Turno: '), 0, 0, 'R');
$fpdf->Cell(80, $this->height +1,utf8_decode($seccion->seccion_turno->turno), 'B');

$fpdf->Ln(5);




//SIGUE CODIGO PARA REPORTE
//header tabla
    $fpdf->Ln(10);
    $fpdf->SetFillColor(45,87,44);
    $fpdf->SetTextColor(255,255,255);//color blanco 
    $fpdf->SetFont('Arial','B','9');
    $fpdf->Cell(35, 5, "HORARIO", 1, 0, "C",1); 
    $fpdf->Cell(45, 5,"LUNES", 1, 0, "C",1);
    $fpdf->Cell(45, 5, "MARTES", 1, 0, "C",1); 
    $fpdf->Cell(45, 5,"MIERCOLES", 1, 0, "C",1);
    $fpdf->Cell(45, 5,"JUEVES", 1, 0, "C",1);
    $fpdf->Cell(45, 5, "VIERNES", 1, 1, "C",1);
    // $fpdf->SetTextColor(10,10,10);//color negro
    $fpdf->SetFont('Arial','','8');

//dd($lista);
     for($i=0;$i<=$b;$i++)
     {  
        $fpdf->SetTextColor(255,255,255);
        $fpdf->Cell(35, 5,utf8_decode($lista[$i][0][0]),1, 0, "C",1);  //aca van los horarios   
          for($e=0;$e<5;$e++)
          {     
                 if ($lista[$i][$e][1]!='Clase')
                 {                   
    $fpdf->SetTextColor(255,255,255);
                 if($e<4){         
                  $fpdf->Cell(45, 5,"Receso", 1, 0, "C",1); 
                  } 
                  else{
                  $fpdf->Cell(45, 5,"Receso", 1, 1, "C",1); 
                  }
                  }         
                 else
                 {
                   $fpdf->SetTextColor(10,10,10);
                 if($e<4){//para pasar ala siguiente linea
                 
                   $fpdf->Cell(45, 5,utf8_decode($lista[$i][$e][2]), 1, 0, "C",0); 
                 }else
                 { 
                     $fpdf->Cell(45, 5,utf8_decode($lista[$i][$e][2]), 1, 1, "C",0);             }
               }            
           } 
          
      }


}//cierro if $horario no esta vacio

else{
  $fpdf->SetFont('Arial','',10);
  $fpdf->MultiCell(0, $this->height - 1, utf8_decode('No hay información para mostrar.'), 0, 'L', 0, 0, '', '', true);
}

$h=is_array($horario) ? count($horario) : 0;
  if(!$h>0)
{
$seccion=Seccion::with('seccion_grado')->where('id','=',$idseccion)->first();
if($seccion->seccion_empleado==null){
 $asesor="SIN ASIGNAR";
}
else{
  $asesor=strtoupper(utf8_decode($seccion->seccion_empleado->v_nombres))." ".utf8_decode(strtoupper($seccion->seccion_empleado->v_apellidos));
}
}


$director=InfoCentroEducativo::first();
$director=$director->nombre_director_ar;
$this->footerfirmashorizontal($fpdf,$director,$asesor);
$this->piedepagina($fpdf);
$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
return $response;

}//cierro try
catch(Exception $e){

}
}
public function comprobantematriculaenlinea_pdf($id)
{
$periodoescolaractivo=Periodohabilmatriculaonline::where('estado','1')->first();
$percount=Periodohabilmatriculaonline::where('estado','1')->count();
if($percount>0)
{
$anio=$periodoescolaractivo->anio;

$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) use ($id,$anio){
$q->where([['tb_matriculaestudiante.estudiante_id',$id],
['tb_matriculaestudiante.anio',$anio]]);}])->where('id',$id)->first();

$datosaux=$datos;
foreach ($datosaux->estudiante_seccion as $datosaux) {//para darle formato a la fecha
$formato = Carbon::createFromFormat('Y-m-d',$datosaux->pivot->f_fechamatricula);
$fecha=$formato->format('d/m/Y');
//$anio=$formato->format('Y');
$idseccion=$datosaux->pivot->seccion_id;
}

if(!isset($idseccion))//SI NO HAY MATRICULA ENTONCES NO SIGA Y MUESTRE ERROR
{
Flash::error('No se pudo generar el comprobante.')->important();
return redirect()->route('menu');
}

$seccion=Seccion::where('id','=',$idseccion)->first();
$seccion->each(function($seccion){
$seccion->seccion_turno;
$seccion->seccion_grado;
$seccion->seccion_empleado;
});

$fpdf=new Fpdf("P","mm","Letter");//L horizontal, P vertical
$fpdf->AddPage();
$fpdf->SetTitle("Matricula".$datos->v_expediente. date('_Ymd'));//nombre del archivo
$fpdf->SetFillColor(0,128,128);//DEFINE EL COLOR DE FONDO DE LAS CELDAS Q LO REQIOERA
$titulo="";
$subtitulo="";
$this->cabecera($fpdf,$titulo,$subtitulo);
$fpdf->Ln(5);
$fpdf->SetFont('Arial','B',10);
$fpdf->Cell(0, $this->height - 1, 'COMPROBANTE DE MATRICULA', 0, 1, 'C');
$fpdf->SetFont('Arial','BU',10);
$fpdf->Cell(0, $this->height - 1,utf8_decode("AÑO ACADEMICO ").$anio, 0, 1, 'C');
$fpdf->Ln(30);
//$fpdf->SetX(50);
$fpdf->SetFont('Arial', '','8');
$fpdf->Cell(60,5,"Expediente",0,0,"L");$fpdf->Cell(0,5,$datos->v_expediente,0,1,"L");
$fpdf->Cell(60,5,"Nie",0,0,"L");
if($datos->v_nie!=null) 
{$fpdf->Cell(0,5,$datos->v_nie,0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}               
$fpdf->Cell(60,5,"Nombres",0,0,"L");$fpdf->Cell(0,5,utf8_decode($datos->v_nombres),0,1,"L");
$fpdf->Cell(60,5,"Apellidos",0,0,"L");$fpdf->Cell(0,5,utf8_decode($datos->v_apellidos),0,1,"L");
$fpdf->Cell(60,5,"Fecha de matricula",0,0,"L");$fpdf->Cell(0,5,$fecha,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Presentó partida de nacimiento"),0,0,"L");
$fpdf->Cell(0,5,$datos->presentopartidaSN,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Matricula"),0,0,"L");
if($datosaux->pivot->matricula!=1) 
{$fpdf->Cell(0,5,"Repitencia",0,1,"L");}
else {$fpdf->Cell(0,5,"Inicial",0,1,"L");} 
$fpdf->Cell(60,5,utf8_decode("Presentó certificado"),0,0,"L");
if($datosaux->pivot->modalidad=='Online')
  {$fpdf->Cell(0,5,"No aplica",0,1,"L");}
  else{
$fpdf->Cell(0,5,$datosaux->pivot->v_presentocertificadoSN,0,1,"L");
}
$fpdf->Cell(60,5,"Grado",0,0,"L");$fpdf->Cell(0,5,$seccion->seccion_grado->grado,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Sección"),0,0,"L");$fpdf->Cell(0,5,utf8_decode($seccion->seccion),0,1,"L");
$fpdf->Cell(60,5,"Turno",0,0,"L");$fpdf->Cell(0,5,utf8_decode($seccion->seccion_turno->turno),0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Asesor de sección"),0,0,"L");
if($seccion->seccion_empleado!=null){
$fpdf->Cell(0,5,utf8_decode($seccion->seccion_empleado->v_nombres).' '.utf8_decode($seccion->seccion_empleado->v_apellidos),0,1,"L");
}
else
{
$fpdf->Cell(0,5,"---",0,1,"L");  
}
$fpdf->Cell(60,5,"Matriculado por",0,0,"L");
if($datosaux->pivot->modalidad=='Online')
  {$fpdf->Cell(0,5,"No aplica",0,1,"L");}
  else{
$fpdf->Cell(0,5,utf8_decode($datosaux->pivot->familiar_nombre),0,1,"L");
}
$fpdf->Cell(60,5,"Modalidad de matricula",0,0,"L");$fpdf->Cell(0,5,$datosaux->pivot->modalidad,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Transferido de otra institución"),0,0,"L");$fpdf->Cell(0,5,strtoupper($datosaux->pivot->v_trasladoSN),0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Institución de origen"),0,0,"L");
if($datosaux->pivot->v_centroescolarorigen!=null) 
{$fpdf->Cell(0,5,utf8_decode($datosaux->pivot->v_centroescolarorigen),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}
$fpdf->Cell(60,5,"Observaciones",0,0,"L");
if($datosaux->pivot->v_observaciones!=null) 
{$fpdf->Cell(0,5,utf8_decode($datosaux->pivot->v_observaciones),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}
//$fpdf->Rect(100,190,30,30,"D");
//$fpdf->Cell(80);
//$fpdf->Cell(50,50,"Firma y Sello Administración Académica",0,0,"C");
$fpdf->Cell(50);
$fpdf->Cell(20,85,utf8_decode("Firma y sello administración académica"),0,0,"C");
$fpdf->Cell(120,85,"Firma de padre/madre/responsable",0,0,"C");

$this->piedepagina($fpdf);
//$fpdf->SetTitle('comprobantematricula'.$datos->v_expediente);
$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
return $response;
}//cierro if de periodo activo
}

public function comprobantematriculapdf($idestudiante,$idmatricula,$idseccion)
{
$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoescolaractivo->anio;


$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) use ($idmatricula){
$q->where('tb_matriculaestudiante.id','=',$idmatricula);}])->where('id','=',$idestudiante)->first();
$datosaux=$datos;
foreach ($datosaux->estudiante_seccion as $datosaux) {//para darle formato a la fecha
$formato = Carbon::createFromFormat('Y-m-d',$datosaux->pivot->f_fechamatricula);
$fecha=$formato->format('d/m/Y');
//$anio=$formato->format('Y');
}
$seccion=Seccion::where([['estado','=','1'],['id','=',$idseccion]])->first();
$seccion->each(function($seccion){
$seccion->seccion_turno;
$seccion->seccion_grado;
$seccion->seccion_empleado;
});

$fpdf=new Fpdf("P","mm","Letter");//L horizontal, P vertical
$fpdf->AddPage();
$fpdf->SetTitle("Matricula".$datos->v_expediente. date('_Ymd'));//nombre del archivo
$fpdf->SetFillColor(0,128,128);//DEFINE EL COLOR DE FONDO DE LAS CELDAS Q LO REQIOERA
$titulo="";
$subtitulo="";
$this->cabecera($fpdf,$titulo,$subtitulo);
$fpdf->Ln(5);
$fpdf->SetFont('Arial','B',10);
$fpdf->Cell(0, $this->height - 1, 'COMPROBANTE DE MATRICULA', 0, 1, 'C');
$fpdf->SetFont('Arial','BU',10);
$fpdf->Cell(0, $this->height - 1,utf8_decode("AÑO ACADEMICO ").$anio, 0, 1, 'C');
$fpdf->Ln(30);
$fpdf->SetFont('Arial', '','8');
$fpdf->Cell(60,5,"Expediente",0,0,"L");$fpdf->Cell(0,5,$datos->v_expediente,0,1,"L");
$fpdf->Cell(60,5,"Nie",0,0,"L");
if($datos->v_nie!=null) 
{$fpdf->Cell(0,5,$datos->v_nie,0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}               
$fpdf->Cell(60,5,"Nombres",0,0,"L");$fpdf->Cell(0,5,utf8_decode($datos->v_nombres),0,1,"L");
$fpdf->Cell(60,5,"Apellidos",0,0,"L");$fpdf->Cell(0,5,utf8_decode($datos->v_apellidos),0,1,"L");
$fpdf->Cell(60,5,"Fecha de matricula",0,0,"L");$fpdf->Cell(0,5,$fecha,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Presentó partida de nacimiento"),0,0,"L");$fpdf->Cell(0,5,$datosaux->pivot->v_presentocertificadoSN,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Matricula"),0,0,"L");
if($datosaux->pivot->matricula!=1) 
{$fpdf->Cell(0,5,"Repitencia",0,1,"L");}
else {$fpdf->Cell(0,5,"Inicial",0,1,"L");} 
$fpdf->Cell(60,5,utf8_decode("Presentó certificado"),0,0,"L");
if($datosaux->pivot->modalidad=='Online')
  {$fpdf->Cell(0,5,"No aplica",0,1,"L");}
  else{
$fpdf->Cell(0,5,$datosaux->pivot->v_presentocertificadoSN,0,1,"L");
}
$fpdf->Cell(60,5,"Grado",0,0,"L");$fpdf->Cell(0,5,$seccion->seccion_grado->grado,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Sección"),0,0,"L");$fpdf->Cell(0,5,utf8_decode($seccion->seccion),0,1,"L");
$fpdf->Cell(60,5,"Turno",0,0,"L");$fpdf->Cell(0,5,utf8_decode($seccion->seccion_turno->turno),0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Asesor de sección"),0,0,"L");$fpdf->Cell(0,5,utf8_decode($seccion->seccion_empleado->v_nombres).' '.utf8_decode($seccion->seccion_empleado->v_apellidos),0,1,"L");
$fpdf->Cell(60,5,"Matriculado por",0,0,"L");$fpdf->Cell(0,5,utf8_decode($datosaux->pivot->familiar_nombre),0,1,"L");
$fpdf->Cell(60,5,"Modalidad de matricula",0,0,"L");$fpdf->Cell(0,5,$datosaux->pivot->modalidad,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Transferido de otra institución"),0,0,"L");$fpdf->Cell(0,5,$datosaux->pivot->v_trasladoSN,0,1,"L");
$fpdf->Cell(60,5,utf8_decode("Institución de origen"),0,0,"L");
if($datosaux->pivot->v_centroescolarorigen!=null) 
{$fpdf->Cell(0,5,utf8_decode($datosaux->pivot->v_centroescolarorigen),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}
$fpdf->Cell(60,5,"Observaciones",0,0,"L");
if($datosaux->pivot->v_observaciones!=null) 
{$fpdf->Cell(0,5,utf8_decode($datosaux->pivot->v_observaciones),0,1,"L");}
else {$fpdf->Cell(0,5,"---",0,1,"L");}
//$fpdf->Rect(40,180,30,30,"D");
$fpdf->Cell(50);
$fpdf->Cell(20,85,utf8_decode("Firma y sello administración académica"),0,0,"C");
$fpdf->Cell(120,85,"Firma de padre/madre/responsable",0,0,"C");
$this->piedepagina($fpdf);
$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
return $response;
}

var $height = 6;
function cabecera($fpdf,$titulo,$subtitulo)
{
   $centro = InfoCentroEducativo::first();

    $fpdf->Image('imagenes/recursosrpt/escudoce.jpg',10,8,20);
    $fpdf->Image('imagenes/recursosrpt/escudo.png',185,8,20);
    // Arial bold 15
    $fpdf->SetFont('Arial','',10); 
    // $fpdf->Cell(0, $this->height - 1, utf8_decode('Ministerio de Educación, Ciencia y Tecnologia'), 0, 1, 'C');
     $fpdf->Cell(0, $this->height - 1, utf8_decode('REPUBLICA DE EL SALVADOR, CENTROAMERICA'), 0, 1, 'C');
     $fpdf->Cell(0, $this->height - 1, utf8_decode('MINISTERIO DE EDUCACION CIENCIA Y TECNOLOGIA'), 0, 1, 'C');
    // $fpdf->Cell(0, $this->height - 1, utf8_decode('(MINEDUCYT)'), 0, 1, 'C');
    $fpdf->SetFont('Arial','B',12); 
    $fpdf->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
    $fpdf->SetFont('Arial','IB', 10);
    ///df->Cell(0, $this->height - 1, utf8_decode('"VEN CON NOSOSTROS A CAMINAR"'), 0, 1, 'C');
    $fpdf->SetFont('Arial','I',10);
    $fpdf->Cell(0, $this->height-2, utf8_decode($centro->v_direccion), 0, 1, 'C');    
    $fpdf->Cell(0, $this->height-2, utf8_decode('Teléfono '.$centro->v_telefono.' E-mail: '.$centro->correo_electronico), 0, 1, 'C');
    $fpdf->Cell(0, $this->height, '', 'B', 1, 'C');
}

function cabecerahorizontal($fpdf)
{
   $centro = InfoCentroEducativo::first();
    $fpdf->Image('imagenes/recursosrpt/escudoce.jpg',20,8,30);
    $fpdf->Image('imagenes/recursosrpt/escudo.png',230,8,30);
    // Arial bold 15
    $fpdf->SetFont('Arial','',10); 
      $fpdf->Cell(0, $this->height - 1, utf8_decode('REPUBLICA DE EL SALVADOR, CENTROAMERICA'), 0, 1, 'C');
     $fpdf->Cell(0, $this->height - 1, utf8_decode('MINISTERIO DE EDUCACION CIENCIA Y TECNOLOGIA'), 0, 1, 'C');
 
    $fpdf->SetFont('Arial','B',12); 
    $fpdf->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
   // $fpdf->SetFont('Arial','IB', 10);
    //$fpdf->Cell(0, $this->height - 1, utf8_decode('"VEN CON NOSOSTROS A CAMINAR"'), 0, 1, 'C');
    $fpdf->SetFont('Arial','I',10);
    $fpdf->Cell(0, $this->height-2, utf8_decode($centro->v_direccion), 0, 1, 'C');    
    $fpdf->Cell(0, $this->height-2, utf8_decode('Teléfono '.$centro->v_telefono.' E-mail: '.$centro->correo_electronico), 0, 1, 'C');
    $fpdf->Cell(0, $this->height, '', 'B', 1, 'C');
}


function piedepagina($fpdf)
{
  date_default_timezone_set('America/El_Salvador');
    // Posición: a 1,5 cm del final
$fpdf->SetY(-35);
$fpdf->SetFont('Arial','I',8);
// Número de página
$fpdf->AliasNbPages();
$time=date("d-m-Y H:i:s", time());
$fpdf->Cell(0,10,'Pag. '.$fpdf->PageNo() .' / {nb} '.$time ,0,0,'C');
//pdf->Line(10, 265, 205, 265);//parametro uno y tres punto de inicio, 3 y cuatro punto fin
//$fpdf->Cell(0,10,''. $time ,0,0,'R');
   
}

public function docentesrendimientoescolar_pdf($idseccion,$idmateria)
{
 
  //$this->SetFillColor(2,157,116);//Fondo verde de celda
  //$this->SetTextColor(240, 255, 240); //Letra color blanco
  //$bandera = false; //Para alternar el relleno

$id=$idseccion;
$seccion=Seccion::find($id);
 $sqlQuerycargaacademica = "SELECT tb_empleado.v_nombres,tb_empleado.v_apellidos, tb_asignaturas.asignatura FROM tb_asignaturas inner join tb_horario_clases inner join tb_empleado  where tb_empleado.id=tb_horario_clases.docente_id AND tb_horario_clases.seccion_id = '".$id."'  AND tb_horario_clases.asignatura_id=tb_asignaturas.id  AND  tb_horario_clases.asignatura_id = '".$idmateria."' AND tb_horario_clases.anio ='".$seccion->anio." groupBy(tb_empleado.id)'";
$docente_asignatura=DB::select( DB::raw($sqlQuerycargaacademica));
$asig=collect($docente_asignatura)->first();//convierto a coleccion
//dd($asig);
if($asig!=null){//si se imparte esa materia en el horario de clases va generar el reporte
$fpdf =new Fpdf("L","mm","Letter");
$fpdf->AddPage();
$this->cabecerahorizontal($fpdf);
$fpdf->SetTitle('rendimientoescolar');
$fpdf->Ln(2); 
$fpdf->SetFont('Arial','', 9);
$fpdf->Cell(0, $this->height - 1, "REGISTRO DE EVALUACION DEL  RENDIMIENTO ESCOLAR DE EDUCACION BASICA", 0, 1, 'C');
$fpdf->Cell(0, $this->height - 1, 'GRADO :  '.strtoupper(utf8_decode($seccion->seccion_grado->grado))."   SECCION:  ".$seccion->seccion." ", 0, 1, 'C');
$fpdf->SetFont('Arial','b', 12);
$fpdf->Cell(0, $this->height - 1,utf8_decode($asig->asignatura), 0, 1, 'C');
$fpdf->SetFont('Arial','', 8);
$fpdf->Cell(0,$this->height - 1,"RESPONSABLE ASIGNATURA:  ".utf8_decode($asig->v_nombres)." ".utf8_decode($asig->v_apellidos)."  ASESOR DE SECCION :  ".utf8_decode($seccion->seccion_empleado->v_nombres)." ".utf8_decode($seccion->seccion_empleado->v_apellidos), 0, 1, 'C');
 }//cierre if
//header TABLA
$this->headertablarendimientoescolar($fpdf);

//SACO LAS CALIFICACIONES
 //$centroEscolar = InfoCentroEducativo::first();
    //$seccion = Seccion::find($id);
   $notas   = Notas::where('seccion_id', $idseccion)->where('asignatura_id', $idmateria)->get();
   //dd($notas);
    $itemsNotas = $this->orderStudentNota($notas);
    $evaluaciones = EvaluacionesPeriodo::orderby('codigo_eval', 'asc')->get();
    $profesor = $seccion->seccion_empleado;
    $periodo = Periodoevaluacion::orderBy('nombre')->where('estado',1)->get();
    $students = DB::table('tb_expedienteestudiante')
      ->join('tb_matriculaestudiante', 'tb_matriculaestudiante.estudiante_id', '=', 'tb_expedienteestudiante.id')
      ->where('tb_matriculaestudiante.estado', 1)
      ->where('tb_matriculaestudiante.seccion_id', $id)
      ->select(
        "tb_expedienteestudiante.v_nombres",
        "tb_expedienteestudiante.v_apellidos",
        "tb_expedienteestudiante.v_nie",
        "tb_expedienteestudiante.v_expediente")
      ->orderBy('tb_expedienteestudiante.v_apellidos', 'asc')
      ->orderBy('tb_expedienteestudiante.v_nombres', 'asc')
      ->get();


     
////////////////////


    ////////////////

$response=response($fpdf->Output("s"));
$response->header('Content-Type', 'application/pdf');
return $response;


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
public function orderStudentNota($notas = array())
  {
   /* $result = array();
    foreach ($notas as $item) {
      foreach ($item->notas as $value) {
        //$result[$value->alumno->v_expediente]['notas'][$item->asignatura->asignatura][$item->evaluacion->codigo_eval] = floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);

        $result[$value->alumno->v_expediente]['notas'][$item->asignatura->asignatura][$item->periodo->descripcion][$item->evaluacion->codigo_eval] = floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);

      }
    }*/

    $result = array();
    foreach ($notas as $item) {
      foreach ($item->notas as $value) {
        foreach ($value as $periodo) {

        $result[$value->alumno->v_expediente]['notas'][$item->asignatura->asignatura][$item->periodo->descripcion][$item->evaluacion->codigo_eval] = floatval($value->calificacion) * (floatval($item->evaluacion->d_porcentajeActividad)/100);
        }
      }
    }
    return $result;
  }

public function headertablarendimientoescolar($fpdf)
{
 
$fpdf->SetXY(10,60);
$fpdf->SetFont('Arial','',10);
//$fpdf->Cell(40,10,'text to display',1,0,'C',0);
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','7');
    $fpdf->Cell(15, 15, "No", 1, 0, "C",1); 
    $fpdf->Cell(70, 15,"NOMBRE ALUMNO/A", 1, 0, "C",1); 
    $fpdf->Cell(45, 5, utf8_decode("1° PERIODO"), 1, 0, "C",1);
    $fpdf->SetXY(95,65);
    $fpdf->Cell(45, 5, utf8_decode("ACTVIDADES"), 1, 0, "C",1);
    $fpdf->SetXY(95,70); 
    $fpdf->Cell(15, 5,"1", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"2", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"3", 1, 1, "C",1);
    $fpdf->SetXY(140,60);
     $fpdf->SetFont('Arial','','5');
    $fpdf->Cell(10,15,"PROMEDIO", 1, 1, "C",1);
     $fpdf->SetFont('Arial','','7');
    $fpdf->SetXY(150,60);
    $fpdf->Cell(45, 5,utf8_decode("2° PERIODO"), 1, 0, "C",1);
    $fpdf->SetXY(150,65); 
    $fpdf->Cell(45, 5, utf8_decode("ACTVIDADES"), 1, 0, "C",1);
    $fpdf->SetXY(150,70); 
    $fpdf->Cell(15, 5,"1", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"2", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"3", 1, 1, "C",1);
    $fpdf->SetXY(195,60);
    $fpdf->SetFont('Arial','','5');
    $fpdf->Cell(10,15,"PROMEDIO", 1, 1, "C",1);
    $fpdf->SetFont('Arial','','7');
     $fpdf->SetXY(205,60);
    $fpdf->Cell(45, 5,utf8_decode("3° PERIODO"), 1, 1, "C",1);
    $fpdf->SetXY(205,65);     
    $fpdf->Cell(45, 5, utf8_decode("ACTVIDADES"), 1, 0, "C",1);
    $fpdf->SetXY(205,70); 
    $fpdf->Cell(15, 5,"1", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"2", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"3", 1, 1, "C",1);
    $fpdf->SetXY(225,60);
    $fpdf->SetFont('Arial','','5');
    $fpdf->SetXY(250,60);
    $fpdf->Cell(10,15,"PROMEDIO", 1, 1, "C",1);
    $fpdf->SetXY(260,60);
    $fpdf->Cell(10,15,utf8_decode("PROM.FINAL"), 1, 1, "C",1);

}
///////////////////////////////////////////////////////////////////////////////////////////////

  public function nominadeestudiantespdf()//vista desde donde estan los filtros de busqueda y llamo a los pdf o excel
  {
$anioslectivos=Periodoactivo::listaperiodosescolares();
return view('admin.consultasyreportes.academica.nominadeestudiantes_pdf')->with('anioslectivos',$anioslectivos);
  }

  public function headerReporte($fpdf) {
    $fpdf->SetFont('Courier', '', 12);//OBLIGATORIO DEFINIR TIPOGRAFIA
    $fpdf->SetFillColor(0,128,128);//DEFINE EL COLOR DE FONDO DE LAS CELDAS Q LO REQIOERA
    $fpdf->Cell(0, 5, "CENTRO ESCOLAR CATOLICO SAN MARIA DEL CAMINO", 1, 0, "C");
    $fpdf->Ln(10);
  }

  public function footer($fpdf)
{
      $fpdf->SetFont('Courier','',8);
    $fpdf->SetY(-20);    
    $fpdf->Write(0,'Pag.# '.$fpdf->PageNo(),0,0,'R');
}

public function footerfirmashorizontal($fpdf,$director,$asesor)
  {
    $fpdf->Ln(5);
    $fpdf->SetFont('Arial','',8);
    $fpdf->Cell(95, $this->height, "F._____________________________________", 0, 0, 'C');
    $fpdf->Cell(225, $this->height, "F._____________________________________", 0, 1, 'C');
    
    $fpdf->Cell(95, $this->height, utf8_decode(mb_strtoupper($director)), 0, 0, 'C');
    $fpdf->Cell(230, $this->height,$asesor, 0, 1, 'C');
    $fpdf->Cell(95, $this->height, "Director del Centro Escolar", 0, 0, 'C');
    $fpdf->Cell(230, $this->height, "Profesor/a encargado/a", 0, 0, 'C');
    $fpdf->Ln(5);
  }


public function docentesnominadeestudiantes_pdf($idseccion)//ver secciones
{
$id=$idseccion;
$seccion=Seccion::find($id);
$anio=$seccion->anio;
$datos=Expedienteestudiante::with(['estudiante_familiares'=>function($q) use ($anio){
$q->where('tb_estudiante_familiar.encargado','like','SI')->get();}])->whereHas('estudiante_seccion', function ($q) use ($anio,$id){
  $q->where([['tb_matriculaestudiante.anio','=',$anio],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->groupBy('id')->get();

if($seccion->seccion_empleado==null){
 $asesor="SIN ASIGNAR";
}
else{
  $asesor=strtoupper(utf8_decode($seccion->seccion_empleado->v_nombres))." ".utf8_decode(strtoupper($seccion->seccion_empleado->v_apellidos));
}
$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage();   
$this->cabecerahorizontal($fpdf);
 /*$fpdf->Ln(5);
$fpdf->SetFont('Arial','B', 9);
$fpdf->Cell(0, $this->height - 1, utf8_decode('"NOMINA DE ESTUDIANTES"'), 0, 1, 'C');
//$fpdf->SetFont('Arial','',8);
$fpdf->Cell(0, $this->height - 1, 'GRADO :  '.strtoupper($seccion->seccion_grado->grado)."   SECCION:  ".utf8_decode($seccion->seccion)."  TURNO:  ".utf8_decode($seccion->seccion_turno->turno), 0, 1, 'C');*/

$fpdf->Ln(2);
$fpdf->SetFont('Helvetica','BU', 12);
$fpdf->Cell(0, $this->height - 1, utf8_decode('NOMINA DE ESTUDIANTES'), 0, 1, 'C');
$fpdf->Ln(2);
$fpdf->SetFont('Arial','',10);


$fpdf->Cell(14, $this->height - 1, 'Grado: ', 0, 0, 'R');
$fpdf->Cell(80, $this->height +1,utf8_decode($seccion->seccion_grado->grado), 'B');

$fpdf->Cell(15, $this->height - 1, utf8_decode('Sección: '), 0, 0, 'R');
$fpdf->Cell(56, $this->height +1,utf8_decode($seccion->seccion), 'B');

$fpdf->Cell(15, $this->height - 1, utf8_decode('Turno: '), 0, 0, 'R');
$fpdf->Cell(80, $this->height +1,utf8_decode($seccion->seccion_turno->turno), 'B');

$fpdf->Ln(5);


//header tabla
    $fpdf->Ln(5);
     $fpdf->SetFillColor(0,0,0);
     $fpdf->SetTextColor(240, 255, 240);   
    $fpdf->SetFont('Arial','B','8');
    $fpdf->Cell(10, 5, "No.", 1, 0, "C",1); 
    $fpdf->Cell(20, 5,"Nie", 1, 0, "C",1); 
    $fpdf->Cell(40, 5,"Apellidos", 1, 0, "C",1);
    $fpdf->Cell(40, 5, "Nombres", 1, 0, "C",1);
    $fpdf->Cell(30, 5,"Fecha de nacimiento", 1, 0, "C",1);
    $fpdf->Cell(15, 5, "Sexo", 1, 0, "C",1);
    $fpdf->Cell(50, 5,"Nombre del responsable", 1, 0, "C",1);
     $fpdf->Cell(30, 5,"Parentesco", 1, 0, "C",1);
    $fpdf->Cell(25, 5,utf8_decode("Teléfono"), 1, 1, "C",1);
$fpdf->SetFont('Arial', '', 7);
$fpdf->SetTextColor(3, 3, 3);

//dd($datos);
if(count($datos)>0)
{
$i=0;
    foreach($datos as $estudiante)
    {
    foreach($estudiante->estudiante_familiares as $familiar)
      {
       $i++;
    $fpdf->SetFillColor( ($i % 2 == 0 ) ? 120 : 190 );
    $fpdf->Cell(10, 5, $i, 1, 0, "C",1); 
    if($estudiante->v_nie!=null){ $fpdf->Cell(20, 5,utf8_decode($estudiante->v_nie), 1, 0, "C",0);}else{$fpdf->Cell(20, 5,"---", 1, 0, "C",0);}
   
     
    $fpdf->Cell(40, 5,utf8_decode($estudiante->v_apellidos), 1, 0, "L",0);
    $fpdf->Cell(40, 5, utf8_decode($estudiante->v_nombres), 1, 0, "L",0);
    $formato = Carbon::createFromFormat('Y-m-d',$estudiante->f_fnacimiento);
    $estudiante->f_fnacimiento = $formato->format('d/m/Y');
    $fpdf->Cell(30, 5,$estudiante->f_fnacimiento, 1, 0, "C",0);
    if($estudiante->v_genero=="Femenino")
      {$fpdf->Cell(15, 5, utf8_decode("F"), 1, 0, "C",0);}
      else{$fpdf->Cell(15, 5, utf8_decode("M"), 1, 0, "C",0);}    
    $fpdf->Cell(45, 5,utf8_decode($familiar->nombres)." ".utf8_decode($familiar->apellidos), 1, 0, "L",0);
    $fpdf->Cell(35, 5,utf8_decode($familiar->pivot->parentesco), 1, 0, "C",0);

    if($familiar->celular!=null)
      { $fpdf->Cell(25, 5,utf8_decode($familiar->celular), 1, 1, "C",0);}
    else{$fpdf->Cell(25, 5,"---", 1, 1, "C",0);}
    }
}
}//cierro if
else
{
 $fpdf->Cell(0, 5, utf8_decode("No hay información para mostrar."), 1, 0, "C",0);  
}

$director=InfoCentroEducativo::first();
$director=$director->nombre_director_ar;
$this->footerfirmashorizontal($fpdf,$director,$asesor);
$this->piedepagina($fpdf);

    $response = response($fpdf->Output("s"));
    $response->header('Content-Type', 'application/pdf');
    return $response;

}

  public function nominadeestudiantes_pdf(
    Request $request
    // \Codedge\Fpdf\Fpdf\Fpdf $pdf
  )
  {
   // dd($requ);
$id=$request->seccion_id;
$seccion=Seccion::find($id);
$anio=Periodoactivo::find($request->periodo_id);//uso el scope para sacar el periodo activo
$anio=$seccion->anio;
/*$datos=Expedienteestudiante::with(['estudiante_familiares'=>function($q) use ($anio){
$q->with('parentesco')->where('tb_familiares.encargado','like','SI')->get();}])->whereHas('estudiante_seccion', function ($q) use ($anio,$id){
  $q->where([['tb_matriculaestudiante.anio','=',$anio],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->groupBy('id')->get();
*/

$datos=Expedienteestudiante::with(['estudiante_familiares'=>function($q) use ($anio){
$q->where('tb_estudiante_familiar.encargado','like','SI')->get();
}])->whereHas('estudiante_seccion', function ($q) use ($anio,$id){
  $q->where([['tb_matriculaestudiante.anio','=',$anio],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->groupBy('id')->get();
 //dd($datos);
//no tiene que estar amarrado a que el estado de la matricula sea 1 y tamppoco debe condicionarse a que el estudiante este activo ya que el filtro incluye elegir un ciclo lectivo lo que significa que puede buscar informacion de años anteriores y puede ser que el estudiante este desactivado a esa fecha o que la matricula tambian haya sido desactivada

if($seccion->seccion_empleado==null){
 $asesor="SIN ASIGNAR";
}
else{
  $asesor=utf8_decode(mb_strtoupper($seccion->seccion_empleado->v_nombres))." ".utf8_decode(mb_strtoupper($seccion->seccion_empleado->v_apellidos));
}
date_default_timezone_set('America/El_Salvador');
$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage();   
$this->cabecerahorizontal($fpdf);
$fpdf->Ln(2);
$fpdf->SetFont('Helvetica','BU', 12);
$fpdf->Cell(0, $this->height - 1, utf8_decode('NOMINA DE ESTUDIANTES'), 0, 1, 'C');
$fpdf->Ln(2);
$fpdf->SetFont('Arial','',10);


$fpdf->Cell(14, $this->height - 1, 'Grado: ', 0, 0, 'R');
$fpdf->Cell(80, $this->height +1,utf8_decode($seccion->seccion_grado->grado), 'B');

$fpdf->Cell(15, $this->height - 1, utf8_decode('Sección: '), 0, 0, 'R');
$fpdf->Cell(56, $this->height +1,utf8_decode($seccion->seccion), 'B');

$fpdf->Cell(15, $this->height - 1, utf8_decode('Turno: '), 0, 0, 'R');
$fpdf->Cell(80, $this->height +1,utf8_decode($seccion->seccion_turno->turno), 'B');

$fpdf->Ln(5);

//$fpdf->Cell(0, $this->height - 1, 'GRADO :  '.utf8_decode($seccion->seccion_grado->grado)."   SECCION:  ".utf8_decode($seccion->seccion)."    TURNO:  ".utf8_decode($seccion->seccion_turno->turno), 0, 1, 'C');
//$fpdf->Cell(0, $this->height - 1, 'GRADO :  '.utf8_decode($seccion->seccion_grado->grado)."   SECCION:  ".utf8_decode($seccion->seccion)."           DOCENTE ASESOR :  ".$asesor, 0, 1, 'C');
//header tabla

    $fpdf->Ln(5);
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFillColor(0,0,0);
     $fpdf->SetTextColor(240, 255, 240);   
    $fpdf->SetFont('Arial','B','8');
    $fpdf->Cell(10, 5, "No.", 1, 0, "C",1); 
    $fpdf->Cell(20, 5,"Nie", 1, 0, "C",1); 
    $fpdf->Cell(40, 5,"Apellidos", 1, 0, "C",1);
    $fpdf->Cell(40, 5, "Nombres", 1, 0, "C",1);
    $fpdf->Cell(30, 5,"Fecha de nacimiento", 1, 0, "C",1);
    $fpdf->Cell(15, 5, "Sexo", 1, 0, "C",1);
    $fpdf->Cell(55, 5,"Nombre del responsable", 1, 0, "C",1);
     $fpdf->Cell(25, 5,"Parentesco", 1, 0, "C",1);
    $fpdf->Cell(25, 5,utf8_decode("Teléfono"), 1, 1, "C",1);
$fpdf->SetFont('Arial', '', 8);
$fpdf->SetTextColor(3, 3, 3);
if(count($datos)>0)
{
$i=0;
    foreach($datos as $estudiante)
    {
    foreach($estudiante->estudiante_familiares as $familiar)
      {
       $i++;

   $fpdf->SetFillColor( ($i % 2 == 0 ) ? 120 : 190 );

    $fpdf->Cell(10, 5, $i, 1, 0, "C",1); 
    if($estudiante->v_nie!=null){ $fpdf->Cell(20, 5,utf8_decode($estudiante->v_nie), 1, 0, "C",0);}else{$fpdf->Cell(20, 5,"---", 1, 0, "C",0);}
   $fpdf->Cell(40, 5,utf8_decode($estudiante->v_apellidos), 1, 0, "J",0);
    $fpdf->Cell(40, 5, utf8_decode($estudiante->v_nombres), 1, 0, "J",0); 


 $formato = Carbon::createFromFormat('Y-m-d',$estudiante->f_fnacimiento);
 $estudiante->f_fnacimiento = $formato->format('d/m/Y');

    $fpdf->Cell(30, 5,$estudiante->f_fnacimiento, 1, 0, "C",0);
    if($estudiante->v_genero=="Femenino")
      {$fpdf->Cell(15, 5, utf8_decode("F"), 1, 0, "C",0);}
      else{$fpdf->Cell(15, 5, utf8_decode("M"), 1, 0, "C",0);}    
     $fpdf->Cell(55, 5,utf8_decode($familiar->nombres)." ".utf8_decode($familiar->apellidos), 1, 0, "J",0);
    $fpdf->Cell(25, 5,utf8_decode($familiar->pivot->parentesco), 1, 0, "C",0);

    if($familiar->celular!=null)
      { $fpdf->Cell(25, 5,utf8_decode($familiar->celular), 1, 1, "C",0);}
    else{$fpdf->Cell(25, 5,"---", 1, 1, "C",0);}
    }
}
}//cierro if
else
{
  $fpdf->Cell(0, 5,utf8_decode("No hay información para mostrar"), 1, 1, "C",0);
}

$director=InfoCentroEducativo::first();
$director=$director->nombre_director_ar;
$this->footerfirmashorizontal($fpdf,$director,$asesor);
$this->piedepagina($fpdf);
    $response = response($fpdf->Output("s"));
    $response->header('Content-Type', 'application/pdf');
    return $response;
}


public function nominadepadresdefamilia_pdf(
    Request $request
    // \Codedge\Fpdf\Fpdf\Fpdf $pdf
  )
  {
$id=$request->seccion_id;
$seccion=Seccion::find($id);
$anio=Periodoactivo::find($request->periodo_id);
$anio=$anio->anio;

 // dd('aca');
$datos=Expedienteestudiante::with(['estudiante_familiares'=>function($q){
$q->where('tb_familiares.estado',1)->get();}])->whereHas('estudiante_seccion', function ($q) use ($anio,$id){
  $q->where([['tb_matriculaestudiante.anio','=',$anio],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$id]]);
})->get();


if($seccion->seccion_empleado==null){
 $asesor="SIN ASIGNAR";
}
else{
  $asesor=utf8_decode(mb_strtoupper($seccion->seccion_empleado->v_nombres))." ".utf8_decode(mb_strtoupper($seccion->seccion_empleado->v_apellidos));
}

$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage();   
$this->cabecerahorizontal($fpdf);
 $fpdf->Ln(5);
$fpdf->SetFont('Helvetica','BU', 12);
$fpdf->Cell(0, $this->height - 1, utf8_decode('NOMINA DE PADRES DE FAMILIA'), 0, 1, 'C');
$fpdf->SetFont('Arial','',10);
//$fpdf->Cell(0, $this->height - 1,'GRADO :  '.$seccion->seccion_grado->grado."   SECCION:  ".$seccion->seccion."  TURNO :  ".utf8_decode(mb_strtoupper($seccion->seccion_turno->turno)), 0, 1, 'C');

$fpdf->Ln(2);
$fpdf->Cell(14, $this->height - 1, 'Grado: ', 0, 0, 'R');
$fpdf->Cell(80, $this->height +1,utf8_decode($seccion->seccion_grado->grado), 'B');

$fpdf->Cell(15, $this->height - 1, utf8_decode('Sección: '), 0, 0, 'R');
$fpdf->Cell(56, $this->height +1,utf8_decode($seccion->seccion), 'B');
$fpdf->Cell(15, $this->height - 1, utf8_decode('Turno: '), 0, 0, 'R');
$fpdf->Cell(80, $this->height +1,utf8_decode($seccion->seccion_turno->turno), 'B');

$fpdf->Ln(5);
//header tabla
    $fpdf->Ln(5);
    $fpdf->SetFillColor(0,0,0);
    $fpdf->SetTextColor(240, 255, 240); //texto color blanco
    $fpdf->SetFont('Arial','B','9');
    $fpdf->Cell(10, 5,"No.", 1, 0, "C",1); 
    $fpdf->Cell(20, 5,"Dui", 1, 0, "C",1);
    $fpdf->Cell(75, 5, "Nombre del familiar", 1, 0, "C",1); 
   // $fpdf->Cell(40, 5,"APELLIDOS", 1, 0, "C",1);
   // $fpdf->Cell(20, 5,"FECHA NAC.", 1, 0, "C",1);
    $fpdf->Cell(25, 5, "Parentesco", 1, 0, "C",1);
    $fpdf->Cell(30, 5,utf8_decode("Teléfono casa"), 1, 0, "C",1);
    $fpdf->Cell(30, 5,"Celular", 1, 0, "C",1);
    $fpdf->Cell(70, 5,"Nombre del estudiante", 1, 1, "C",1);
$fpdf->SetFont('Arial', '', 9);
$fpdf->SetTextColor(3, 3, 3);//texto color negro
if(count($datos)>0)
{
$i=0;
    foreach($datos as $estudiante)
    {  
      foreach($estudiante->estudiante_familiares as $familiar)
      {
       $i++;
$fpdf->SetFillColor( ($i % 2 == 0 ) ? 120 : 190 );      
$fpdf->Cell(10, 5, $i, 1, 0, "C",1);
if($familiar->dui!=null)
  { $fpdf->Cell(20, 5,utf8_decode($familiar->dui), 1, 0, "C",0);}
else{$fpdf->Cell(20, 5,"---", 1, 0, "C",0);}
$fpdf->Cell(75, 5,utf8_decode($familiar->apellidos)." ".utf8_decode($familiar->nombres), 1, 0, "L",0);
//$fpdf->Cell(40, 5,utf8_decode($familiar->apellidos), 1, 0, "L",0);
/*if($familiar->fechanacimiento==null){$fpdf->Cell(20, 5,"---", 1, 0, "C",0);}else{
$fpdf->Cell(20, 5,$familiar->fechanacimiento, 1, 0, "C",0);}*/

$fpdf->Cell(25, 5,utf8_decode($familiar->pivot->parentesco), 1, 0, "C",0);
if($familiar->telefonocasa!=null){ $fpdf->Cell(30, 5,utf8_decode($familiar->telefonocasa), 1, 0, "C",0);}else{$fpdf->Cell(30, 5,"---", 1, 0, "C",0);} 
if($familiar->celular!=null){ $fpdf->Cell(30, 5,utf8_decode($familiar->celular), 1, 0, "C",0);}else{$fpdf->Cell(30, 5,"---", 1, 0, "C",0);}  
$fpdf->Cell(70, 5, utf8_decode($estudiante->v_nombres)." ".utf8_decode($estudiante->v_apellidos), 1, 1, "L",0); 
        }
}
}//if
else
{
  $fpdf->Cell(0, 5,utf8_decode("No hay información para mostrar"), 1, 1, "C",0);
}

$director=InfoCentroEducativo::first();
$director=$director->nombre_director_ar;
$this->footerfirmashorizontal($fpdf,$director,$asesor);
$this->piedepagina($fpdf);

    $response = response($fpdf->Output("s"));
    $response->header('Content-Type', 'application/pdf');
    return $response;
  }

public function nominaestudiantesactivosCE_pdf()
{
$datos=Expedienteestudiante::orderBy('v_apellidos','ASC')->where('estado',1)->get();
//
$anio = Carbon::create()->year;
$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage();   
$this->cabecerahorizontal($fpdf);
$fpdf->Ln(5);
$fpdf->SetFont('Arial','B', 9);
$fpdf->Cell(0, $this->height - 1, utf8_decode('NOMINA DE ESTUDIANTES ACTIVOS'), 0, 1, 'C');
$fpdf->Cell(0, $this->height - 1, utf8_decode('AÑO ESCOLAR '.$anio ), 0, 1, 'C');
//header tabla
    $fpdf->Ln(5);
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','8');
    $fpdf->Cell(10, 5, "No.", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"EXPEDIENTE", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"NIE", 1, 0, "C",1);     
    $fpdf->Cell(45, 5,"APELLIDOS", 1, 0, "C",1);
    $fpdf->Cell(45, 5,"NOMBRES", 1, 0, "C",1);
    $fpdf->Cell(15, 5, "SEXO", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"FECHA NAC.", 1, 0, "C",1);
     $fpdf->Cell(80, 5,"DIRECCION", 1, 1, "C",1);
$fpdf->SetFont('Arial', '', 7);
if(count($datos)>0)
{
$i=0;
    foreach($datos as $estudiante)
    {    
    $i++;
    $fpdf->Cell(10, 5, $i, 1, 0, "C",0); 
    $fpdf->Cell(20, 5, utf8_decode($estudiante->v_expediente), 1, 0, "C",0);
     if($estudiante->v_nie!=null)
      {$fpdf->Cell(20, 5,$estudiante->v_nie, 1, 0, "C",0);}
      else{$fpdf->Cell(20, 5,"---", 1, 0, "C",0);}  
    $fpdf->Cell(45, 5,utf8_decode($estudiante->v_apellidos), 1, 0, "L",0); 
    $fpdf->Cell(45, 5, utf8_decode($estudiante->v_nombres), 1, 0, "L",0);
        
    if($estudiante->v_genero=="Femenino")
      {$fpdf->Cell(15, 5, utf8_decode("F"), 1, 0, "C",0);}
      else{$fpdf->Cell(15, 5, utf8_decode("M"), 1, 0, "C",0);} 
      $fpdf->Cell(20, 5,"10-10-2019", 1, 0, "C",0);   
    $fpdf->Cell(80, 5,utf8_decode($estudiante->v_direccion), 1, 1, "L",0); 
}
}
else
{
  $fpdf->Cell(0, 5,utf8_decode("No hay información para mostrar"), 1, 1, "C",0);
}

 $this->piedepagina($fpdf);
    $response = response($fpdf->Output("s"));
    $response->header('Content-Type', 'application/pdf');
    return $response;
}

public function nominafamiliaresactivosCE_pdf()
{
$anio=Carbon::today()->year;
$datos=Expedienteestudiante::with(['estudiante_familiares'=>function($q) use ($anio){
$q->where('tb_estudiante_familiar.encargado','like','SI')->get();}])->where('estado',1)->get();
//dd($datos);
$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage();   
$this->cabecerahorizontal($fpdf);
 $fpdf->Ln(5);
$fpdf->SetFont('Arial','B', 10);
$fpdf->Cell(0, $this->height - 1, utf8_decode('NOMINA DE PADRES DE FAMILIA'), 0, 1, 'C');
//$fpdf->SetFont('Arial','',8);
$fpdf->Cell(0, $this->height - 1,utf8_decode('AÑO: '.$anio), 0, 1, 'C');
//header tabla
    $fpdf->Ln(5);
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','8');
    $fpdf->Cell(10, 5,"No.", 1, 0, "C",1); 
    $fpdf->Cell(20, 5,"DUI", 1, 0, "C",1);
    $fpdf->Cell(80, 5, "NOMBRE DEL FAMILIAR", 1, 0, "C",1); 
   // $fpdf->Cell(40, 5,"APELLIDOS", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"FECHA NAC.", 1, 0, "C",1);
    $fpdf->Cell(25, 5, "PARENTESCO", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"TEL. CASA", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"CELULAR", 1, 0, "C",1);
    $fpdf->Cell(65, 5,"NOMBRE DEL ESTUDIANTE", 1, 1, "C",1);
$fpdf->SetFont('Arial', '', 7);
if(count($datos)>0)
{
$i=0;
    foreach($datos as $estudiante)
    {  
      foreach($estudiante->estudiante_familiares as $familiar)
      {
       $i++;
$fpdf->Cell(10, 5, $i, 1, 0, "C",0);
if($familiar->dui!=null)
  { $fpdf->Cell(20, 5,utf8_decode($familiar->dui), 1, 0, "C",0);}
else{$fpdf->Cell(20, 5,"---", 1, 0, "C",0);}
$fpdf->Cell(80, 5,utf8_decode($familiar->nombres).' '.utf8_decode($familiar->apellidos), 1, 0, "L",0);
//$fpdf->Cell(40, 5,utf8_decode($familiar->apellidos), 1, 0, "C",0);
$fpdf->Cell(20, 5,$familiar->fechanacimiento, 1, 0, "C",0);
$fpdf->Cell(25, 5,utf8_decode($familiar->pivot->parentesco), 1, 0, "C",0);
if($familiar->telefonocasa!=null){ $fpdf->Cell(20, 5,utf8_decode($familiar->telefonocasa), 1, 0, "C",0);}else{$fpdf->Cell(20, 5,"---", 1, 0, "C",0);} 
if($familiar->celular!=null){ $fpdf->Cell(20, 5,utf8_decode($familiar->celular), 1, 0, "C",0);}else{$fpdf->Cell(20, 5,"---", 1, 0, "C",0);}  
$fpdf->Cell(65, 5, utf8_decode($estudiante->v_nombres)." ".utf8_decode($estudiante->v_apellidos), 1, 1, "L",0); 
        }
}

}
else
{
  $fpdf->Cell(0, 5,utf8_decode("No hay información para mostrar"), 1, 1, "C",0);
}
 $this->piedepagina($fpdf);
    $response = response($fpdf->Output("s"));
    $response->header('Content-Type', 'application/pdf');
    return $response;
}


  /*
    
  $datos=Expedienteestudiante::with('estudiante_seccion')->whereHas('estudiante_seccion',function($q) use ($seccion){
  $q->where([['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$seccion]]);})->get();
$vistaurl = 'admin.consultasyreportes.academica.pdf_nominaestudiantes';//define el archivo que debe abrir para generar el pdf
//verificamos que tipo de repprte quiere si 1.PDF o en 2.EXCEL
 // llamada a la función que genera el PDF 
//return $this->crearPDF($datos, $vistaurl,'NominaEstudiantes_');
if($request->formatoreporte==1)//es PDF
{
return $this->crearPDF($datos, $vistaurl,'NominaEstudiantes_');
}
else if($request->formatoreporte==2)//es EXCEL
{
  dd('EXCEL');
  //llamar a excel
}
  */

public function expedienteestudiante_pdf($id)
{

$estudiante=Expedienteestudiante::find($id);
$user=Usuario::where('estudiante_id','=',$id)->first();
$familiares=Expedienteestudiante::with('estudiante_familiares')->whereHas('estudiante_familiares')->where('id','=',$id)->get();//obtengo la informacion de los familiares que estan relaciondos con ese estudiante en particular
$datosmedicos=$estudiante->estudiante_datosmedicos()->first();
    $formato = Carbon::createFromFormat('Y-m-d',$estudiante->f_fnacimiento);
    $edad=Carbon::parse($formato)->age;
    $estudiante->f_fnacimiento = $formato->format('d/m/Y');
    if($estudiante->f_fechaIngresoCE!=null){
    $formato2 = Carbon::createFromFormat('Y-m-d',$estudiante->f_fechaIngresoCE);
    $estudiante->f_fechaIngresoCE=$formato2->format('d/m/Y');}
    $estudiante->each(function($estudiante){$estudiante->municipio;});
    $dept = Departamentos::orderBy('v_departamento','ASC')->where('id','=',$estudiante->municipio->departamento_id)->first(); 

    $anios=Periodoactivo::where('tipo_periodo','ACADEMICO')->get();
$grados=array();
foreach ($anios as $key => $value) {
  $query="SELECT  s.anio,s.descripcion,e.v_nombres,e.v_apellidos,cfn.promovido from tb_secciones as s inner join tb_empleado as e  on s.empleado_id=e.id inner join cuadro_final as cf on s.id=cf.seccion_id inner join cuadro_final_notas as cfn on cf.id=cfn.cuadro_final_id and cfn.alumno_id={$id} inner join tb_matriculaestudiante as mt on s.id=mt.seccion_id where mt.anio={$value->anio} and mt.estudiante_id={$id}";

  $historial=DB::select($query);
  if(count($historial)>0)
    {
      //$historial=collect($historial);
      array_push($grados,$historial);
    }

}

$faltas=Faltasestudiantes::orderBy('fecha')->where('estudiante_id',$id)->get();
foreach($faltas as $f)
      {
 $formato = Carbon::createFromFormat('Y-m-d',$f->fecha);
 $f->fecha = $formato->format('d/m/Y');
 #$f->fecha = $formato->toFormattedDateString();
      }


$fpdf=new Fpdf("P","mm","Letter");
$fpdf->AddPage();
$fpdf->SetFont('Arial','', 12);//OBLIGATORIO DEFINIR TIPOGRAFIA
$fpdf->SetFillColor(0,128,128);//DEFINE EL COLOR DE FONDO DE LAS CELDAS Q LO REQIOERA
$fpdf->SetDrawColor(209,209,209);//color para formas
$titulo="";
$subtitulo="";
$this->cabecera($fpdf,$titulo,$subtitulo);
  $fpdf->Ln(5);
   $fpdf->SetTextColor(75,75,75);
   $fpdf->SetFont('Arial','B',12);
   $fpdf->Cell(0, $this->height - 1, 'ADMINISTRACION ACADEMICA', 0, 1, 'C');
   $fpdf->SetFont('Arial','BU',12);
   $fpdf->Cell(0, $this->height - 1, 'EXPEDIENTE ESTUDIANTIL', 0, 1, 'C');
    $fpdf->Image('imagenes/Administracionacademica/Estudiantes/'.$user->foto,20,60,50);


 $fpdf->SetFillColor(229,229,229);
 $fpdf->SetXY(80,70);
   $fpdf->SetFont('Arial','B',12);
  $fpdf->Cell(50, $this->height - 1,"Expediente: ",1, 0, "L", 1); 
    $fpdf->SetFont('Arial','',12);
  $fpdf->Cell(0, 5, $estudiante->v_expediente, 1, 1, "L",1);
$fpdf->SetXY(80,75);
  $fpdf->SetFont('Arial','B',12);
  $fpdf->Cell(50, $this->height - 1,"NIE: ", 1, 0, "L", 0);
   $fpdf->SetFont('Arial','',12);
    if($estudiante->v_nie!=null)
  {$fpdf->Cell(0, $this->height - 1, $estudiante->v_nie, 1,0, "L",0); }
    else {$fpdf->Cell(0,$this->height - 1,"---",1,1,"L",0);}  
$fpdf->SetFont('Arial','B',12);
 $fpdf->SetXY(80,80);
 $fpdf->Cell(50, $this->height - 1,"Nombres: ",1, 0, "L", 1);
  $fpdf->SetFont('Arial','',12);
  $fpdf->Cell(0, $this->height - 1, utf8_decode($estudiante->v_nombres), 1,0, "L", 1); 
  $fpdf->SetXY(80,85);
    $fpdf->SetFont('Arial','B',12);
  $fpdf->Cell(50, $this->height - 1,"Apellidos: ", 1, 0, "L", 0); 
  $fpdf->SetFont('Arial','',12);
  $fpdf->Cell(0, $this->height - 1, utf8_decode($estudiante->v_apellidos), 1, 0, "L", 0);
  $fpdf->SetXY(80,90);
  $fpdf->SetFont('Arial','B',12);
  $fpdf->Cell(50, $this->height - 1,"Fecha de nacimiento: ", 1, 0, "L", 1); 
  $fpdf->SetFont('Arial','',12);
  $fpdf->Cell(0, $this->height - 1, $estudiante->f_fnacimiento, 1, 0, "L", 1); 
  $fpdf->SetXY(80,95);
   $fpdf->SetFont('Arial','B',12);
  $fpdf->Cell(50, $this->height - 1,utf8_decode('Género'), 1, 0, "L",0); 
  $fpdf->SetFont('Arial','',12);$fpdf->Cell(0, 5, $estudiante->v_genero, 1, 1, "L", 0); 

    $fpdf->Ln(30);
$fpdf->SetFillColor(100,107,99);
    $fpdf->SetFont('Arial','BU',12);
    $fpdf->Cell(0, $this->height - 1,utf8_decode('1.INFORMACION PERSONAL'), 0, 1, "C", 0);   $fpdf->Ln(5);
$fpdf->SetX(20);
$fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','',12);



     /*$fpdf->Cell(80, $this->height - 1,"Expediente",1, 0, "L", 1); $fpdf->Cell(0, 5, $estudiante->v_expediente, 1, 1, "L",0);
   $fpdf->SetX(20);$fpdf->Cell(80, $this->height - 1,"NIE", 1, 0, "L", 1);
    if($estudiante->v_nie!=null) {$fpdf->Cell(0, 5, $estudiante->v_nie, 1, 1, "L", 0); }
    else {$fpdf->Cell(0,5,"---",1,1,"L");}    
    $fpdf->SetX(20);$fpdf->Cell(80, $this->height - 1,"Nombres", 0, 0, "L", 0); $fpdf->Cell(0, 5, utf8_decode($estudiante->v_nombres), 0, 1, "L", 0); 
    $fpdf->SetX(20);$fpdf->Cell(80, $this->height - 1,"Apellidos", 0, 0, "L", 0); $fpdf->Cell(0, 5, utf8_decode($estudiante->v_apellidos), 0, 1, "L", 0); 
    $fpdf->SetX(20);$fpdf->Cell(80, $this->height - 1,utf8_decode('Género'), 0, 0, "L", 0); $fpdf->Cell(0, 5, $estudiante->v_genero, 0, 1, "L", 0); 
   $fpdf->SetX(20); $fpdf->Cell(80, $this->height - 1,"Fecha de nacimiento", 0, 0, "L", 0); $fpdf->Cell(0, 5, $estudiante->f_fnacimiento, 0, 1, "L", 0); 
*/


   $fpdf->SetX(20); $fpdf->Cell(90, $this->height - 1,utf8_decode("Dirección"), 0, 0, "L", 1);
    $fpdf->Cell(0, 5,utf8_decode($estudiante->v_direccion), 0, 1, "L", 0);
   $fpdf->SetX(20); $fpdf->Cell(90, $this->height - 1,"Departamento", 0, 0, "L", 1); $fpdf->Cell(0, 5,utf8_decode($dept->v_departamento), 0, 1, "L", 0); 
   $fpdf->SetX(20); $fpdf->Cell(90, $this->height - 1,"Municipio", 0, 0, "L", 1); $fpdf->Cell(0, 5, utf8_decode($estudiante->municipio->v_municipio), 0, 1, "L", 0); 
   $fpdf->SetX(20); $fpdf->Cell(90, $this->height - 1,utf8_decode("Teléfono de residencia"), 0, 0, "L", 1); 
    if($estudiante->v_telCasa!=null) { $fpdf->Cell(0, 5,$estudiante->v_telCasa, 0, 1, "L", 0);}
    else {$fpdf->Cell(0,$this->height - 1,"---",0,1,"L");}     
  $fpdf->SetX(20);  $fpdf->Cell(90, $this->height - 1,utf8_decode("Teléfono celular"), 0, 0, "L", 1);
  if($estudiante->v_telCelular!=null) {$fpdf->Cell(0, 5,$estudiante->v_telCelular, 0, 1, "L", 0);}
    else {$fpdf->Cell(0,$this->height - 1,"---",0,1,"L");}
  $fpdf->SetX(20);  $fpdf->Cell(90, $this->height - 1,utf8_decode("Correo electrónico"), 0, 0, "L", 1);
  if($estudiante->v_correo!=null) {   $fpdf->Cell(0, 5,utf8_decode($estudiante->v_correo), 0, 1, "L", 0);}
    else {$fpdf->Cell(0,$this->height - 1,"---",0,1,"L");} 
    $fpdf->Ln(10);
    $fpdf->SetFont('Arial','BU',12);
    $fpdf->Cell(0, $this->height - 1,utf8_decode("2. SITUACION FAMILIAR"), 0, 1, "C", 0);
    $fpdf->Ln(5);

      $fpdf->SetFont('Arial','',12);
      $fpdf->SetX(20);
$fpdf->Cell(90, $this->height - 1,"Miembros del circulo familiar", 0, 0, "L", 1);
if($estudiante->i_catFamiliares!=null) {  
 $fpdf->Cell(0, $this->height - 1,$estudiante->i_catFamiliares, 0, 1, "L", 0);}
    else {$fpdf->Cell(0,$this->height - 1,"---",0,1,"L");}
   $fpdf->SetX(20); $fpdf->Cell(90, $this->height - 1,"Convive con", 0, 0, "L", 1); $fpdf->Cell(0, 5,$estudiante->v_viveCon, 0, 1, "L", 0); 
  $fpdf->SetX(20);  $fpdf->Cell(90, $this->height - 1,"Economicamente depende de", 0, 0, "L",1); $fpdf->Cell(0, 5,$estudiante->v_dependeDe, 0, 1, "L", 0); 

    $fpdf->Ln(10); 
    $fpdf->SetFont('Arial','BU',12);
    $fpdf->Cell(0, $this->height - 1,utf8_decode("3. SITUACION ECLESIAL"), 0, 1, "C", 0); 
    $fpdf->Ln(5);
    $fpdf->SetFont('Arial','',12);
     $fpdf->SetX(20);$fpdf->Cell(90, $this->height - 1,"Sacramentos recibidos", 0, 0, "L", 1);
    $fpdf->Cell(0, $this->height - 1,utf8_decode($estudiante->sacramentos), 0, 1, "L", 0); 
    $fpdf->SetTitle($estudiante->v_expediente. date('_Ymd'));//nombre del archivo
   
    $fpdf->Ln(30);
    $fpdf->SetFont('Arial','BU',12);
    $fpdf->Cell(0, $this->height - 1,utf8_decode("4. DATOS DE INGRESO"), 0, 1, "C", 0);
    $fpdf->Ln(5);

    $fpdf->SetFont('Arial','',12);
     $fpdf->SetX(20);$fpdf->Cell(90, $this->height - 1,"Fecha de ingreso al Centro Escolar", 0, 0, "L", 1); 
    if($estudiante->f_fechaIngresoCE!=null){
    $fpdf->Cell(0, $this->height - 1,$estudiante->f_fechaIngresoCE, 0, 1, "L", 0);}
    else{$fpdf->Cell(0, $this->height - 1,"---", 0, 1, "L", 0);} 

     $fpdf->SetX(20);$fpdf->Cell(90, $this->height - 1,"Nivel", 0, 0, "L", 1);
    $fpdf->Cell(0, $this->height - 1,utf8_decode($estudiante->v_nivelingreso), 0, 1, "L", 0);
    $fpdf->SetX(20); $fpdf->Cell(90, $this->height - 1,"Ciclo", 0, 0, "L", 1);
    $fpdf->Cell(0, $this->height - 1,utf8_decode($estudiante->v_cicloingreso), 0, 1, "L", 0);
     $fpdf->SetX(20);$fpdf->Cell(90, 5,"Modalidad Educativa", 0, 0, "L", 1);
    $fpdf->Cell(0, 5,utf8_decode($estudiante->v_modalidadeducativaingreso), 0, 1, "L", 0);
     $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Modalidad de Atención"), 0, 0, "L", 1);
    $fpdf->Cell(0, 5,utf8_decode($estudiante->v_modalidadatencioningreso), 0, 1, "L", 0);
     $fpdf->SetX(20);$fpdf->Cell(90, 5,"Grado", 0, 0, "L", 1);
if($estudiante->v_gradoingreso!=null)
    {$fpdf->Cell(0, 5,utf8_decode($estudiante->v_gradoingreso), 0, 1, "L", 0);}
  else{$fpdf->Cell(0, 5,"---", 0, 1, "L", 0);}

     $fpdf->SetX(20);
     $fpdf->Cell(90, 5,"Observaciones", 0, 0, "L", 1);
     if($estudiante->v_observacionesingreso!=null)
    {$fpdf->Cell(0, 5,utf8_decode($estudiante->v_observacionesingreso), 0, 1, "L", 0);}
  else{$fpdf->Cell(0, 5,"---", 0, 1, "L", 0);}
     $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Presentó partida de nacimiento"), 0, 0, "L", 1);
    $fpdf->Cell(0, 5,$estudiante->presentopartidaSN, 0, 1, "L", 0); 


    $fpdf->Ln(10);
    $fpdf->SetFont('Arial','BU',12);
    $fpdf->Cell(0, 5,utf8_decode("5. INFORMACION MEDICA"), 0, 1, "C", 0);
    $fpdf->Ln(5);

     $fpdf->SetFont('Arial','',12); 
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Presenta tarjeta de vacuna", 0, 0, "L", 1); $fpdf->Cell(0, 5, $datosmedicos->tarjeta_vacuna, 0, 1, "L", 0);
 $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Esquema de vacunacion completo"), 0, 0, "L", 1);$fpdf->Cell(0, 5, $datosmedicos->vacuna_completa, 0, 1, "L", 0);     
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Tipo sanguineo", 0, 0, "L", 1); $fpdf->Cell(0, 5, $datosmedicos->tipo_sanguineo, 0, 1, "L", 0); 
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Discapacidades", 0, 0, "L", 1); $fpdf->Cell(0, 5, utf8_decode($datosmedicos->discapacidades), 0, 1, "L", 0);
 $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Horario sueño durante la noche"), 0, 0, "L", 1);
if($datosmedicos->horario_sueno_noche!=null) {   $fpdf->Cell(0, 5, utf8_decode($datosmedicos->horario_sueno_noche), 0, 1, "L", 0);}
 else {$fpdf->Cell(0,5,"---",0,1,"L");} 
 $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Horario sueño durante el dia"), 0, 0, "L", 1); 
if($datosmedicos->horario_sueno_dia!=null) {   $fpdf->Cell(0, 5, utf8_decode($datosmedicos->horario_sueno_dia), 0, 1, "L", 0);}
 else {$fpdf->Cell(0,5,"---",0,1,"L");} 
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Dificultades para dormir", 0, 0, "L", 1);
if($datosmedicos->dificul_dormir!=null) {$fpdf->Cell(0, 5, utf8_decode($datosmedicos->dificul_dormir), 0, 1, "L", 0);}
 else {$fpdf->Cell(0,5,"---",0,1,"L");}

 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Es o fue alimentado con leche materna", 0, 0, "L", 1); $fpdf->Cell(0, 5, $datosmedicos->tomo_pecho, 0, 1, "L", 0); 
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Cuantos meses", 0, 0, "L", 1);
if($datosmedicos->tiempo_lactancia!=null) { $fpdf->Cell(0, 5, $datosmedicos->tiempo_lactancia, 0, 1, "L", 0);} else {$fpdf->Cell(0,5,"---",0,1,"L");}

 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Alimentos que consume", 0, 0, "L", 1); $fpdf->Cell(0, 5, utf8_decode($datosmedicos->alimentos_consume), 0, 1, "L", 0);  
 $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("¿Cuántos tiempos de comida realiza?"), 0, 0, "L", 1); $fpdf->Cell(0, 5, $datosmedicos->tiempos_comida, 0, 1, "L", 0); 
 $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Cuántos refrigerios realiza"), 0, 0, "L", 1); 
if($datosmedicos->canti_refrigerios!=null) {$fpdf->Cell(0, 5, $datosmedicos->canti_refrigerios, 0, 1, "L", 0); } else {$fpdf->Cell(0,5,"---",0,1,"L");}
 $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Es alérgico (alimentos y medicamentos)"), 0, 0, "L", 1); $fpdf->Cell(0, 5, $datosmedicos->esalergicoSN, 0, 1, "L", 0);
 $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Alérgico a "), 0, 0, "L", 1);
if($datosmedicos->alergicoa!=null) {$fpdf->Cell(0, 5, utf8_decode($datosmedicos->alergicoa), 0, 1, "L", 0);  } else {$fpdf->Cell(0,5,"---",0,1,"L");}
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Alimentos que prefiere", 0, 0, "L", 1); 
if($datosmedicos->alimentos_prefiere!=null) {$fpdf->Cell(0, 5, utf8_decode($datosmedicos->alimentos_prefiere), 0, 1, "L", 0); } else {$fpdf->Cell(0,5,"---",0,1,"L");}
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Alimentos que rechaza", 0, 0, "L", 1);
if($datosmedicos->alimentos_rechaza!=null) {$fpdf->Cell(0, 5, utf8_decode($datosmedicos->alimentos_rechaza), 0, 1, "L", 0);} else {$fpdf->Cell(0,5,"---",0,1,"L");} 
 $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Prescripción medica que deba seguirse"), 0, 0, "L", 1); $fpdf->Cell(0, 5, $datosmedicos->prescripcionmedicaSN, 0, 1, "L", 0);
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Detalle receta", 0, 0, "L", 1); 
if($datosmedicos->detallereceta!=null) {$fpdf->Cell(0, 5, utf8_decode($datosmedicos->detallereceta), 0, 1, "L", 0); } else {$fpdf->Cell(0,5,"---",0,1,"L");}
 

$fpdf->Ln(10);
$fpdf->SetFont('Arial','BU',12);
$fpdf->Cell(0, 5,"6. GRUPO FAMILIAR", 0, 1, "C", 0);
$fpdf->Ln(5);
 $fpdf->SetFont('Arial','',12);
$fpdf->SetFillColor(229,229,229);

if(count($familiares)>0)
{
foreach ($familiares as $datos) {
   foreach($datos->estudiante_familiares as $familiares)
   {
  $fpdf->SetX(20);$fpdf->Cell(90, 5,"Dui", 0, 0, "L", 1);
 if($familiares->dui!=null) {
 $fpdf->Cell(0, 5,$familiares->dui, 0, 1, "L", 0); } else {$fpdf->Cell(0,5,"---",0,1,"L");}
 $fpdf->SetX(20);$fpdf->Cell(90, 5,"Nombres", 0, 0, "L", 1); $fpdf->Cell(0, 5, utf8_decode($familiares->nombres), 0, 1, "L"); 
  $fpdf->SetX(20);$fpdf->Cell(90, 5,"Apellidos", 0, 0, "L", 1);$fpdf->Cell(0, 5, utf8_decode($familiares->apellidos), 0, 1, "L",0);
  $fpdf->SetX(20);$fpdf->Cell(90, 5,"Parentesco", 0, 0, "L", 1);$fpdf->Cell(0, 5, utf8_decode($familiares->pivot->parentesco), 0, 1, "L", 0); 
  $fpdf->SetX(20);$fpdf->Cell(90, 5,"Encargado", 0, 0, "L", 1);$fpdf->Cell(0, 5, $familiares->pivot->encargado, 0, 1, "L", 0); 
  $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Teléfono fijo"), 0, 0, "L", 1);
 if($familiares->telefonocasa!=null) {$fpdf->Cell(0, 5, $familiares->telefonocasa, 0, 1, "L", 0); } else {$fpdf->Cell(0,5,"---",0,1,"L");}
  $fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Célular"), 0, 0, "L", 1);
 if($familiares->celular!=null) { $fpdf->Cell(0, 5, $familiares->celular, 0, 1, "L", 0);} else {$fpdf->Cell(0,5,"---",0,1,"L");}
 $fpdf->Ln(5);
}
}
}

 $fpdf->Ln(5);
    $fpdf->SetFont('Arial','BU',12);
    $fpdf->Cell(0, 5,utf8_decode("7. HISTORIAL ACADEMICO"), 0, 1, "C", 0);
$fpdf->Ln(5);
$fpdf->SetFont('Arial','',12);
foreach($grados as $g)
{
$fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Año"), 0, 0, "L", 1); $fpdf->Cell(0, 5,$g[0]->anio, 0, 1, "L"); 
$fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Grado"), 0, 0, "L", 1); $fpdf->Cell(0, 5,$g[0]->descripcion, 0, 1, "L"); 
$fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Asesor"), 0, 0, "L", 1); $fpdf->Cell(0, 5,utf8_decode($g[0]->v_nombres) .' '.utf8_decode($g[0]->v_apellidos), 0, 1, "L"); 
$fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Estatus"), 0, 0, "L", 1);
 if($g[0]->promovido=='1')
 {
$fpdf->Cell(0, 5,"Promovido", 0, 1, "L"); 
 }
 else if($g[0]->promovido==0)
 {
$fpdf->Cell(0, 5,"Retenido", 0, 1, "L"); 
 }
 else
 {
$fpdf->Cell(0, 5,"Pendiente", 0, 1, "L"); 
 }
 $fpdf->Ln(5);
}

 $fpdf->Ln(5);
    $fpdf->SetFont('Arial','BU',12);
    $fpdf->Cell(0, 5,utf8_decode("8. HISTORIAL CONDUCTA"), 0, 1, "C", 0);
    $fpdf->Ln(5);
    $fpdf->SetFont('Arial','',12);
foreach($faltas as $faltas)
{
$fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Fecha"), 0, 0, "L", 1); $fpdf->Cell(0, 5,$faltas->fecha, 0, 1, "L");
$fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Tipo falta"), 0, 0, "L", 1); $fpdf->Cell(0, 5, $faltas->tipo_falta , 0, 1, "L");
$fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Descripción del incidente"), 0, 0, "L", 1); $fpdf->Cell(0, 5,utf8_decode($faltas->descripcion_falta), 0, 1, "L");
$fpdf->SetX(20);$fpdf->Cell(90, 5,utf8_decode("Sanciones aplicadas"), 0, 0, "L", 1); $fpdf->Cell(0, 5,utf8_decode($faltas->sanciones_aplicadas), 0, 1, "L");
$fpdf->Ln(5);
}

$this->piedepagina($fpdf);

    $response=response($fpdf->Output("s"));  
    $response->header('Content-Type','application/pdf'); 
    return $response; 
    
  }

public function alumnosmatriculadosporseccion($idseccion)
{
$seccion=Seccion::find($idseccion);
$anio=Periodoactivo::periodoescolar()->first();//uso el scope para sacar el periodo activo
$anio=$anio->anio;
$datos=Expedienteestudiante::whereHas('estudiante_seccion',function($q) use ($anio,$idseccion){//use se pasa un parametro externo al filtro 
$q->where([['tb_matriculaestudiante.seccion_id','=',$idseccion],['tb_matriculaestudiante.estado','=','1'],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.anio','=',$anio]]);})->where('estado','=','1')->get();
//dd($datos);
if($datos->isNotEmpty()){
foreach ($datos as $datos) {
  foreach ($datos->estudiante_seccion as $seccion) {    
   $grado=$seccion->seccion_grado->grado;
   $sec=$seccion->seccion;
  } 
}
}else{ $grado=""; $sec="";}

$fpdf=new Fpdf("L","mm","Letter");
 $fpdf->AddPage();
    $fpdf->SetFillColor(0,128,128);

   $centro = InfoCentroEducativo::first();  
    $fpdf->SetFont('Arial','',10); 
     $fpdf->Cell(0, $this->height - 1, utf8_decode('MINISTERIO DE EDUCACION'), 0, 1, 'C');
    $fpdf->SetFont('Arial','B',9); 
    $fpdf->Cell(0, $this->height, utf8_decode("BOLETA DE CAPTURA DE DATOS PARA LA ASIGNACION DEL NIE"), 0, 1, 'C');
    $fpdf->Ln(5);
    $fpdf->SetFont('Arial','', 8);
    $fpdf->Cell(45, $this->height + 1, "Nombre del Centro Educativo: ", 0, 0, 'R');
    $fpdf->Cell(100, $this->height, $centro->v_nombrecentro, 'B');
   $fpdf->Cell(35, $this->height, utf8_decode('Código de infraestructura:'), 0, 0, 'R');
   $fpdf->Cell(20, $this->height, $centro->v_codigoinfraestructura, 'B', 0, 'C');
    $fpdf->Cell(35, $this->height, utf8_decode('Departamento:'), 0, 0, 'R');
   $fpdf->Cell(20, $this->height, $centro->v_codigoinfraestructura, 'B', 1, 'C');

    $fpdf->Cell(45, $this->height + 1, "Municipio: ", 0, 0, 'R');
    $fpdf->Cell(5, $this->height, "01", 'B');
   $fpdf->Cell(20, $this->height, utf8_decode('Distrito:'), 0, 0, 'R');
   $fpdf->Cell(5, $this->height, $centro->v_distrito, 'B', 0, 'C');
    $fpdf->Cell(20, $this->height, utf8_decode('Grado:'), 0, 0, 'R');
   $fpdf->Cell(15, $this->height, $grado, 'B', 0, 'C');
    $fpdf->Cell(20, $this->height, utf8_decode('Sección:'), 0, 0, 'R');
   $fpdf->Cell(20, $this->height, $sec, 'B', 0, 'C');
    $fpdf->Cell(20, $this->height, "Aula regular", 0, 0, 'R');
   $fpdf->Cell(5, $this->height, " ", 'B', 0, 'C');
    $fpdf->Cell(20, $this->height, utf8_decode('Aula integrada:'), 0, 0, 'R');
   $fpdf->Cell(5, $this->height, " ", 'B', 1, 'C');


$fpdf->Ln(5);
   



$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;

}



////////////////////////////////////////////////////////////////////////////////
  public function crearPDF($datos,$vistaurl,$nombrereporte)
  {
$today=Carbon::now()->format('d_m_Y');
//$pdf=PDF::loadView($vistaurl, compact('datos'), compact('today'));//invocamos para que cargue la vista indicada en url y envie los datos
//return $pdf->stream($nombrereporte.$today.'.pdf');

$view= \View::make($vistaurl, compact('datos','today'))->render();
$pdf=\App::make('dompdf.wrapper');
$pdf->loadHTML($view);
return $pdf->stream($nombrereporte.$today.'.pdf');
  }

  public function listadoseccionesporaniolectivo(Request $request)
  {
$secciones=Seccion::seccionesporanioleectivo($request->periodo_id);
return response()->json($secciones);
  }

   public function periodoevaluacionporaniolectivo(Request $request)
  {
$periodos=Periodoevaluacion::where('periodo_id',$request->periodo_id)->get();
return response()->json($periodos);
  }

//MODULO DOCENTES 
public function listareportesmodulodocentes()
{
//$listasecciones=Seccion::secciones_docente()->pluck('grado','id');
$listasecciones=$this->secciones_docente()->pluck('grado','id');
$aniolectivo=Periodoactivo::periodoescolar()->get();
$aniolectivoactivo=$aniolectivo->pluck('anio','id');

$periodos = Periodoevaluacion::where('estado', 1)->get();//para el preporte boleta de notas
$asignaturas = Asignaturas::where('estado', 1)->get();
return view('admin.personaldocente.reportesmodulodocentes.listareportesmodulodocentes')->with('periodos',$periodos)->with('listasecciones',$listasecciones)->with('aniolectivoactivo',$aniolectivoactivo)->with('asignaturas',$asignaturas);
}
//ASISTENCIA ESTUDIANTES REPORTE MODULO DOCENTE

 protected function secciones_docente() //saca las secciones qu pertenecen al docente logeado
    { 

        $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where([['tb_secciones.empleado_id','=',Auth::user()->empleado->id],['tb_secciones.estado','=',1]])->get();
        return $secciones; 
    }

public function getUltimoDiaMes($elAnio,$elMes) {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }

public function reporteAsistenciamensual(Request $request,$idseccion,$aniolectivoid)
{
$anio=Periodoactivo::find($aniolectivoid);
$anio=$anio->anio;
//dd($anio);
$mes=$request->mesasistencia;
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        //$messeleccionado=date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
        $fecha_inicial=date("Y-m-d", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d", strtotime($anio."-".$mes."-".$ultimo_dia) );
 //$fecha_inicial=date("Y-m-d H:i:s", strtotime($aniolectivoid."-".$mes."-".$primer_dia) );
   // $fecha_final=date("Y-m-d H:i:s", strtotime($aniolectivoid."-".$mes."-".$ultimo_dia) );
        
 $seccion=Seccion::with('seccion_grado')->where('id','=',$idseccion)->first(); 
//saco los estudiantes que estan matriculados en la seccion elegida
$estudiantes=Expedienteestudiante::orderBy('v_apellidos')->whereHas('estudiante_seccion', function ($q) use ($anio,$idseccion){
  $q->where([['tb_matriculaestudiante.anio','=',$anio],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$idseccion]]);
})->where('estado','=','1')->get();

$mes=$this->mes($mes);
$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage(); 
$fpdf->SetTitle("Asistencia".$seccion->descripcion.date('_Ymd'));
$titulo="";
$subtitulo="";  
$this->cabecerahorizontal($fpdf,$titulo,$subtitulo);
 $fpdf->Ln(3);
$fpdf->SetFont('Arial','B',12);
$fpdf->Cell(0, $this->height - 1, utf8_decode('REPORTE DE ASISTENCIAS'), 0, 1, 'C');
//$fpdf->Cell(0, $this->height - 1,"MES: ".$mes, 0, 1, 'C');
$fpdf->SetFont('Arial','',8);
/*
$fpdf->Cell(0, $this->height - 1,'GRADO :  '.mb_strtoupper($seccion->seccion_grado->grado)."   SECCION:  ".mb_strtoupper($seccion->seccion)."  DOCENTE ASESOR :  ".utf8_decode(mb_strtoupper($seccion->seccion_empleado->v_nombres))." ".utf8_decode(mb_strtoupper($seccion->seccion_empleado->v_apellidos)), 0, 1, 'C');
*/
/*
$fpdf->Cell(20, $this->height - 1, 'Grado: ', 0, 0, 'R');
$fpdf->Cell(70, $this->height +1,utf8_decode($seccion->seccion_grado->grado), 'B');

$fpdf->Cell(20, $this->height - 1, utf8_decode('Sección: '), 0, 0, 'R');
$fpdf->Cell(60, $this->height +1,utf8_decode($seccion->seccion), 'B');

$fpdf->Cell(20, $this->height - 1, utf8_decode('Docente Asesor: '), 0, 0, 'R');
$fpdf->Cell(68.9, $this->height +1,utf8_decode($seccion->seccion_empleado->v_nombres)." ".utf8_decode($seccion->seccion_empleado->v_apellidos),'B');
*/

if($seccion->seccion_empleado==null){
 $asesor="SIN ASIGNAR";
}
else{
  $asesor=strtoupper(utf8_decode($seccion->seccion_empleado->v_nombres))." ".utf8_decode(strtoupper($seccion->seccion_empleado->v_apellidos));
}

$fpdf->Ln(5);
$fpdf->SetTextColor(240, 255, 240); //texto color blanco
$fpdf->SetFont('Arial','',7);
$fpdf->Cell(0, $this->height-1,utf8_decode("A=Asistencia II=Inasistencia injustificada IJ= Inasistencia justificada IT= Inasistencia total T=Total + =Asistió - =Faltó N=No se pasó lista"),0,1, "C",1);
 $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','8');
    $fpdf->SetTextColor(0,0,0);

  $fpdf->Cell(74.9, 5,utf8_decode("Grado: ".$seccion->seccion_grado->grado), 1, 0, "L",0); $fpdf->Cell(84.9, 5,utf8_decode("Sección: ".$seccion->seccion), 1, 0, "L",0);$fpdf->Cell(0, 5,"Docente Asesor: ".utf8_decode($seccion->seccion_empleado->v_nombres)." ".utf8_decode($seccion->seccion_empleado->v_apellidos), 1, 1, "L",0);

   // $fpdf->Cell(84.9, 5,utf8_decode("Año: ".$anio), 1, 0, "L",0);$fpdf->Cell(0, 5,"", 1, 1, "C",0);
    $fpdf->Cell(74.9, 5,"Mes: ".$mes.utf8_decode("/".$anio), 1, 0, "L",0);$fpdf->Cell(0, 5,"Dias del mes", 1, 1, "C",0);

    $fpdf->SetFillColor(0,0,0);
     $fpdf->SetTextColor(240, 255, 240); //texto color blanco
    $fpdf->Cell(5, 5,"No.", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"NIE", 1, 0, "C",1);
    $fpdf->Cell(55, 5,utf8_decode("ESTUDIANTE"), 1, 0, "C",1); 
 for($d=1;$d<=$ultimo_dia;$d++){
    $fpdf->Cell(5, 5,$d, 1, 0, "C",1);        
    }
$fpdf->Cell(4.5, 5," ", 1, 0, "C",1);
$fpdf->Cell(5, 5,"A", 1, 0, "C",1);
$fpdf->Cell(5, 5,"II", 1, 0, "C",1);
$fpdf->Cell(5, 5,"IJ", 1, 0, "C",1);
$fpdf->Cell(5, 5,"IT", 1, 0, "C",1);
$fpdf->Cell(5, 5,"T",1,1, "C",1);
$fpdf->SetTextColor(3, 3, 3);//texto color negro

foreach ($estudiantes as $key =>$estudiantes) 
{

    $fpdf->SetFillColor( ($key % 2 == 0 ) ? 190 : 250 );
    $fpdf->Cell(5, 5,$key+1, 1, 0, "L",1);
    $fpdf->Cell(15, 5,$estudiantes->v_nie, 1, 0, "L",1);
    $fpdf->Cell(55, 5,utf8_decode($estudiantes->v_apellidos)." ".utf8_decode($estudiantes->v_nombres), 1, 0, "L",1); 
  $asistio=0;
  $falto=0;
  $faltosj=0;
  $faltocj=0;
for($d=$fecha_inicial;$d<=$fecha_final;$d++){
$asistencia=AsistenciasEstudiantes::where([['expedienteestudiante_id',$estudiantes->id],['f_fecha',$d]])->first(); 
if($asistencia!=null)
{
  if($asistencia->v_asistenciaSN=='S')
  {
    $asistio+=1;
$fpdf->Cell(5, 5, "+", 1, 0, "C",1);
  }
  else
  {
    if($asistencia->justificacion=='Sin justificar')
    {
$faltosj+=1;
    }
    else{
      $faltocj+=1;
    }

    $falto+=1;
$fpdf->Cell(5, 5, "-", 1, 0, "C",1);
  }
}
else
  {$fpdf->Cell(5, 5, "N", 1, 0, "C",1);}
}//cierro foreach dias mes

//dd($asistencia);
$fpdf->Cell(4.5, 5, " ", 1, 0, "C",1); 
$fpdf->Cell(5, 5, $asistio, 1, 0, "C",1); 
$fpdf->Cell(5, 5, $faltosj, 1, 0, "C",1);
$fpdf->Cell(5, 5, $faltocj, 1, 0, "C",1);
$fpdf->Cell(5, 5, $falto, 1, 0, "C",1);
$fpdf->Cell(5, 5,$asistio+$falto, 1, 1, "C",1); 
}//each estudiantes

$director=InfoCentroEducativo::first();
$director=$director->nombre_director_ar;
$this->footerfirmashorizontal($fpdf,$director,$asesor);

$fpdf->SetTextColor(0,0,0);
$fpdf->Ln(5);
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;

}
////////////////////////////////////////////

public function reporteAsistenciaonline($idestudiante,$mes)
{
  //dd($mes." ".$idestudiante);
$anio=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$anio->anio;
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        //$messeleccionado=date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
        $fecha_inicial=date("Y-m-d", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d", strtotime($anio."-".$mes."-".$ultimo_dia) );

$estudiantes=Expedienteestudiante::orderBy('v_apellidos')->with('estudiante_seccion')->whereHas('estudiante_seccion', function ($q) use ($anio,$idestudiante){
  $q->where([['tb_matriculaestudiante.anio',$anio],['tb_matriculaestudiante.estudiante_id','=',$idestudiante]]);
})->first();

if($estudiantes==null)
{

}

else{
  $mes=$this->mes($mes);
// dd($estudiantes->estudiante_seccion);
foreach ($estudiantes->estudiante_seccion as $key => $value) {
  if($value->anio==$anio){
   $grado=strtoupper($value->seccion_grado->grado);
  
 
  $seccion=strtoupper($value->seccion);
  if($value->seccion_empleado!=null){

  $asesor=utf8_decode(mb_strtoupper($value->seccion_empleado->v_nombres))." ".utf8_decode(mb_strtoupper($value->seccion_empleado->v_apellidos));}
  else{$asesor="---";} 
}
}

$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vertical l horizontal
$fpdf->AddPage(); 
$fpdf->SetTitle("Asistencia".$grado.'_'.$seccion.date('_Ymd'));
$titulo="";
$subtitulo="";  
$this->cabecerahorizontal($fpdf,$titulo,$subtitulo);
 $fpdf->Ln(5);
$fpdf->SetFont('Arial','B', 11);
$fpdf->Cell(0, $this->height - 1, utf8_decode('REPORTE DE ASISTENCIAS'), 0, 1, 'C');
$fpdf->SetFont('Arial','B', 9);
$fpdf->Cell(0, $this->height - 1,'GRADO :  '.$grado."   SECCION:  ".$seccion."  DOCENTE ASESOR :  ".$asesor, 0, 1, 'C');
$fpdf->SetFont('Arial','B', 9);
$fpdf->Cell(0, $this->height - 1,"MES ".$mes, 0, 1, 'C');

$fpdf->SetTextColor(59,131,189);
$fpdf->SetFont('Arial','', 9);
$fpdf->Cell(0, 5,utf8_decode("A=Asistencia I=Inasistencia T=Total + =Asistió - =Faltó N=No se pasó lista"),0,1, "C",0);
 $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','8');
    $fpdf->SetTextColor(0,0,0);
    $fpdf->Cell(10, 5,"No.", 1, 0, "C",1);
    $fpdf->Cell(20, 5,"NIE", 1, 0, "C",1);
    $fpdf->Cell(55, 5,utf8_decode("ESTUDIANTE"), 1, 0, "C",1); 
 for($d=1;$d<=$ultimo_dia;$d++){
    $fpdf->Cell(5,5,$d, 1, 0, "C",1);        
    }
$fpdf->Cell(5, 5," ", 1, 0, "C",1);
$fpdf->Cell(5, 5,"A", 1, 0, "C",1);$fpdf->Cell(5, 5,"I", 1, 0, "C",1);
$fpdf->Cell(5, 5,"T",1,1, "C",1);

//foreach ($estudiantes as $key =>$estudiantes){
    $fpdf->Cell(10, 5,"1", 1, 0, "L",0);
    $fpdf->Cell(20, 5,$estudiantes->v_nie, 1, 0, "L",0);
    $fpdf->Cell(55, 5,utf8_decode($estudiantes->v_apellidos)." ".utf8_decode($estudiantes->v_nombres), 1, 0, "L",0); 
  $asistio=0;
  $falto=0;
for($d=$fecha_inicial;$d<=$fecha_final;$d++){
$asistencia=AsistenciasEstudiantes::where([['expedienteestudiante_id',$estudiantes->id],['f_fecha',$d]])->first(); 
if($asistencia!=null)
{
  if($asistencia->v_asistenciaSN=='S')
  {
    $asistio+=1;
$fpdf->Cell(5, 5, "+", 1, 0, "C",0);
  }
  else
  {
    $falto+=1;
$fpdf->Cell(5, 5, "-", 1, 0, "C",0);
  }
}
else
  {$fpdf->Cell(5, 5, "N", 1, 0, "C",0);}
}//cierro foreach dias mes

//dd($asistencia);
$fpdf->Cell(5, 5, " ", 1, 0, "C",0); 
$fpdf->Cell(5, 5, $asistio, 1, 0, "C",0); 
$fpdf->Cell(5, 5, $falto, 1, 0, "C",0);
$fpdf->Cell(5, 5,$asistio+$falto, 1, 1, "C",0); 
//}//each estudiantes



$fpdf->SetTextColor(0,0,0);
$fpdf->Ln(5);
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;
}

}

////////////////////////////////////////////

public function reporteAsistencia(Request $request,$idseccion,$aniolectivoid)
{
if($request->f_asistencia!=null)//si ha seleccionado un rango de tiempo para la busqueda
{
        $periodo = explode(' - ', $request->f_asistencia);
        $f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
        $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
        $f_desde = $f_desde->format('Y-m-d');
        $f_hasta = $f_hasta->format('Y-m-d');
      
$seccion=Seccion::with('seccion_grado')->where('id','=',$idseccion)->first(); 
$anio=Periodoactivo::find($aniolectivoid);
$anio=$anio->anio;
//saco los estudiantes que estan matriculados en la seccion elegida
$estudiantes=Expedienteestudiante::orderBy('v_apellidos')->whereHas('estudiante_seccion', function ($q) use ($anio,$idseccion){
  $q->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1'],['v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.seccion_id','=',$idseccion]]);
})->where('estado','=','1')->get();


 ///////////////pdf//////////////////////
$fpdf = new Fpdf("P", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage(); 
$fpdf->SetTitle("Asistencia".$seccion->descripcion.date('_Ymd'));
$titulo="";
$subtitulo="";  
$this->cabecera($fpdf,$titulo,$subtitulo);
 $fpdf->Ln(5);
$fpdf->SetFont('Arial','B', 10);
$fpdf->Cell(0, $this->height - 1, utf8_decode('REGISTRO DE ASISTENCIAS'), 0, 1, 'C');
$fpdf->Cell(0, $this->height - 1,'GRADO :  '.strtoupper($seccion->seccion_grado->grado)."   SECCION:  ".strtoupper($seccion->seccion)."  DOCENTE ASESOR :  ".strtoupper($seccion->seccion_empleado->v_nombres)." ".strtoupper($seccion->seccion_empleado->v_apellidos), 0, 1, 'C');
$fpdf->SetTextColor(59,131,189);
$fpdf->SetFont('Arial','B', 9);
$fpdf->Cell(0, $this->height - 1,"DEL ".$periodo[0]." AL ".$periodo[1], 0, 1, 'C');
$fpdf->SetTextColor(0,0,0);
    $fpdf->Ln(5);
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','8');
    $fpdf->Cell(10, 5,"No.", 1, 0, "C",1);
    $fpdf->Cell(30, 5,"NIE", 1, 0, "C",1);
    $fpdf->Cell(70, 5,utf8_decode("ESTUDIANTE"), 1, 0, "C",1); 
    $fpdf->Cell(30, 5, "ASISTENCIAS", 1, 0, "C",1); 
    $fpdf->Cell(30, 5,"INASISTENCIAS", 1, 0, "C",1);
    $fpdf->Cell(25, 5,"TOTAL", 1, 1, "C",1);
   
foreach ($estudiantes as $key =>$estudiantes) {

  $sqlQueryasistencia = "SELECT count(*) as asist FROM tb_asistenciaestudiantes where tb_asistenciaestudiantes.expedienteestudiante_id = ".$estudiantes->id." AND  tb_asistenciaestudiantes.v_asistenciaSN='S' AND tb_asistenciaestudiantes.f_fecha Between '".$f_desde."' AND '".$f_hasta." '";
    $asistencia= DB::select( DB::raw($sqlQueryasistencia));
//dd($asistencia);

    $sqlQueryfalta = "SELECT count(*) as falta FROM tb_asistenciaestudiantes where tb_asistenciaestudiantes.expedienteestudiante_id = ".$estudiantes->id." AND tb_asistenciaestudiantes.v_asistenciaSN='N'AND tb_asistenciaestudiantes.f_fecha Between '".$f_desde."' AND '".$f_hasta." '";
    $faltas= DB::select( DB::raw($sqlQueryfalta) );

    $fpdf->Cell(10, 5,$key+1, 1, 0, "L",0);
    $fpdf->Cell(30, 5,$estudiantes->v_nie, 1, 0, "L",0);
    $fpdf->Cell(70, 5,utf8_decode($estudiantes->v_apellidos)." ".utf8_decode($estudiantes->v_nombres), 1, 0, "L",0); 
    $fpdf->Cell(30, 5, $asistencia[0]->asist, 1, 0, "C",0); 
    $fpdf->Cell(30, 5, $faltas[0]->falta, 1, 0, "C",0);
    $fpdf->Cell(25, 5,$faltas[0]->falta+$asistencia[0]->asist, 1, 1, "C",0);
}

$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;
//////////////////fin pdf asistencia////////////////
         
}
else{
  Flash::error("Reporte Asistencia: debe seleccionar un rango de tiempo para iniciar la busqueda.")->important();
  return redirect()->route('listareportes');
}

}



//ADMINISTRACION ACADEMICA LISTA DE REPORTES
public function reportesacademicosporseccion()
{
 $listaanioslectivos=Periodoactivo::periodosescolares();
 $anioslectivos=$listaanioslectivos->pluck('anio','id');
 $periodos = Periodoevaluacion::where('estado', 1)->get();//para el preporte boleta de notas
 $asignaturas = Asignaturas::where('estado', 1)->get();
return view('admin.consultasyreportes.academica.reportesacademicosporseccion.listarptporseccion',compact('anioslectivos','periodos','asignaturas'));
} 

public function reportesacademicosinstitucional()
{
 //$anioslectivos=Periodoactivo::listaperiodosescolares();
 $listaanioslectivos=Periodoactivo::periodosescolares();
 $anioslectivos=$listaanioslectivos->pluck('anio','id');
return view('admin.consultasyreportes.academica.reportesacademicosinstitucionales.listarptinstitucional',compact('anioslectivos'));
}

public function estadisticamatriculaescolarCE_pdf($anio)
{
$anio=Periodoactivo::find($anio);
$anio=$anio->anio;
$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage();   
$this->cabecerahorizontal($fpdf);
 $fpdf->Ln(5);
$fpdf->SetFont('Arial','B', 12);
$fpdf->Cell(0, $this->height - 1, utf8_decode('ESTADISTICA MATRICULA ESCOLAR'), 0, 1, 'C');
$fpdf->Cell(0, $this->height - 1,utf8_decode('AÑO: '.$anio), 0, 1, 'C');
//header tabla
    $fpdf->Ln(5);
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','8');    
    $fpdf->Cell(45, 5," ", 1, 0, "C",1);
    $fpdf->Cell(36, 5,"MATRICULA INICIAL", 1, 0, "C",1);
    $fpdf->Cell(36, 5, "DESERTORES", 1, 0, "C",1); 
    $fpdf->Cell(36, 5,"TRASLADOS", 1, 0, "C",1);
    $fpdf->Cell(36, 5,"RETENIDOS", 1, 0, "C",1);
    $fpdf->Cell(36, 5, "PROMOVIDOS", 1, 0, "C",1);
    $fpdf->Cell(36, 5,"REPITENCIA", 1, 1, "C",1); 
    $fpdf->Cell(10, 5,"No", 1, 0, "C",1);
    $fpdf->Cell(35, 5,"GRADO", 1, 0, "C",1); 
    $x=0;
   while ( $x<= 4) {
    $fpdf->Cell(12, 5,"M", 1, 0, "C",1);
    $fpdf->Cell(12, 5,"F", 1, 0, "C",1);
    $fpdf->Cell(12, 5,"T", 1, 0, "C",1);
    $x++;
   }
   $fpdf->Cell(12, 5,"M", 1, 0, "C",1);
   $fpdf->Cell(12, 5,"F", 1, 0, "C",1);
   $fpdf->Cell(12, 5,"T", 1, 1, "C",1);

$estadistica=$this->estadistica($anio);

$acum=array();
array_push($acum,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
foreach ($estadistica as $key => $value) {
$fpdf->Cell(10, 5,utf8_decode($key+1), 1, 0, "L",0);
$fpdf->Cell(35, 5,utf8_decode($value->grado), 1, 0, "L",0);
$fpdf->Cell(12, 5,$value->mim, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->mif, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->mim+$value->mif, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->rm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->rf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->rm+$value->rf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->tm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->tf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->tf+$value->tm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->retm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->retf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->retm+$value->retf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->promm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->promf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->promm+$value->promf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->repm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->repf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->repm+$value->repf, 1, 1, "C",0);
$acum[0]+=$value->mim;
$acum[1]+=$value->mif;
$acum[2]=($acum[0]+$acum[1]);
$acum[3]+=$value->rm;
$acum[4]+=$value->rf;
$acum[5]=($acum[3]+$acum[4]);
$acum[6]+=$value->tm;
$acum[7]+=$value->tf;
$acum[8]=($acum[6]+$acum[7]);
$acum[9]+=$value->retm;
$acum[10]+=$value->retf;
$acum[11]=($acum[9]+$acum[10]);
$acum[12]+=$value->promm;
$acum[13]+=$value->promf;
$acum[14]=($acum[12]+$acum[13]);
$acum[15]+=$value->repm;
$acum[16]+=$value->repf;
$acum[17]=($acum[15]+$acum[16]);
}

$fpdf->Cell(45, 5,"TOTAL ", 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[0], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[1], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[2], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[3], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[4], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[5], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[6], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[7], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[8], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[9], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[10], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[11], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[12], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[13], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[14], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[15], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[16], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[17], 1, 0, "C",1);
//dd($estadistica);
 $fpdf->Ln(30);
$this->footerNotesBoletas($fpdf);
$this->piedepagina($fpdf);
$fpdf->SetTitle("matriculaescolar".date('_Ymd'));
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;

}

 public function footerNotesBoletas($fpdf)
  {
    $centroEscolar = InfoCentroEducativo::first();
    $fpdf->Ln(10);
    $fpdf->SetFont('Arial','', 10);
   
    $fpdf->Cell(0, $this->height, "F._____________________________________", 0, 1, 'C');
     $fpdf->Cell(0, $this->height, "  ".utf8_decode($centroEscolar->nombre_director_ar), 0, 1, 'C');
     $fpdf->Cell(0, $this->height, "  Director del Centro Escolar", 0, 0, 'C');
    //$fpdf->Cell(94);

  }

public function estadistica($anio)
{
return $estadistica= DB::select(
            DB::raw("select p.anio as periodo,g.grado as grado,sum(e.m_ini_m) as mim,sum(e.m_ini_f) as mif,sum(e.retirados_m) as rm,sum(e.retirados_f) as rf,sum(e.traslado_m) as tm,sum(e.traslado_f) as tf,sum(e.retenidos_m) as retm,sum(e.retenidos_f) as retf,sum(e.promovidos_m) as promm,sum(e.promovidos_f) as promf,sum(e.repitencia_m) as repm, sum(e.repitencia_f) as repf from estadistica as e join  tb_secciones as s on s.id=e.seccion_id join tb_grados as g on g.id=s.grado_id join tb_periodo_activo as p on p.anio=s.anio where s.anio=".$anio." group by g.id")
          );

}


public function historialmatriculaescolarCE_pdf()
{

$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage();   
$this->cabecerahorizontal($fpdf);
 $fpdf->Ln(5);
$fpdf->SetFont('Arial','B', 12);
$fpdf->Cell(0, $this->height - 1, utf8_decode('HISTORIAL DECENAL MATRICULA ESCOLAR'), 0, 1, 'C');
//header tabla
    $fpdf->Ln(5);
    $fpdf->SetFillColor(229,229,229);
    $fpdf->SetFont('Arial','','8');
    $fpdf->Cell(45, 5,"", 1, 0, "C",1);
    $fpdf->Cell(36, 5,"MATRICULA INICIAL", 1, 0, "C",1);
    $fpdf->Cell(36, 5, "DESERTORES", 1, 0, "C",1); 
    $fpdf->Cell(36, 5,"TRASLADOS", 1, 0, "C",1);
    $fpdf->Cell(36, 5,"RETENIDOS", 1, 0, "C",1);
    $fpdf->Cell(36, 5, "PROMOVIDOS", 1, 0, "C",1);
    $fpdf->Cell(36, 5,"REPITENCIA", 1, 1, "C",1);

    $fpdf->Cell(45, 5,utf8_decode("AÑO"), 1, 0, "C",1); 
    $x=0;
   while ( $x<= 4) {
    $fpdf->Cell(12, 5,"M", 1, 0, "C",1);
    $fpdf->Cell(12, 5,"F", 1, 0, "C",1);
    $fpdf->Cell(12, 5,"T", 1, 0, "C",1);
    $x++;
   }
   $fpdf->Cell(12, 5,"M", 1, 0, "C",1);
   $fpdf->Cell(12, 5,"F", 1, 0, "C",1);
   $fpdf->Cell(12, 5,"T", 1, 1, "C",1);

 $totales=$this->estadisticaanual();
 $acum=array(); 
array_push($acum,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
 foreach ($totales as $value) {
$fpdf->Cell(45, 5,$value->periodo, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->mim, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->mif, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->mim+$value->mif, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->rm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->rf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->rm+$value->rf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->tm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->tf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->tf+$value->tm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->retm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->retf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->retm+$value->retf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->promm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->promf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->promm+$value->promf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->repm, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->repf, 1, 0, "C",0);
$fpdf->Cell(12, 5,$value->repm+$value->repf, 1, 1, "C",0);
$acum[0]+=$value->mim;
$acum[1]+=$value->mif;
$acum[2]=($acum[0]+$acum[1]);
$acum[3]+=$value->rm;
$acum[4]+=$value->rf;
$acum[5]=($acum[3]+$acum[4]);
$acum[6]+=$value->tm;
$acum[7]+=$value->tf;
$acum[8]=($acum[6]+$acum[7]);
$acum[9]+=$value->retm;
$acum[10]+=$value->retf;
$acum[11]=($acum[9]+$acum[10]);
$acum[12]+=$value->promm;
$acum[13]+=$value->promf;
$acum[14]=($acum[12]+$acum[13]);
$acum[15]+=$value->repm;
$acum[16]+=$value->repf;
$acum[17]=($acum[15]+$acum[16]);
 }
$fpdf->Cell(45, 5,"TOTAL ", 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[0], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[1], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[2], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[3], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[4], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[5], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[6], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[7], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[8], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[9], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[10], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[11], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[12], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[13], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[14], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[15], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[16], 1, 0, "C",1);
$fpdf->Cell(12, 5,$acum[17], 1, 0, "C",1);

 $fpdf->Ln(30);
$this->footerNotesBoletas($fpdf);
$this->piedepagina($fpdf);
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;

}

public function estadisticaanual()
{

  return $estadistica= DB::select(
            DB::raw("select p.anio as periodo,sum(e.m_ini_m) as mim,sum(e.m_ini_f) as mif,sum(e.retirados_m) as rm,sum(e.retirados_f) as rf,sum(e.traslado_m) as tm,sum(e.traslado_f) as tf,sum(e.retenidos_m) as retm,sum(e.retenidos_f) as retf,sum(e.promovidos_m) as promm,sum(e.promovidos_f) as promf,sum(e.repitencia_m) as repm, sum(e.repitencia_f) as repf from estadistica as e join  tb_secciones as s on s.id=e.seccion_id join tb_grados as g on g.id=s.grado_id join tb_periodo_activo as p on p.anio=s.anio  group by p.anio"));
}

public function imprimircomprobantepermiso($id)
{
dd('llega comprobante');
}

public function reporteAsistenciarrhh_pdf($mes)
{
$anio = Carbon::create()->year;
$primer_dia=1;
$ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
$fecha_inicial=date("Y-m-d", strtotime($anio."-".$mes."-".$primer_dia) );
$fecha_final=date("Y-m-d", strtotime($anio."-".$mes."-".$ultimo_dia) );
$docentes=Empleado::whereHas('tipoPersonal', function ($q){
  $q->where('v_tipopersonal','like','Docente');
})->where('estado',1)->get();
$a=array();
$fpdf=new Fpdf("L","mm","Letter");
for ($x=1; $x <=$ultimo_dia; $x++)
{
$fpdf->AddPage();
$fpdf->Ln(5);
 $fpdf->SetTextColor(0,0,0);
$fpdf->SetFont('Helvetica','B','12');
$this->cabecerahorizontalrrhh($fpdf);
$fpdf->Ln(5);
$fpdf->SetFont('Helvetica','B','12');
$fpdf->Cell(0,$this->height,"CONTROL DE ASISTENCIA PERSONAL DOCENTE",0,1,"C");
$fpdf->Cell(0, $this->height - 1, 'Fecha:  '.$x.'/'.$mes.'/'.$anio, 0, 0, 'C');
$fpdf->Ln(7);
$fpdf->SetFont('Helvetica','','8');

$fpdf->SetFillColor(0,0,0);
 $fpdf->SetTextColor(240, 255, 240);
$fpdf->SetFont('Helvetica','','9');
$fpdf->Cell(10,$this->height,"No", 1, 0, "C",1);
$fpdf->Cell(82,$this->height,"Nombre del maestro/a", 1, 0, "C",1);
$fpdf->Cell(28,$this->height,"Asistencia", 1, 0, "C",1);
$fpdf->Cell(28,$this->height,"Hora ingreso", 1, 0, "C",1);
$fpdf->Cell(28,$this->height,"Hora de salida", 1, 0, "C",1);
$fpdf->Cell(28,$this->height,"Inasistencia", 1, 0, "C",1);
$fpdf->Cell(28,$this->height,"Con permiso", 1, 0, "C",1);
$fpdf->Cell(28,$this->height,"Sin permiso", 1, 1, "C",1);

$fecha=date("Y-m-d", strtotime($anio."-".$mes."-".$x) );
$i=0;

foreach ($docentes as $key => $value) {
  $i++;
$fpdf->SetFillColor( ($i % 2 == 0 ) ? 120 : 190 );//
$asistencias = AsistenciasRH::where([['expedientepersonal_id',$value->id],['fecha',$fecha]])->first();
//$asistencias = AsistenciasRH::where([['expedientepersonal_id','20'],['fecha','2020-06-22']])->first();
array_push($a,$docentes);

$fpdf->SetFont('Helvetica','','8');
$fpdf->SetTextColor(0,0,0);
$fpdf->Cell(10,$this->height,$key+1, 1, 0, "C",1);
$fpdf->Cell(82,$this->height,utf8_decode($value->v_nombres).' '.utf8_decode($value->v_apellidos), 1, 0, "L",0);
if(count($asistencias)==0){
 $fpdf->Cell(28,$this->height,'-', 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"-", 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"-", 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"-", 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"-", 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"-", 1, 1, "C",0);
}
if(count($asistencias)>0){
 if($asistencias->asistenciaSN=='S'){
$fpdf->Cell(28,$this->height,$asistencias->horaEntrada, 1, 0, "C",0);
$fpdf->Cell(28,$this->height,$asistencias->horaSalida, 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"", 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"", 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"", 1, 1, "C",0);
}else
{
$permiso = Permiso::where([['solicitante_id','=',$value->expedientepersonal_id],['f_desde','<=',$fecha],['f_hasta','>=',$fecha],['estado','=','Aprobada']])->count();

$fpdf->Cell(28,$this->height,'', 1, 0, "C",0);
$fpdf->Cell(28,$this->height,'', 1, 0, "C",0);
$fpdf->Cell(28,$this->height,'', 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"x", 1, 0, "C",0);
if($permiso>0){
$fpdf->Cell(28,$this->height,"x", 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"", 1, 1, "C",0);
}
else
{
$fpdf->Cell(28,$this->height,"", 1, 0, "C",0);
$fpdf->Cell(28,$this->height,"x", 1, 1, "C",0);
}
}
}
}
}//cerrro el for x
//dd($a);

$fpdf->SetTitle("Controldeasistenciarh".$mes);
$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
return $response;

}

public function asistenciamensualrh($mes,$anio)
{
  $primer_dia=1;
  $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
  $fecha_inicial=date("Y-m-d", strtotime($anio."-".$mes."-".$primer_dia) );
  $fecha_final=date("Y-m-d", strtotime($anio."-".$mes."-".$ultimo_dia) );
$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vertical l horizontal
$mesletras=$this->mes($mes);
$fpdf->AddPage(); 
$fpdf->SetTitle("AsistenciaPersonal_".$mes);
$this->cabecerahorizontalrrhh($fpdf);
 $fpdf->Ln(5);
$fpdf->SetFont('Helvetica','B', 11);
$fpdf->Cell(0, $this->height - 1, utf8_decode('CONTROL DE ASISTENCIA PERSONAL DOCENTE'), 0, 1, 'C');
$fpdf->Cell(0, $this->height - 1,$mesletras, 0, 1, 'C');

$fpdf->SetTextColor(0,0,0);
$fpdf->SetFont('Helvetica','', 8);
$fpdf->Cell(0, $this->height,utf8_decode("A=Asistencia IJ=Inasistencia Justificada II=Inasistencia Injustificada T=Total N=No se marcó asistencia"),0,1, "C",0);
$fpdf->Ln(2);
 $fpdf->SetFillColor(0,0,0);
 $fpdf->SetTextColor(249,249,249);
    $fpdf->SetFont('Helvetica','B','8');
    $fpdf->Cell(7, $this->height,"No.", 1, 0, "C",1);
    $fpdf->Cell(70, $this->height,"Nombre completo", 1, 0, "C",1);

 
 for($d=1;$d<=$ultimo_dia;$d++){
    $fpdf->Cell(5,$this->height,$d, 1, 0, "C",1);        
    }
$fpdf->Cell(5, $this->height," ", 1, 0, "C",1);
$fpdf->Cell(5, $this->height,"A", 1, 0, "C",1);
$fpdf->Cell(5, $this->height,"IJ", 1, 0, "C",1);
$fpdf->Cell(5, $this->height,"II", 1, 0, "C",1);
$fpdf->Cell(5, $this->height,"T",1,1, "C",1);

$docentes=Empleado::whereHas('tipoPersonal', function ($q){
  $q->where('v_tipopersonal','like','Docente');
})->where('estado',1)->get();

 $fpdf->SetTextColor(0,0,0);
 $fpdf->SetFont('Helvetica','','8');

foreach ($docentes as $key =>$docentes) 
{

    $fpdf->SetFillColor( ($key % 2 == 0 ) ? 120 : 190 );
    $fpdf->Cell(7, $this->height,$key+1, 1, 0, "L",1);
    $fpdf->Cell(70,$this->height,utf8_decode($docentes->v_nombres).' '.utf8_decode($docentes->v_apellidos), 1, 0, "L",0);
$contadorasistencias=0;
$contadorij=0;
$contadorii=0;   
for($d=$fecha_inicial;$d<=$fecha_final;$d++)
{
$permiso = Permiso::where([['solicitante_id','=',$docentes->id],['f_desde','<=',$d],['f_hasta','>=',$d],['estado','=','Aprobada']])->count();
if($permiso!=0)
        {
          $fpdf->SetFillColor(179,253,250);
          $contadorij++;
          $fpdf->Cell(5,$this->height,'P', 1, 0, "C",1);
        }else
        {
          $asistencia = AsistenciasRH::where('expedientepersonal_id','=',$docentes->id)->where('fecha', '=',$d)->first();
          if(count($asistencia)>0)
          {
if($asistencia->asistenciaSN=='S')
{
 $fpdf->Cell(5,$this->height,'+', 1, 0, "C",0);
        $contadorasistencias++; 
}
else
  {
 $fpdf->SetFillColor(255,128,128);   
 $contadorii++;
 $fpdf->Cell(5,$this->height,'-', 1, 0, "C",1); 
}

          }
          else//no se tomo asistencia
            {
$fpdf->Cell(5,$this->height,'N', 1, 0, "C",0);
          }

        }

}//for


$fpdf->Cell(5, $this->height," ", 1, 0, "C",0);
$fpdf->Cell(5, $this->height,$contadorasistencias, 1, 0, "C",0);
$fpdf->Cell(5, $this->height,$contadorij, 1, 0, "C",0);
$fpdf->Cell(5, $this->height,$contadorii, 1, 0, "C",0);
$fpdf->Cell(5, $this->height,$contadorasistencias+$contadorii+$contadorij,1,1, "C",0);

} //forearch

$this->piedepagina($fpdf);
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;
}

public function horarioclasesrrhh($docente,$anio)
{
$bloques=BloqueHorarios::get();
$horario = HorarioClases::with('horario_docente')->where([['anio','=',$anio],['tb_horario_clases.docente_id','=',$docente]])
      ->orderBy('dia','Asc')->get();

$lista=array();
foreach ($bloques as $key => $value)
 {
  if($value->tipo_bloque=='Receso')
  {
  for ($d=0; $d <5 ; $d++) { 
$lista[$key][$d][0]=date('g:i A',strtotime($value->hora_inicio)) .' - '. date('g:i A',strtotime($value->hora_fin));
$lista[$key][$d][1]='RECESO';
$lista[$key][$d][2]='RECESO';
$lista[$key][$d][3]='RECESO';
$lista[$key][$d][4]='RECESO';
$lista[$key][$d][5]='RECESO';
$lista[$key][$d][6]='RECESO';
  }
  }
else//es bloque de clases
{
 $horariom=HorarioClases::where([['anio','=',$anio],['tb_horario_clases.docente_id','=',$docente],['bloque_id',$value->id],])->get();

foreach ($horariom as $i => $horariom) {
  $lista[$key][$i][0]=date('g:i A',strtotime($value->hora_inicio)) .' - '. date('g:i A',strtotime($value->hora_fin));

 $lista[$key][$i][1] = $horariom->horario_bloque->tipo_bloque;
$lista[$key][$i][2] = $horariom->horario_asignatura->asignatura;
$lista[$key][$i][3] = $horariom->horario_docente->v_nombres . ' ' . $horariom->horario_docente->v_apellidos;
$lista[$key][$i][4] = $horariom->horario_seccion->descripcion;
$lista[$key][$i][5] = $horariom->anio;
$lista[$key][$i][6] = $horariom->dia;

}
 }//cierro else
}//cierro foreach

$fpdf=new Fpdf("L","mm","Letter");
$fpdf->AddPage(); 
$this->cabecerahorizontalrrhh($fpdf);
$fpdf->SetFont('Arial','BU',12);

$fpdf->Ln(10);
$fpdf->Cell(0, $this->height - 1, 'CARGA ACADEMICA PERSONAL DOCENTE', 0, 1, 'C');
$fpdf->SetFont('Arial','',10);
$docente=Empleado::find($docente);
$numerobloques=count($bloques);
$fpdf->Cell(0, $this->height - 1, utf8_decode($docente->v_nombres).' '.utf8_decode($docente->v_apellidos), 0, 1, 'C');
$fpdf->Cell(0, $this->height - 1, utf8_decode('AÑO: '.$anio), 0, 1, 'C');
if(count($horario)>0)
{
$fpdf->Ln(10);
    $fpdf->SetFillColor(45,87,44);
    $fpdf->SetTextColor(255,255,255);
    $fpdf->SetFont('Arial','B','9');
    $fpdf->Cell(35, 5, "HORARIO", 1, 0, "C",1); 
    $fpdf->Cell(45, 5,"LUNES", 1, 0, "C",1);
    $fpdf->Cell(45, 5, "MARTES", 1, 0, "C",1); 
    $fpdf->Cell(45, 5,"MIERCOLES", 1, 0, "C",1);
    $fpdf->Cell(45, 5,"JUEVES", 1, 0, "C",1);
    $fpdf->Cell(45, 5, "VIERNES", 1, 1, "C",1);
    
for($b=0;$b<$numerobloques;$b++)
{
  $fpdf->SetFillColor(45,87,44);
  $fpdf->SetTextColor(255,255,255);

$fpdf->SetFont('Helvetica','','8'); 
$fpdf->Cell(35, 5,date('g:i A',strtotime($bloques[$b]->hora_inicio)) .' - '. date('g:i A',strtotime($bloques[$b]->hora_fin)),1, 0, "C",1);  //aca van los horarios    

    for($d=0;$d<5;$d++)//dias
    {
$fpdf->SetFillColor(255,255,255);//fondo blanco
$fpdf->SetFont('Helvetica','','6');
$fpdf->SetTextColor(10,10,10);//letras negras
 if (
 !isset($lista[$b][$d]))//no existe ese bloque en ese dia
       {
         if($d<4){//para pasar ala siguiente linea
                              
              $fpdf->Cell(45, 5,'-', 1, 0, "C",0); 
                }else
                 { 
                $fpdf->Cell(45, 5,'-', 1, 1, "C",0);          
                   }
                      }
        else{//si existe bloque  y dia
                 if($d<4){//para pasar ala siguiente linea 

  $fpdf->SetFillColor(($lista[$b][$d][1]=='RECESO') ? 206 : 255 );

  $fpdf->Cell(45, 5,utf8_decode($lista[$b][$d][4]), 1, 0, "C",1); 
                 }else
                 { 
$fpdf->SetFillColor(($lista[$b][$d][1]=='RECESO') ? 206 : 255 );
  
$fpdf->Cell(45, 5,utf8_decode($lista[$b][$d][4]), 1, 1, "C",1);          
                  }
        }//else isset

    }//cierro for dias
}//cierro for bloques
}
else//si no hay informacion 
{
$fpdf->SetFont('Arial','',10);
  $fpdf->MultiCell(0, $this->height - 1, utf8_decode('No hay información para mostrar.'), 0, 'L', 0, 0, '', '', true);
}//cierro else isset

$fpdf->SetTitle("horariodeclases");
$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
return $response;

}//cierro public


 private function mes($mes)
 {
  switch ($mes) {
  case '1':
   $mes="ENERO";
    break;
    case '2':
   $mes="FEBRERO";
    break;
  case '3':
   $mes="MARZO";
    break;
  case '4':
   $mes="ABRIL";
    break;
  case '5':
   $mes="MAYO";
    break;
  case '6':
   $mes="JUNIO";
    break;
  case '7':
   $mes="JULIO";
    break;
  case '8':
   $mes="AGOSTO";
    break;
    case '9':
   $mes="SEPTIEMBRE";
    break;
  case '10':
   $mes="OCTUBRE";
    break;
  case '11':
   $mes="NOVIEMBRE";
    break;
  case '12':
   $mes="DICIEMBRE";
    break;
  default:
    # code...
    break;
}
  return $mes;

 }

public function permisosrrhh_pdf($mes,$anio)
{
$fpdf = new Fpdf("L", "mm", "Letter");
$fpdf->AddPage();
$this->cabecerahorizontalrrhh($fpdf);
$fpdf->Ln(5);
$fpdf->SetFont('Helvetica','B','12');
$fpdf->Cell(0, 5, "REPORTE DE PERMISOS E INCAPACIDADES", 0, 1, "C");
$fpdf->SetFont('Helvetica','','10'); 
 $meses=$this->mes($mes);
$fpdf->Cell(0, 5,$meses ." - ".$anio, '', 0, 'C');
$fpdf->SetFont('Helvetica','','8');

 $fpdf->Ln(7);
 $fpdf->SetFillColor(0,0,0);
  $fpdf->SetFont('Arial','','6');
$fpdf->Cell(0, $this->height-1,utf8_decode("D=Dias H=Horas M=Minutos D S/J= Dias sin justificaión"),0,1, "C",0);
  
    $fpdf->SetTextColor(240, 255, 240);
    $fpdf->Cell(5, 5,utf8_decode("No."), 1, 0, "C",1); 
    $fpdf->Cell(13, 5,"NIP", 1, 0, "C",1);
    $fpdf->Cell(45, 5, "NOMBRE DEL EMPLEADO", 1, 0, "C",1); 
    $fpdf->Cell(4, 5,"SB", 1, 0, "C",1);
    $fpdf->Cell(4, 5,"SS", 1, 0, "C",1);
    $fpdf->Cell(4, 5, "HC", 1, 0, "C",1);
    $fpdf->Cell(40, 5,"TIPO PERMISO", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"DESDE", 1, 0, "C",1);
    $fpdf->Cell(15, 5,"HASTA", 1, 0, "C",1);
    $fpdf->Cell(7, 5,"D", 1, 0, "C",1);
     $fpdf->Cell(7, 5,"H", 1, 0, "C",1);
      $fpdf->Cell(7, 5,"M", 1, 0, "C",1);
    $fpdf->Cell(12, 5,"D S/J", 1, 0, "C",1);
    $fpdf->Cell(0, 5,"OBSERVACIONES", 1, 1, "C",1);


       $hoy = Carbon::now();
        //$anio = $hoy->year;
        $anio = $anio;
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d", strtotime($anio."-".$mes."-".$ultimo_dia) );

        /*$permisos=Permiso::orderBy('solicitante_id','ASC')->whereBetween('f_fechasolicitud',[$fecha_inicial,$fecha_final])->whereHas('empleado', function($q)
    {
      $q->where('estado', '=', '1'); 
    })->with('empleado')->with('tipoPermiso')->with('motivoPermiso')->get();*/

    $permisos=Permiso::orderBy('solicitante_id','ASC')->whereHas('empleado', function($q)
    {
      $q->where('estado',1); 
    })->with('empleado')->with('motivoPermiso')->where('estado','Aprobada')
    ->WhereBetween('f_desde',[$fecha_inicial,$fecha_final])
    ->WhereBetween('f_hasta',[$fecha_inicial,$fecha_final])
    ->get();


if(count($permisos)>0)
{
$fpdf->SetFont('Arial', '', 6);
$fpdf->SetTextColor(3, 3, 3);
$i=0;
  foreach ($permisos as $key => $value) 
  { 
$i++; 
$fpdf->SetFillColor( ($i % 2 == 0 ) ? 120 : 190 );
$fpdf->Cell(5,5,$key+1,1,0,"L",1);
$fpdf->Cell(13,5,$value->empleado->v_nip,1,0,"L");
$fpdf->Cell(45,5,utf8_decode($value->empleado->v_apellidos)." ".utf8_decode($value->empleado->v_nombres),1,0,"L");
if($value->empleado->v_tipocontratacion=='SB')
{
  $fpdf->Cell(4,5,"x",1,0,"L");
  $fpdf->Cell(4,5," ",1,0,"L");
  $fpdf->Cell(4,5," ",1,0,"L");
}
else if($value->empleado->v_tipocontratacion=='SS')
{
   $fpdf->Cell(4,5," ",1,0,"L");
  $fpdf->Cell(4,5,"x",1,0,"L");
  $fpdf->Cell(4,5," ",1,0,"L");
}
else
{
  $fpdf->Cell(4,5," ",1,0,"L");
  $fpdf->Cell(4,5," ",1,0,"L");
  $fpdf->Cell(4,5,"x",1,0,"L");
}
$fpdf->Cell(40,5,utf8_decode($value->motivoPermiso->v_motivo),1,0,"L");
$fpdf->Cell(15,5,$value->f_desde,1,0,"C");
$fpdf->Cell(15,5,$value->f_hasta,1,0,"C");
$fpdf->Cell(7,5,$value->i_tiemposolicitado,1,0,"C");
$fpdf->Cell(7,5,$value->i_horas,1,0,"C");
$fpdf->Cell(7,5,$value->i_minutos,1,0,"C");
$fpdf->Cell(12,5,"",1,0,"L");
$fpdf->Cell(0,5,$value->v_observaciones,1,1,"L");
        }//fin foreach


 $fpdf->Ln(20);
     $fpdf->SetFont('Arial','', 8);
     $fpdf->Cell(95, $this->height, "F.________________________________________", 0, 0, 'C');
    $fpdf->Cell(225, $this->height, "F._________________________________________", 0, 1, 'C');
    
     $fpdf->Cell(95, $this->height, "Nombre, firma y sello del Director del Centro Escolar", 0, 0, 'C');
     $fpdf->Cell(230, $this->height, utf8_decode("Nombre, firma y sello del Subdirector del Centro Escolar"), 0, 0, 'C');
     $fpdf->Ln(5);
        }//fin if  
 
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;
}

function cabecerahorizontalrrhh($fpdf)
{
    $centro = InfoCentroEducativo::first();
    $fpdf->Image('imagenes/recursosrpt/escudoce.jpg',60,8,20);
    $fpdf->Image('imagenes/recursosrpt/escudo.png',200,8,20);
    // Arial bold 15
    $fpdf->SetFont('Arial','',10); 
     $fpdf->Cell(0, $this->height - 1, utf8_decode('ADMINISTRACION DE RECURSOS HUMANOS'), 0, 1, 'C');
    $fpdf->SetFont('Arial','B',10); 
    $fpdf->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
   
    $fpdf->SetFont('Arial','I',10);
    $fpdf->Cell(0, $this->height-2, utf8_decode($centro->v_direccion), 0, 1, 'C');    
    $fpdf->Cell(0, $this->height-2, utf8_decode('Teléfono '.$centro->v_telefono.' E-mail: '.$centro->correo_electronico), 0, 1, 'C');
    $fpdf->Cell(0, $this->height, '', 'B', 1, 'C');
}

function cabecerahorizontalAF($fpdf)
{
    $centro = InfoCentroEducativo::first();
    $fpdf->Image('imagenes/recursosrpt/escudoce.jpg',60,8,20);
    $fpdf->Image('imagenes/recursosrpt/escudo.png',200,8,20);
    // Arial bold 15
    $fpdf->SetFont('Arial','',10); 
     $fpdf->Cell(0, $this->height - 1, utf8_decode('ADMINISTRACION DE ACTIVO FIJO'), 0, 1, 'C');
    $fpdf->SetFont('Arial','B',10); 
    $fpdf->Cell(0, $this->height, utf8_decode($centro->v_nombrecentro), 0, 1, 'C');
   
    $fpdf->SetFont('Arial','I',10);
    $fpdf->Cell(0, $this->height-2, utf8_decode($centro->v_direccion), 0, 1, 'C');    
    $fpdf->Cell(0, $this->height-2, utf8_decode('Teléfono '.$centro->v_telefono.' E-mail: '.$centro->correo_electronico), 0, 1, 'C');
    $fpdf->Cell(0, $this->height, '', 'B', 1, 'C');
}

public function listadoconsultasyreportes()
{
  return view('admin.seguridad.Reportes.listadoconsultasyreportes');
}
public function listareportesrrhh()
{
  $anio=Carbon::now()->year;
  $anioarray=[];
  $x=0;
  for($i=$anio-5;$i<=$anio;$i++)
  {
$anioarray[$x]=$i;
$x++;
  }
  $listadocentes=Empleado::whereHas('tipoPersonal', function($q){
    $q->where('v_tipopersonal','like','Docente');
  })->where('estado',1)->get();

  //dd($listadocentes);
  return view('admin.recursohumano.reportes.listareportesrrhh',compact('anioarray','listadocentes'));
}

public function nominarhpdf()
{
$empleados = Empleado::orderBy('id','ASC')->where('estado','=','1')->where('v_numeroexp','!=','RH0000-0')->get();
$fpdf=new Fpdf("L","mm","Letter");
$fpdf->AddPage();
$this->cabecerahorizontalrrhh($fpdf);
$fpdf->SetFont('Helvetica','B','12');
$fpdf->Ln(5);
$fpdf->Cell(0,$this->height,"NOMINA",0,1,"C");
$fpdf->Ln(5);
$fpdf->SetFont('Arial','','8');
 $fpdf->SetFillColor(0,0,0);
 $fpdf->SetTextColor(240, 255, 240);

$fpdf->Cell(7, $this->height,"No.", 1, 0, "C",1);
$fpdf->Cell(20, $this->height,"Dui", 1, 0, "C",1);
$fpdf->Cell(20, $this->height,"Nip", 1, 0, "C",1);
$fpdf->Cell(49, $this->height,"Nombre", 1, 0, "C",1);
$fpdf->Cell(70, $this->height,utf8_decode("Dirección"), 1, 0, "C",1);
$fpdf->Cell(20, $this->height,"Contacto", 1, 0, "C",1);
$fpdf->Cell(44, $this->height,"Cargo", 1, 0, "C",1);
$fpdf->Cell(30, $this->height,"Especialidad", 1, 1, "C",1);

$fpdf->SetFont('Arial', '', 7);
$fpdf->SetTextColor(3, 3, 3);
$i=0;
foreach ($empleados as $key => $value) {
$i++;
$fpdf->SetFillColor(($i%2==0)?120:190);
$fpdf->Cell(7,$this->height,$key+1,1,0,"C",1);
$fpdf->Cell(20,$this->height,$value->v_dui,1,0,"C",0);
$fpdf->Cell(20,$this->height,$value->v_nip,1,0,"C",0);
$fpdf->Cell(49,$this->height,utf8_decode($value->v_nombres).' '.utf8_decode($value->v_apellidos),1,0,"L",0);
$fpdf->Cell(70,$this->height,utf8_decode($value->v_direccioncasa),1,0,"L",0);
$fpdf->Cell(20,$this->height,$value->v_celular,1,0,"C",0);
$fpdf->Cell(44,$this->height,utf8_decode($value->cargo->v_descripcion),1,0,"L",0);
$fpdf->Cell(30,$this->height,utf8_decode($value->especialidad->v_especialidad),1,1,"L",0);
}


$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
return $response;
}


public function listareportesactivofijo()
{
  $cuentas = Catalogodecuenta::select(\DB::raw('CONCAT(v_codigocuenta," - ",v_nombrecuenta) as nombre'),\DB::raw('substr(v_codigocuenta, 1,4) as codigo'))->orderBy('v_codigocuenta','ASC')->where([['estado','=','1'],['tipocuenta_id','=','1'],['v_nivel','=','3']])->pluck('nombre','codigo');

    return view('admin.activofijo.reportes.reportesactivofijo',compact('cuentas'));
}

public function activosrpt($estado,$categoria)
{
  switch ($estado)
 {
  case '0'://todos
  if($categoria==null)
      {//buscare todos los activos
  $activos = ActivoFijo::orderBy('v_codigoactivo','desc')->get();
      }
      else
      {
    //buscaremos activos de una sola categoria
    $activos = ActivoFijo::orderBy('v_codigoactivo','desc')->whereHas('cuentacatalogo', function ($q) use($categoria){$q->where([['v_codigocuenta','LIKE',$categoria.'%'],['v_nivel',4]]);})->get();
      }
  break;

  case '1'://activos
  if($categoria==null)
      {//buscare todos los activos
  $activos = ActivoFijo::orderBy('v_codigoactivo','desc')->where('v_estado',1)->get();
      }
      else
      {
    //buscaremos activos de una sola categoria
    $activos = ActivoFijo::orderBy('v_codigoactivo','desc')->whereHas('cuentacatalogo', function ($q) use($categoria){$q->where([['v_codigocuenta','LIKE',$categoria.'%'],['v_nivel',4]]);})->where('v_estado',1)->get();
      }
  break;
  
  case '2'://inactivos
    if($categoria==null)
      {//buscare todos los activos
     $activos = ActivoFijo::orderBy('v_codigoactivo','desc')->where('v_estado',0)->get();
      }
      else
      {
    //buscaremos activos de una sola categoria
    $activos = ActivoFijo::orderBy('v_codigoactivo','desc')->whereHas('cuentacatalogo', function ($q) use($categoria){$q->where([['v_codigocuenta','LIKE',$categoria.'%'],['v_nivel',4]]);})->where('v_estado',0)->get();
      }
  break;

  case '3'://traslados

     if($categoria==null)
      {//buscare todos los activos
     $activos = ActivoFijo::orderBy('v_codigoactivo','desc')->where([['v_estado',1],['v_trasladadoSN','S']])->get();
      }
      else
      {
    //buscaremos activos de una sola categoria
    $activos = ActivoFijo::orderBy('v_codigoactivo','desc')->whereHas('cuentacatalogo', function ($q) use($categoria){$q->where([['v_codigocuenta','LIKE',$categoria.'%'],['v_nivel',4]]);})->where([['v_estado',1],['v_trasladadoSN','S']])->get();
      }
  break;

  default:
    # code...
    break;
}
return $activos;
}

public function listadoactivofijo_pdf(Request $request)
{

$estado=$request->estado;//estado del activo
$categoria=$request->categoria;//estado del activo
$activos=$this->activosrpt($estado,$categoria);
  //$activos=ActivoFijo::Orderby('v_codigoactivo','Desc')->where('v_estado',1)->get();



   $anio=Carbon::today()->year;
   $fpdf=new Fpdf("L",'mm',"Letter");
   $fpdf->AddPage();
   $this->cabecerahorizontalAF($fpdf);
   $fpdf->SetFont('Helvetica','B','12');
$fpdf->Ln(5);
$fpdf->Cell(0,$this->height,"LISTADO DE BIENES ".$anio,0,1,"C");
$fpdf->Ln(5);
$fpdf->SetFont('Helvetica','','8');
 $fpdf->SetFillColor(0,0,0);
 $fpdf->SetTextColor(240, 255, 240);

$fpdf->Cell(7, $this->height,"No.", 1, 0, "C",1);
//$fpdf->Cell(30, $this->height,"Clasificación", 1, 0, "C",1);
$fpdf->Cell(35, $this->height,utf8_decode("Código"), 1, 0, "C",1);
$fpdf->Cell(53, $this->height,utf8_decode("Descripción"), 1, 0, "C",1);
$fpdf->Cell(30, $this->height,utf8_decode("Fecha de adquisición"), 1, 0, "C",1);

$fpdf->Cell(15, $this->height,"Valor", 1, 0, "C",1);
//$fpdf->Cell(10, $this->height,utf8_decode("Vida útil"), 1, 0, "C",1);
$fpdf->Cell(30, $this->height,utf8_decode("Número de Serie"), 1, 0, "C",1);
$fpdf->Cell(20, $this->height,"Modelo", 1, 0, "C",1);
$fpdf->Cell(20, $this->height,"Marca", 1, 0, "C",1);
$fpdf->Cell(20, $this->height,utf8_decode("Traslado"), 1, 0, "C",1);
$fpdf->Cell(30, $this->height,utf8_decode("Ubicación"), 1, 1, "C",1);


$fpdf->SetFont('Arial', '', 7);
$fpdf->SetTextColor(0,0,0);

if(count($activos)>0){
foreach ($activos as $key => $value) {
$fpdf->SetFillColor(($key%2==0)?120:190);
$fpdf->Cell(7,$this->height,$key+1,1,0,"C",1);
//$fpdf->Cell(30,$this->height,$value->cuentacatalogo->v_nombrecuenta,1,0,"C",0);
$fpdf->Cell(35,$this->height,$value->v_codigoactivo,1,0,"L",0);
$fpdf->Cell(53,$this->height,$value->v_nombre,1,0,"L",0);
$fpdf->Cell(30, $this->height,$value->f_fecha_adquisicion, 1, 0, "C",0);

$fpdf->Cell(15,$this->height,'$ '.number_format($value->d_valor,2),1,0,"C",0);
//$fpdf->Cell(10,$this->height,utf8_decode($value->v_vidautil),1,0,"L",0);
$fpdf->Cell(30,$this->height,utf8_decode($value->v_serie),1,0,"L",0);
$fpdf->Cell(20,$this->height,utf8_decode($value->v_modelo),1,0,"L",0);
$fpdf->Cell(20,$this->height,utf8_decode($value->v_marca),1,0,"L",0);
$fpdf->Cell(20,$this->height,$value->v_trasladadoSN=='S'?'SI':'NO',1,0,"L",0);
$fpdf->Cell(30,$this->height,$value->v_trasladadoSN=='S'?'---':utf8_decode($value->v_ubicacion),1,1,"L",0);

}
}
else 
{
 $fpdf->SetFont('Helvetica','',10);
$fpdf->MultiCell(0, $this->height - 1, utf8_decode('No hay información para mostrar.'), 0, 'L', 0, 0, '', '', true); 
}
   $response=response($fpdf->Output("s"));
   $response->header('Content-Type','application/pdf');
   return $response; 

}


public function catalogoactivofijo_pdf(Request $request)
{

if($request->categoria==null)
{
  $catalogo = Catalogodecuenta::orderBy('v_codigocuenta','ASC')->where([['v_codigocuenta','LIKE','12%'],['v_nivel',4]])->get();
      
}
  else{ 
   $catalogo = Catalogodecuenta::where([['v_codigocuenta','LIKE',$request->categoria.'%'],['v_nivel',4]])->get(); 
 
  }
   // $catalogo = Catalogodecuenta::orderBy('v_nombrecuenta')->get(); 
   $anio=Carbon::today()->year;
   $fpdf=new Fpdf("L",'mm',"Letter");
   $fpdf->AddPage();
   $this->cabecerahorizontalAF($fpdf);
   $fpdf->SetFont('Helvetica','B','12');
$fpdf->Ln(5);
$fpdf->Cell(0,$this->height,"CATALOGO DE CLASIFICACION ACTIVO FIJO ".$anio,0,1,"C");
$fpdf->Ln(5);
$fpdf->SetFont('Helvetica','','8');
 $fpdf->SetFillColor(0,0,0);
 $fpdf->SetTextColor(240, 255, 240);

$fpdf->Cell(7, $this->height,"No.", 1, 0, "C",1);
$fpdf->Cell(40, $this->height,utf8_decode("Código"), 1, 0, "C",1);
$fpdf->Cell(100, $this->height,utf8_decode("Cuenta"), 1, 0, "C",1);
$fpdf->Cell(12, $this->height,utf8_decode("Nivel"), 1, 0, "C",1);

$fpdf->Cell(60, $this->height,"Tipo de cuenta", 1, 0, "C",1);

$fpdf->Cell(40, $this->height,utf8_decode("Tipo de saldo"), 1, 1, "C",1);

$fpdf->SetFont('Arial', '', 7);
$fpdf->SetTextColor(0,0,0);

if(count($catalogo)>0)
{

foreach ($catalogo as $key => $value) 
{
$fpdf->SetFillColor(($key%2==0)?120:190);
$fpdf->Cell(7,$this->height,$key+1,1,0,"C",1);
$fpdf->Cell(40,$this->height,$value->v_codigocuenta,1,0,"L",0);
$fpdf->Cell(100,$this->height,$value->v_nombrecuenta,1,0,"L",0);
$fpdf->Cell(12,$this->height,$value->v_nivel,1,0,"C",0);
$fpdf->Cell(60,$this->height,$value->clasificacioncuentacatalogo->v_tipocuenta,1,0,"L",0);
$fpdf->Cell(40,$this->height,$value->v_tiposaldo,1,1,"L",0);
}
}
else
{
$fpdf->SetFont('Helvetica','',10);
$fpdf->MultiCell(0, $this->height - 1, utf8_decode('No hay información para mostrar.'), 0, 'L', 0, 0, '', '', true);  
}

$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
   return $response; 

}

public function trasladosactivofijo_pdf(Request $request)
{
  $tipotraslado=$request->estado;
  $categoria=$request->categoria;
  $traslados=$this->trasladosrpt($tipotraslado,$categoria);
   //$traslados=TrasladosActivo::Orderby('f_fechatraslado','Asc')->get();
   $anio=Carbon::today()->year;
   $fpdf=new Fpdf("L",'mm',"Letter");
   $fpdf->AddPage();
   $this->cabecerahorizontalAF($fpdf);
   $fpdf->SetFont('Helvetica','B','12');
$fpdf->Ln(5);
$fpdf->Cell(0,$this->height,"HISTORIAL TRASLADOS ACTIVO FIJO ".$anio,0,1,"C");
$fpdf->Ln(5);
$fpdf->SetFont('Helvetica','','8');
 $fpdf->SetFillColor(0,0,0);
 $fpdf->SetTextColor(240, 255, 240);

$fpdf->Cell(5, $this->height,"No.", 1, 0, "C",1);
$fpdf->Cell(15, $this->height,utf8_decode("Fecha"), 1, 0, "C",1);
$fpdf->Cell(25, $this->height,utf8_decode("Código"), 1, 0, "C",1);
$fpdf->Cell(60, $this->height,utf8_decode("Activo"), 1, 0, "C",1);
$fpdf->Cell(20, $this->height,"Motivo", 1, 0, "C",1);
$fpdf->Cell(45, $this->height,utf8_decode("Destino"), 1, 0, "C",1);
$fpdf->Cell(30, $this->height,utf8_decode("Enviado por"), 1, 0, "C",1);
$fpdf->Cell(30, $this->height,utf8_decode("Recibido por"), 1, 0, "C",1);
$fpdf->Cell(30, $this->height,utf8_decode("Observaciones"), 1, 1, "C",1);

$fpdf->SetFont('Helvetica', '', 6);
$fpdf->SetTextColor(0,0,0);
if(count($traslados)>0)
{

foreach ($traslados as $key => $value) 
{
$fpdf->SetFillColor(($key%2==0)?120:190);
$fpdf->Cell(5,$this->height,$key+1,1,0,"C",1);
$fpdf->Cell(15,$this->height,$value->f_fechatraslado,1,0,"L",0);
$fpdf->Cell(25,$this->height,$value->activofijo->v_codigoactivo,1,0,"L",0);
$fpdf->Cell(60,$this->height,$value->activofijo->v_nombre,1,0,"L",0);
$fpdf->Cell(20,$this->height,$value->tipotraslado->v_descripcion,1,0,"L",0);
$fpdf->Cell(45,$this->height,$value->destino->nombre_institucion,1,0,"L",0);
$fpdf->Cell(30,$this->height,utf8_decode($value->v_personaautoriza),1,0,"L",0);
$fpdf->Cell(30,$this->height,$value->v_personarecibe,1,0,"L",0);
$fpdf->MultiCell(30,$this->height,$value->v_observaciones,1,0,"L",1);
}
}
else
{
$fpdf->SetFont('Helvetica','',10);
$fpdf->MultiCell(0, $this->height - 1, utf8_decode('No hay información para mostrar.'), 0, 'L', 0, 0, '', '', true);  
}

$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
   return $response; 



}


//////////////////////////////////////////////////////////////////////////
public function consultasacademica()
{ 
  $grados=Grados::orderBy('id','ASC')->where('estado','=','1')->get();
$asignaturas=Asignaturas::orderBy('id','ASC')->where('is_cuadro','1')->get();
  $listasecciones=Seccion::orderBy('id','ASC')->where('estado','=','1')->withCount(['seccion_estudiante',
                'seccion_estudiante as nuevoingreso' => function ($query){
                    $query->where([['tb_matriculaestudiante.anio','tb_secciones.anio'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
                }
            ])->get();

 // return view('admin.consultasyreportes.academica.consultasacademica.prueba',compact('listasecciones'));

   return view('admin.consultasyreportes.academica.consultasacademica.consultasacademica',compact('listasecciones','grados','asignaturas'));
}

public function filtroestudiantes($estado,$genero,$anio,$grado,$seccion,$edadinicio,$edadfin)
{
if($genero=='F'){
  $consultagenero=" where v_genero='Femenino'";
}else if($genero=='M'){$consultagenero=" where v_genero='Masculino'";}
else{$consultagenero=" where v_genero='Femenino' or v_genero='Masculino'";}

if($estado=='A'){
  $consultaestado=" estado='1'";
}else if($estado=='I'){$consultaestado=" estado='0'";}
else{$consultaestado=" estado='1' or estado='0'";}

if($edadinicio=='-'&& $edadfin=="-")
{
$consultaedad="";
}
else if($edadinicio!='-' && $edadfin!="-")
{
$consultaedad=" and TIMESTAMPDIFF(YEAR,f_fnacimiento,CURDATE()) between ".$edadinicio." and ".$edadfin;
}
else if($edadinicio!='-' && $edadfin=="-")
{
$consultaedad=" and TIMESTAMPDIFF(YEAR,f_fnacimiento,CURDATE()) > ".$edadinicio;
}
else if($edadinicio=='-' && $edadfin!="-")
{
  $consultaedad=" and TIMESTAMPDIFF(YEAR,f_fnacimiento,CURDATE()) < ".$edadfin;
}

//dd($edadinicio,$edadfin,$consultaedad);

$sqlQuery = "SELECT TIMESTAMPDIFF(YEAR,f_fnacimiento,CURDATE()) AS edad,id,v_nie,v_nombres,v_apellidos,v_genero,estado from tb_expedienteestudiante".$consultagenero.$consultaedad." and ".$consultaestado;
$datos = DB::select( DB::raw($sqlQuery) );
return response()->json($datos);
}


public function filtropadresdefamilia($estado,$genero,$apellido,$parentesco,$profesion)
{

if($genero=='F'){
  $consultagenero=" where genero='Femenino'";
}else if($genero=='M'){$consultagenero=" where genero='Masculino'";}
else{$consultagenero=" where genero='Femenino' or genero='Masculino'";}

if($estado=='A'){
  $consultaestado=" and estado='1'";
}else if($estado=='I'){$consultaestado=" and estado='0'";}
else{$consultaestado=" and estado='1' or estado='0'";}


if($apellido!='-')
{
  $consultaapellido="and apellidos like '%".$apellido."%'";
}
else{$consultaapellido="";}

if($profesion!='-')
{
$consultaprofesion="and profesion like '%".$profesion."%'";
}
else{$consultaprofesion="";}

if($parentesco=='T')
{
$consultaparentesco=" and f.id=fe.familiar_id ";
}
else{$consultaparentesco=" and f.id=fe.familiar_id and fe.parentesco like '%".$parentesco."%'";}

$sqlQuery = "select f.expediente,f.nombres,f.apellidos,f.genero,f.profesion,f.niveleducativo,f.estado,fe.parentesco  from  tb_familiares as f inner join tb_estudiante_familiar as fe ".$consultagenero.$consultaapellido.$consultaprofesion.$consultaparentesco.$consultaestado;
$datos = DB::select( DB::raw($sqlQuery) ); 

return response()->json($datos);
}

public function filtromatriculas($anio,$grado,$genero,$ingreso,$modalidad)
{

if($grado!='0')
{
  $consultagrado=" and g.id=".$grado;
}else
 {$consultagrado='';}
  //dd($anio,$grado,$genero,$ingreso);


if($anio!='-')
{
  $consultaanio=" and me.anio=".$anio;
}else
 {$consultaanio='';}

if($genero=='F'){
  $consultagenero=" and e.v_genero='Femenino'";
}else if($genero=='M'){$consultagenero=" and e.v_genero='Masculino'";}
else{$consultagenero="";}

if($ingreso=='N'){
  $consultaingreso=" and me.v_nuevoingresoSN='SI'";
}else if($ingreso=='A'){$consultaingreso=" and me.v_nuevoingresoSN='NO'";}
else{$consultaingreso="";}

if($modalidad=='P'){
  $consultamodalidad=" and me.modalidad='Presencial'";
}else if($modalidad=='O'){$consultamodalidad=" and me.modalidad='Online'";}
else{$consultamodalidad="";}

$sqlQuery = "select e.v_nombres, e.v_apellidos,e.v_genero,e.estado,me.v_nuevoingresoSN,me.modalidad,me.v_estadomatricula,s.descripcion,g.grado,s.anio from tb_expedienteestudiante as e inner join tb_matriculaestudiante as me inner join tb_secciones as s inner join tb_grados as g where  me.seccion_id=s.id and s.grado_id=g.id and e.id=me.estudiante_id and me.v_estadomatricula='aprobada'".$consultaanio.$consultagrado.$consultagenero.$consultaingreso.$consultamodalidad;
//dd($sqlQuery);
$datos=DB::select(DB::raw($sqlQuery));
return response()->json($datos);
}

public function filtrocalificaciones($anio,$grado,$genero,$criterio,$asignatura)
{

if($genero=='F'){
  $consultagenero=" and e.v_genero='Femenino'";
}else if($genero=='M'){$consultagenero=" and e.v_genero='Masculino'";}
else{$consultagenero="";}

if($anio!='-')
{
  $consultaanio=" and s.anio=".$anio;
}else
 {$consultaanio='';}

if($grado!='0')
{
  $consultagrado= " and c.seccion_id=s.id and s.grado_id=".$grado;
}else
  {$consultagrado='';}

 if($asignatura!='')
 {
 $as=" cf.".$asignatura; 
if($criterio=='max')
{$criterioconsulta=" order by cf.".$asignatura." desc limit 1";}
else if($criterio=='min')
{$criterioconsulta=" order by cf.".$asignatura." asc limit 1";}
else if($criterio=='prom')
{
   
  $asignatura=" avg(".$asignatura.")";
  $criterioconsulta=" order by ".$asignatura." limit 1";
}
 }

$sqlQuery="select ".$asignatura." as valor,e.v_expediente,e.v_nombres,e.v_apellidos,e.v_genero,s.descripcion,s.anio from tb_expedienteestudiante as e inner join cuadro_final_notas as cf inner join cuadro_final as c inner join tb_grados as g inner join tb_secciones as s  where cf.cuadro_final_id=c.id and e.id=cf.alumno_id and c.seccion_id=s.id ".$consultagrado.$consultaanio.$consultagenero ." group by s.anio,c.id,e.v_expediente, ".$as.$criterioconsulta;


$datos=DB::select(DB::raw($sqlQuery));
return response()->json($datos);
}

public function filtroestadisticas($anio,$grado,$genero,$criterio)
{ 
if($anio=='-')
{
$consultaanio='';
}
else{$consultaanio=' and s.anio='.$anio;}


if($grado==0)
{
$consultagrado='';
}
else
{
  $consultagrado=' and g.id='.$grado;
}

if($genero=='F')
{
  $consultagenero=" and e.v_genero='Femenino'";
}else if($genero=='M')
{$consultagenero=" and e.v_genero='Masculino'";}
else
  {$consultagenero="";}


//dd($consultagrado,$anio,$consultaanio,$consultagenero);

if($criterio=='1')//Promovidos
{ 
$sqlQuery="select g.grado,s.descripcion,s.anio,e.v_nombres,e.v_apellidos,e.v_genero,cf.lenguaje,cf.matematica,cf.ciencia,cf.sociales,cf.ingles,cf.artistica,cf.fisica,cf.urbanida from cuadro_final_notas as cf inner join cuadro_final as c inner join tb_expedienteestudiante as e inner join tb_secciones as s inner join tb_grados as g where cf.promovido='1' and cf.cuadro_final_id=c.id and e.id=cf.alumno_id and s.grado_id=g.id and c.seccion_id=s.id ".$consultaanio.$consultagrado.$consultagenero;

}//fin promovidos

if($criterio=='2')//Egresados
{ 
$sqlQuery="select g.grado,s.descripcion,s.anio,e.v_nombres,e.v_apellidos,e.v_genero,cf.lenguaje,cf.matematica,cf.ciencia,cf.sociales,cf.ingles,cf.artistica,cf.fisica,cf.urbanida from cuadro_final_notas as cf inner join cuadro_final as c inner join tb_expedienteestudiante as e inner join tb_secciones as s inner join tb_grados as g where cf.promovido='1' and g.nivel=9 and cf.cuadro_final_id=c.id and e.id=cf.alumno_id and s.grado_id=g.id and c.seccion_id=s.id ".$consultaanio.$consultagrado.$consultagenero;

}//fin egresados

if($criterio=='3')//Repitentes
{ 
$sqlQuery="select e.v_nombres,e.v_apellidos,e.v_genero,e.v_nie,g.grado,m.anio from tb_expedienteestudiante as e inner join tb_matriculaestudiante as m inner join tb_grados as g inner join tb_secciones as s where e.id=m.estudiante_id and m.matricula>1 and g.id=s.grado_id and s.id=m.seccion_id ".$consultaanio.$consultagrado.$consultagenero;
}//fin retenidos

if($criterio=='4')//Retenidos
{ 
$sqlQuery="select g.grado,s.descripcion,s.anio,e.v_nombres,e.v_apellidos,e.v_genero,cf.lenguaje,cf.matematica,cf.ciencia,cf.sociales,cf.ingles,cf.artistica,cf.fisica,cf.urbanida from cuadro_final_notas as cf inner join cuadro_final as c inner join tb_expedienteestudiante as e inner join tb_secciones as s inner join tb_grados as g where cf.promovido='0' and g.nivel!=9 and cf.cuadro_final_id=c.id and e.id=cf.alumno_id and s.grado_id=g.id and c.seccion_id=s.id ".$consultaanio.$consultagrado.$consultagenero;

}//fin retenidos


$datos=DB::select(DB::raw($sqlQuery));

return response()->json($datos);
}


function cabecerapeRmisos($fpdf)
{
    $fpdf->Image('imagenes/recursosrpt/logomined.jpg',30,8,50);
    }

public function comprobantepermisodocente($idsolicitud)
{
$solicitud=Permiso::find($idsolicitud);
$fpdf=new Fpdf("P",'mm',"Letter");
$fpdf->AddPage();
$this->cabecerapermisos($fpdf);
$fpdf->SetFont('Helvetica','B','12');
$fpdf->SetTextColor(79,79,79);
$fpdf->SetXY(30,$this->height+30);
$fpdf->Cell(0,$this->height+5,"SOLICITUD DE LICENCIA",0,1,"C");

//$hoy=Carbon::now()->format('Y-m-d');
$hoy=Carbon::now()->format('d/m/Y');
$centro=InfoCentroEducativo::first();

  if($solicitud->i_tiemposolicitado<=5)
  {
$this->cuerpoformato1($fpdf,$solicitud,$hoy,$centro);
  }
  else//formato de incapacidad mayor a 5 dias
  {
$this->cuerpoformato2($fpdf,$solicitud,$hoy,$centro);
  }

$response=response($fpdf->Output("s"));
$response->header('Content-Type','application/pdf');
   return $response; 

}

public function cuerpoformato1($fpdf,$solicitud,$hoy,$centro)
{
$fpdf->SetFillColor(120,128,128);
$fpdf->Ln(5);
if($solicitud->i_tiemposolicitado==null)
  { 
   $tiempo=$solicitud->i_horas.":".$solicitud->i_minutos;
    $fpdf->Rect(80,55,10,5,'DF');}
else{
  $tiempo=$solicitud->i_tiemposolicitado." dias";
  $fpdf->Rect(80,55,10,5);}

$fpdf->Cell(100,$this->height+5,"HORAS",0,0,"C");

if($solicitud->i_tiemposolicitado!=null)
{
$fpdf->Rect(170,55,10,5,'DF');}
else{$fpdf->Rect(170,55,10,5);}

$fpdf->Cell(80,$this->height+5,"HASTA 5 DIAS",0,1,"C");
$fpdf->Ln(10);
$fpdf->SetFont('Helvetica','','10');

$fpdf->SetX(30);
$fpdf->Cell(40, $this->height+3, "LUGAR Y FECHA:", 0,0, 'L');
$fpdf->Cell(120, $this->height,utf8_decode($centro->ce_municipio->v_municipio).", ".$hoy,'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(40, $this->height+3, "CENTRO ESCOLAR:", 0,0, 'L');
$fpdf->Cell(120, $this->height,utf8_decode(strtolower($centro->v_nombrecentro)),'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(30, $this->height+3, "CODIGO INFRA:", 0,0, 'L');
$fpdf->Cell(50, $this->height,$centro->v_codigoinfraestructura,'B', 1,'C');
$fpdf->SetX(30);
$fpdf->Cell(30, $this->height+3, "MUNICIPIO:", 0,0, 'L');
$fpdf->Cell(50, $this->height+2, utf8_decode($centro->ce_municipio->v_municipio),'B', 1,'C');
$fpdf->SetX(30);
$fpdf->Cell(45, $this->height+2, "NOMBRE DEL DOCENTE:", 0, 0, 'L');
$fpdf->Cell(115, $this->height,utf8_decode($solicitud->empleado->v_nombres)." ".utf8_encode($solicitud->empleado->v_apellidos),'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(15, $this->height+3, "NIP:", 0, 0, 'L');
$fpdf->Cell(50, $this->height, $solicitud->empleado->v_nip,'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(45, $this->height+3, "MOTIVO DEL PERMISO:", 0, 0, 'L');
$fpdf->Cell(115, $this->height,utf8_decode($solicitud->motivoPermiso->v_motivo),'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(45, $this->height+3, "TIEMPO SOLICITADO:", 0, 0, 'L');
$fpdf->Cell(115, $this->height,$tiempo,'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(20, $this->height+3, "DESDE:", 0, 0, 'L');
$fpdf->Cell(60, $this->height,$solicitud->f_desde,'B', 0,'C');
$fpdf->Cell(20, $this->height+3, "HASTA:", 0, 0, 'L');
$fpdf->Cell(60, $this->height,$solicitud->f_hasta,'B', 1,'C');
$fpdf->Ln(10);

if($solicitud->motivoPermiso->v_motivo=='Cita médica')
  {$fpdf->Rect(60,142,10,5,'DF');}
else{$fpdf->Rect(60,142,10,5);}
$fpdf->Cell(70,$this->height+5,"CITA MEDICA",0,0,"C");
//$fpdf->Rect(60,142,10,5);

if($solicitud->motivoPermiso->v_motivo=='Enfermedad grave de parientes cercanos')
 {$fpdf->Rect(170,142,10,5,'DF');}
else{$fpdf->Rect(170,142,10,5);}
$fpdf->Cell(80,$this->height+5,"ENFERMEDAD GRAVE DE PARIENTES",0,1,"C");


if($solicitud->motivoPermiso->v_motivo == 'Incapacidad médica (hasta 5 dias)')
  {$fpdf->Rect(60,153,10,5,'DF');}
else{$fpdf->Rect(60,153,10,5);}
$fpdf->Cell(70,$this->height+5,"INCAPACIDAD",0,0,"C");
//$fpdf->Rect(170,153,10,5);


if($solicitud->motivoPermiso->v_motivo=='Duelo')
  {$fpdf->Rect(170,153,10,5,'DF');}
else{$fpdf->Rect(170,153,10,5);}
$fpdf->Cell(80,$this->height+5,"DUELO (PADRES,ESPOSO(A) O HIJOS)",0,1,"C");
//$fpdf->Rect(60,164,10,5);


if($solicitud->motivoPermiso->v_motivo=='Personal')
  {$fpdf->Rect(60,164,10,5,'DF');}
else{$fpdf->Rect(60,164,10,5);}
$fpdf->Cell(70,$this->height+5,"PERSONALES",0,0,"C");
//$fpdf->Rect(170,164,10,5);


if($solicitud->motivoPermiso->v_motivo=='Cumplimiento de misión')
  {$fpdf->Rect(170,164,10,5,'DF');}
else{$fpdf->Rect(170,164,10,5);}
$fpdf->Cell(80,$this->height+5,"CUMPLIMIENTO DE MISION",0,1,"C");


$fpdf->SetX(10);
if($solicitud->motivoPermiso->v_motivo=='Enfermedad')
  {$fpdf->Rect(60,174,10,5,'DF');}
else{$fpdf->Rect(60,174,10,5);}
$fpdf->Cell(70,$this->height+5,"ENFERMEDAD",0,0,"C");

if($solicitud->motivoPermiso->v_motivo=='Viajes')
  {$fpdf->Rect(170,174,10,5,'DF');}
else{$fpdf->Rect(170,174,10,5);}
$fpdf->Cell(80,$this->height+5,"VIAJES",0,1,"C");


if($solicitud->motivoPermiso->v_motivo=='Prórroga de incapacidad')
  {$fpdf->Rect(60,184,10,5,'DF');}
else{$fpdf->Rect(60,184,10,5);}
$fpdf->Cell(70,$this->height+5,"PRORROGA",0,0,"C");

if($solicitud->motivoPermiso->v_motivo=='Otros')
  {$fpdf->Rect(170,184,10,5,'DF');}
else{$fpdf->Rect(170,184,10,5);}
$fpdf->Cell(80,$this->height+5,"OTROS",0,1,"C");
$fpdf->Ln(10);


$fpdf->SetX(16);
if($solicitud->v_congocedesueldoSN=='S')
{$fpdf->Rect(75,206,10,5,'DF'); }
else{$fpdf->Rect(75,206,10,5);}
$fpdf->Cell(70,$this->height+5,"CON GOCE DE SUELDO",0,0,"C");

if($solicitud->v_congocedesueldoSN=='N')
{$fpdf->Rect(170,206,10,5,'DF'); }
else{$fpdf->Rect(170,206,10,5);}
//$fpdf->Rect(170,206,10,5);
$fpdf->Cell(60,$this->height+5,"SIN GOCE DE SUELDO",0,1,"C");

$fpdf->Ln(10);
$fpdf->SetX(30);
$fpdf->Cell(5, $this->height+3, "F:", 0, 0, 'L');
$fpdf->Cell(50, $this->height, "",'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(55, $this->height+3, "SOLICITANTE", 0, 0, 'C');


$fpdf->SetXY(110,225);
$fpdf->Cell(20, $this->height+3, "Autorizado:", 0, 0, 'L');
$fpdf->Cell(50, $this->height, "",'B', 1,'L');
$fpdf->SetXY(120,230);
$fpdf->Cell(65, $this->height+3, "NOMBRE, FIRMA Y SELLO", 0, 0, 'C');

$fpdf->Ln(20);
$fpdf->SetX(30);
$fpdf->SetFont('Helvetica','','6');
$fpdf->Cell(0, $this->height+3, "NOTA: ESTE FORMULARIO DEBE UTILIZARSE PARA UN MAXIMO DE 5 DIAS Y ANEXAR EL RESPECTIVO COMPROBANTE",0,0,'C');

}


public function cuerpoformato2($fpdf,$solicitud,$hoy,$centro)
{
$fpdf->SetFont('Helvetica','','8');
$fpdf->SetX(80);
$fpdf->Cell(70, $this->height, "",'B', 1,'C');
$fpdf->SetX(80);
$fpdf->Cell(70, $this->height, "LUGAR Y FECHA",'', 1,'C');
$fpdf->SetX(95);
$fpdf->Cell(70, $this->height-25,utf8_decode($centro->ce_municipio->v_municipio).", ".$hoy,0,'C');
$fpdf->Ln(5);
$fpdf->SetX(30);
$fpdf->Cell(40, $this->height+2, "NOMBRE DEL SOLICITANTE:", 0,0, 'L');
$fpdf->Cell(120, $this->height,utf8_decode($solicitud->empleado->v_nombres)." ".utf8_encode($solicitud->empleado->v_apellidos),'B', 1,'L');
$fpdf->SetX(30);
//dd($solicitud->v_dui);
$fpdf->Cell(10, $this->height+5,"NIP:", 0,0, 'L');
$fpdf->Cell(30, $this->height,$solicitud->empleado->v_nip,'B',0,'L');
$fpdf->Cell(10, $this->height+5, "DUI:",0,0, 'L');
$fpdf->Cell(30, $this->height, $solicitud->empleado->v_dui,'B', 0,'L');
$fpdf->Cell(10, $this->height+5,"NIT:", 0,0, 'L');
$fpdf->Cell(30, $this->height, $solicitud->empleado->v_nit,'B',0,'L');
$fpdf->Cell(10, $this->height+5, "NUP:",0,0, 'L');
$fpdf->Cell(30, $this->height,$solicitud->empleado->v_nup,'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(20, $this->height+5, "CATEGORIA:",0,0, 'L');
$fpdf->Cell(40, $this->height,$solicitud->empleado->v_categoriaescalafon,'B', 0,'L');
$fpdf->Cell(13, $this->height+5, "CARGO:", 0,0, 'L');
$fpdf->Cell(40, $this->height,$solicitud->empleado->cargo->v_descripcion,'B',0,'L');
$fpdf->Cell(17, $this->height+5, "PARTIDA:",0,0, 'L');
$fpdf->Cell(30, $this->height, "",'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(13, $this->height+5, "SUBNS:",0,0, 'L');
$fpdf->Cell(20, $this->height, "",'B', 0,'L');
$fpdf->Cell(10, $this->height+5, "NIVEL:", 0,0, 'L');
$fpdf->Cell(30, $this->height,$solicitud->empleado->v_nivelescalafon,'B',0,'L');
$fpdf->Cell(22, $this->height+5, "ESPECIALIDAD:",0,0, 'L');
$fpdf->Cell(65, $this->height,$solicitud->empleado->especialidad->v_especialidad,'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(30, $this->height+5, "CENTRO ESCOLAR:",0,0, 'L');
$fpdf->Cell(90, $this->height, strtolower($centro->v_nombrecentro),'B', 0,'L');
$fpdf->Cell(15, $this->height+5, "CANTON:", 0,0, 'L');
$fpdf->Cell(25, $this->height, "",'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(45, $this->height+5, "CODIGO INFRAESTRUCTURA:",0,0, 'L');
$fpdf->Cell(40, $this->height,$centro->v_codigoinfraestructura,'B', 0,'L');
$fpdf->Cell(25, $this->height+5, "JURISDICCION:", 0,0, 'L');
$fpdf->Cell(50, $this->height, "",'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(30, $this->height+5, "DEPARTAMENTO:",0,0, 'L');
$fpdf->Cell(55, $this->height,$centro->ce_municipio->departamentos->v_departamento,'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(0, $this->height+5, "SOLICITO A USTED CONCEDERME LICENCIA:",0,1, 'L');
$fpdf->SetX(30);
if($solicitud->v_congocedesueldoSN=="S"){
$fpdf->Cell(40, $this->height+10, "a) CON GOCE DE SUELDO",0,0, 'L');
$fpdf->Cell(40, $this->height+5, "X",'B', 0,'C');
$fpdf->Cell(40, $this->height+10, "b) SIN GOCE DE SUELDO", 0,0, 'L');
$fpdf->Cell(40, $this->height+5,"",'B', 1,'C');}

if($solicitud->v_congocedesueldoSN=="N"){
$fpdf->Cell(40, $this->height+10, "a) CON GOCE DE SUELDO",0,0, 'L');
$fpdf->Cell(40, $this->height+5, "",'B', 0,'C');
$fpdf->Cell(40, $this->height+10, "b) SIN GOCE DE SUELDO", 0,0, 'L');
$fpdf->Cell(40, $this->height+5,"X",'B', 1,'C');}


$fpdf->Ln(5);
$fpdf->SetX(30);
$fpdf->Cell(10, $this->height+5, "POR:",0,0, 'L');
$fpdf->Cell(40, $this->height,$solicitud->i_tiemposolicitado,'B', 0,'C');
$fpdf->Cell(30, $this->height+5, "DIAS  MOTIVO:", 0,0, 'L');
$fpdf->Cell(80, $this->height,utf8_decode($solicitud->motivoPermiso->v_motivo),'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(45, $this->height+5, "TIEMPO SOLICITADO DESDE:",0,0, 'L');

$formato = Carbon::createFromFormat('Y-m-d',$solicitud->f_desde);
 $solicitud->f_desde = $formato->format('d/m/Y');    
$fpdf->Cell(50, $this->height, $solicitud->f_desde,'B', 0,'L');

$formato = Carbon::createFromFormat('Y-m-d',$solicitud->f_hasta);
 $solicitud->f_hasta = $formato->format('d/m/Y');
$fpdf->Cell(15, $this->height+5, "HASTA:", 0,0, 'L');
$fpdf->Cell(50, $this->height,$solicitud->f_hasta,'B', 1,'L');
 $fpdf->SetX(30);
$fpdf->Cell(45, $this->height+5, "DIRECCION PARTICULAR:",0,0, 'L');
$fpdf->Cell(115, $this->height,utf8_decode($solicitud->empleado->v_direccioncasa),'B', 1,'L');
 $fpdf->SetX(30);
$fpdf->Cell(20, $this->height+5, "TELEFONO:",0,0, 'L');
$fpdf->Cell(50, $this->height,$solicitud->empleado->v_celular,'B', 1,'L'); 
 $fpdf->SetX(30);
$fpdf->Cell(60, $this->height+5, "FECHA DE INGRESO AL MAGISTERIO:",0,0, 'L');

$formato = Carbon::createFromFormat('Y-m-d',$solicitud->empleado->f_fechaingresoministerio);
 $fechaingreso = $formato->format('d/m/Y');


$fpdf->Cell(100, $this->height,$fechaingreso,'B', 1,'L');
 $fpdf->SetX(30);
$fpdf->Cell(30, $this->height+5, "OBSERVACIONES:",0,0, 'L');
$fpdf->Cell(130, $this->height,utf8_decode($solicitud->v_observaciones),'B', 1,'L'); 

$fpdf->Ln(70);
$fpdf->SetX(30);
$fpdf->Cell(5, $this->height+3, "F:", 0, 0, 'L');
$fpdf->Cell(50, $this->height, "",'B', 1,'L');
$fpdf->SetX(30);
$fpdf->Cell(55, $this->height+3, "SOLICITANTE", 0, 0, 'C');


$fpdf->SetXY(120,240);
$fpdf->Cell(5, $this->height+3, "F:", 0, 0, 'L');
$fpdf->Cell(50, $this->height, "",'B', 1,'L');
$fpdf->SetXY(120,245);
$fpdf->Cell(55, $this->height+3, "DIRECTOR CENTRO ESCOLAR", 0, 0, 'C');

}

}
