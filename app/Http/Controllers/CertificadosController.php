<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \Codedge\Fpdf\Fpdf\Fpdf;

class CertificadosController extends Controller
{
    public function generarcertificados($seccion_id,$formato)
{

$fpdf = new Fpdf("L", "mm", "Letter");//ORIENTACION DE LA PAGINA p es vrtical l horizontal
$fpdf->AddPage(); 

switch ($formato) {
	case '2':
	
		break;

	case '3':
		
		break;

	case '4': 
		dd('9');
		break;

	
	default:
		# code...
		break;
}

$fpdf->SetTitle("certificados".date('_Ymd'));
$response=response($fpdf->Output("s"));  
$response->header('Content-Type','application/pdf'); 
return $response;


}
}
