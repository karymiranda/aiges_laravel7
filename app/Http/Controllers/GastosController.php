<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccionesbono;
use App\Fondodisponible;
use App\Rubrogasto; 
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Http\Requests\GastosRequest;

class GastosController extends Controller
{
    
    public function index()
    {
        $cuentas=Fondodisponible::OrderBy('id','ASC')->pluck('descripcion','id');
    //    dd($datos);
    return view('admin.bonoescolar.movimientodefondos.gastos.listagastos')->with('cuentas',$cuentas);
    }

    public function listacuentasgastos(Request $request)
    {
    $id=$request->id;
    $datos=Transaccionesbono::OrderBy('id','ASC')->with('transaccion_fondodisponible')->with('transaccion_rubro')->whereHas('transaccion_fondodisponible', function ($q) use ($id){$q->where('id','=',$id);})->where('tipo_transaccion','like','GASTO')->get();
        return response()->json($datos); 
    }

    public function agregargastos(Request $request)
    {
     
        $fecha=Carbon::today();
        $fecha=$fecha->format('d/m/Y');
        $idejercicio=$request->idejercicio;
        $fondoactivobono=Fondodisponible::where('estatus','like','ACTIVO')->first(); 
       // dd($fondoactivobono);
        if(isset($request->opyfuncionamientoSN)) 
        { 
        if($fondoactivobono!=null){ 
          $transaccionbono=$request->opyfuncionamientoSN;
          $saldodisponible=Transaccionesbono::saldo($fondoactivobono->id);          
         //$saldodisponible=number_format($saldodisponible,2,'.',',');
        }
        else
        {
          Flash::warning('No se puede registrar transacciones en cuenta de operación funcionamiento.')->important();
          return redirect()->route('historialtransacciones');
        }

        }
        else{
          $transaccionbono=null;
         $saldodisponible=Transaccionesbono::saldobancos($idejercicio);
        // $saldodisponible=number_format($saldodisponible,2,'.',',');
//dd($saldodisponible);
            }
        $rubros=Rubrogasto::where('estado','=','1')->pluck('descripcion','id');


    return view('admin.bonoescolar.movimientodefondos.gastos.agregargasto')->with('rubros',$rubros)->with('fecha',$fecha)->with('idejercicio',$idejercicio)->with('saldodisponible',$saldodisponible)->with('transaccionbono',$transaccionbono);
    }

     public function guardargastos(GastosRequest $request)
    {
  //$id=$request->idejercicio;           
    $gasto=new Transaccionesbono($request->all()); 
$formato = Carbon::createFromFormat('d/m/Y',$request->fecha_transaccion);
$gasto->fecha_transaccion = $formato->format('Y-m-d'); 
    $gasto->tipo_transaccion='GASTO';
    $gasto->tipo_documento='CHEQUE';
    $gasto->ingreso='0';
    $gasto->ciclocontable_id=$request->idejercicio;
    $fondoactivobono=Fondodisponible::where('estatus','like','ACTIVO')->first();
if ($request->opyfuncionamientoSN!=null) {
 //dd('NO NULL');
    $gasto->fondodisponible_id=$fondoactivobono->id;
    $gasto->opyfuncionamientoSN='SI';
    $gasto->saldo=Transaccionesbono::saldo($fondoactivobono->id)-$request->gasto;//saldo segun la cuenta de bono
    }else{ 
    // dd('SI NULL');
     $gasto->fondodisponible_id=null;
     $gasto->opyfuncionamientoSN='NO'; 
     $gasto->saldo=Transaccionesbono::saldo($fondoactivobono->id);   
     }
    $gasto->saldo_bancos=Transaccionesbono::saldobancos($request->idejercicio)-$request->gasto; 
    // $gasto->saldo=Transaccionesbono::saldo($id)-$request->gasto;    
    $gasto->save();
    Flash::success("La transaccion  " . $gasto->concepto . " ha sido almacenada exitosamente")->important();
   return redirect()->route('historialtransacciones');
     
    }

    public function verdetallegastos($id)
    {        
       $gasto=Transaccionesbono::find($id);
       $formato = Carbon::createFromFormat('Y-m-d',$gasto->fecha_transaccion);
       $gasto->fecha_transaccion=$formato->format('d/m/Y');
       $saldodisponible=Transaccionesbono::saldo($gasto->fondodisponible_id);
       $rubros=Rubrogasto::where('estado','=','1')->pluck('descripcion','id');
       return view('admin.bonoescolar.movimientodefondos.gastos.vergasto')->with('gasto',$gasto)->with('saldodisponible',$saldodisponible)->with('rubros',$rubros);
    }
    public function editardetallegastos($id)
    {
       $gasto=Transaccionesbono::find($id);
       $fondoactivobono=Fondodisponible::where('estatus','like','ACTIVO')->first();
       $formato = Carbon::createFromFormat('Y-m-d',$gasto->fecha_transaccion);
       $gasto->fecha_transaccion=$formato->format('d/m/Y');

     $saldobono=Transaccionesbono::saldo($fondoactivobono->id);
     $saldobanco=Transaccionesbono::saldobancos($gasto->ciclocontable_id);

       $rubros=Rubrogasto::where('estado','=','1')->pluck('descripcion','id');
       return view('admin.bonoescolar.movimientodefondos.gastos.editargasto')->with('gasto',$gasto)->with('saldobono',$saldobono)->with('saldobanco',$saldobanco)->with('rubros',$rubros);
    }

    public function actualizargastos(GastosRequest $request)
    {   
    $gasto=Transaccionesbono::find($request->id);    
    $fondoactivobono=Fondodisponible::where('estatus','like','ACTIVO')->first();
    $tipotransaccionanterior=$gasto->opyfuncionamientoSN;//saber si era gasto de bono o general
    $montoanterior=$gasto->gasto;
     // dd($request); 
    $gasto->fill($request->all());   
    $formato= Carbon::createFromFormat('d/m/Y',$request->fecha_transaccion);
    $gasto->fecha_transaccion = $formato->format('Y-m-d'); 
 

if($tipotransaccionanterior=="NO" and !isset($request->opyfuncionamientoSN))//si transaccion anterior no era general y hoy sera bono
{
// dd("era general y sera general ok");
 $gasto->rubro_id=null;
 $gasto->save();
 //$nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($gasto->ciclocontable_id);
}
else 
 if($tipotransaccionanterior=="NO" and isset($request->opyfuncionamientoSN))
{ 
 // dd("era  general y sera bono");
  $gasto->opyfuncionamientoSN="SI";
  $gasto->fondodisponible_id=$fondoactivobono->id; 
  $gasto->rubro_id=$request->rubro_id;
  $gasto->save();
 // $nuevossaldos[]=Transaccionesbono::recalcularsaldo($gasto->fondodisponible_id);
  //$nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($gasto->ciclocontable_id);
  //dd($gasto);

}else 
 if($tipotransaccionanterior=="SI" and !isset($request->opyfuncionamientoSN))
{ 
  //dd("era  bono y sera general ");
  $gasto->opyfuncionamientoSN="NO";
  $gasto->fondodisponible_id=null; 
  $gasto->rubro_id=null;
  $gasto->save();
//$nuevossaldos[]=Transaccionesbono::recalcularsaldo($gasto->fondodisponible_id);
//$nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($gasto->ciclocontable_id);
}else 
 if($tipotransaccionanterior=="SI" and isset($request->opyfuncionamientoSN))
{ 
// dd("era  bono y sera bono  ok"); 
$gasto->opyfuncionamientoSN="SI";
$gasto->save();
//$nuevossaldos[]=Transaccionesbono::recalcularsaldo($gasto->fondodisponible_id);
//$nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($gasto->ciclocontable_id);
}
if($gasto->fondodisponible_id!=null)
       {
$nuevossaldos[]=Transaccionesbono::recalcularsaldo($gasto->fondodisponible_id);
}
$nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($gasto->ciclocontable_id);

    Flash::success("La transacción " . $gasto->concepto . " ha sido actualizada exitosamente")->important();
        return redirect()->route('historialtransacciones');   
    }

    public function eliminargasto($id)
    {
       $gasto=Transaccionesbono::find($id);
       $datos=$gasto;  
       $gasto->delete();
       if($datos->fondodisponible_id!=null)
       {
        $nuevossaldos[]=Transaccionesbono::recalcularsaldo($datos->fondodisponible_id);
       }        
       $nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($datos->ciclocontable_id);

Flash::error("La transacción " . $datos->concepto. " ha sido eliminada exitosamente")->important();
return redirect()->route('historialtransacciones');
    }
}
