<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Transaccionesbono;
use App\Rubrogasto;
use App\Fondodisponible;
use App\Periodoactivo;
use App\Http\Requests\DocumentonuloRequest;
use Validator; 
use Response;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class TransaccionesbonoController extends Controller
{
    public function index()
    {
 // $datos=Transaccionesbono::OrderBy('id','ASC')->with('transaccion_fondodisponible')->whereHas('transaccion_fondodisponible', function ($q){$q->where('estatus','like','ACTIVO');})->get();

 $ejercicio=Periodoactivo::where([['tipo_periodo','like','CONTABLE'],['estado','1']])->first();
 $fondoactivobono=Fondodisponible::where('estatus','like','ACTIVO')->first();
 $fondodisponible_id=Fondodisponible::where('estatus','like','ACTIVO')->pluck('descripcion','id');    
if(empty($ejercicio))//SI NO HAY FONDO ACTIVO
  {
    Flash::error("No es posible acceder al historial de transacciones operación y funcionamiento.  Debe haber un fondo activo para continuar.")->important();
    return redirect()->route('menu');
  }
else{//SI HAY FONDO ACTIVO
  $datos=Transaccionesbono::OrderBy('id','ASC')->where('ciclocontable_id',$ejercicio->id)->get(); 
  return view('admin.bonoescolar.transacciones.historialtransacciones')->with('datos',$datos)->with('ejercicio',$ejercicio)->with('fondodisponible_id',$fondodisponible_id);
    }
    }

    public function agregardocumentonulo(Request $request)
    {  
        $fecha=Carbon::today();
        $fecha=$fecha->format('d/m/Y');
        $idejercicio=$request->idejercicio;
         if(isset($request->opyfuncionamientoSN))
          {
            $transaccionbono=$request->opyfuncionamientoSN;
            $fondoactivobono=Fondodisponible::where('estatus','like','ACTIVO')->first();
          if($fondoactivobono==null)
          {       
        Flash::warning('No se puede registrar transacciones en cuenta de operación funcionamiento.')->important();
          return redirect()->route('historialtransacciones');
        }
        }
        else
          {$transaccionbono=null;}
      return view('admin.bonoescolar.movimientodefondos.documentonulo.agregardocumentonulo')->with('fecha',$fecha)->with('idejercicio',$idejercicio)->with('transaccionbono',$transaccionbono); 
    }

    public function guardardocumentonulo(DocumentonuloRequest $request)
    { 
    $id=$request->idejercicio;           
    $documento=new Transaccionesbono($request->all()); 
    $formato = Carbon::createFromFormat('d/m/Y',$request->fecha_transaccion);
    $documento->fecha_transaccion = $formato->format('Y-m-d'); 
    $documento->tipo_transaccion='ANULADO';
    $documento->tipo_documento='CHEQUE';
    $documento->concepto='CHEQUE NULO';
    $documento->a_favor_de=null;
    $documento->gasto='0';
    $documento->ingreso='0';
    $documento->rubro_id=null;
    $documento->ciclocontable_id=$id;
    $fondoactivobono=Fondodisponible::where('estatus','like','ACTIVO')->first();
if ($request->opyfuncionamientoSN!=null) {
 //dd('NO NULL');
    $documento->fondodisponible_id=$fondoactivobono->id;
    $documento->opyfuncionamientoSN='SI';
    }else{ 
    // dd('SI NULL');
     $documento->fondodisponible_id=null;
     $documento->opyfuncionamientoSN='NO'; 
     }

    $documento->saldo=Transaccionesbono::saldo($fondoactivobono->id);   
    $documento->saldo_bancos=Transaccionesbono::saldobancos($id);//saldo segun la cuenta de bono
    $documento->save();
        Flash::success("Cheque nulo registrado exitosamente")->important();
   return redirect()->route('historialtransacciones');
    }

public function editardocumentonulo($id)
    {
      $documento=Transaccionesbono::find($id); 
       $formato = Carbon::createFromFormat('Y-m-d',$documento->fecha_transaccion);
       $documento->fecha_transaccion=$formato->format('d/m/Y');
       return view('admin.bonoescolar.movimientodefondos.documentonulo.editarchequenulo')->with('documento',$documento);
    }

    public function actualizardocumentonulo(DocumentonuloRequest $request)
    {
$documento=Transaccionesbono::find($request->id);
$documento->fill($request->all());
$formato= Carbon::createFromFormat('d/m/Y',$request->fecha_transaccion);
$documento->fecha_transaccion = $formato->format('Y-m-d');
$documento->save();
 Flash::success("La transacción " . $documento->concepto . " ha sido actualizada exitosamente")->important();
 return redirect()->route('historialtransacciones');  
    }

    public function vertransaccion($id)
    {
       $transaccion=Transaccionesbono::find($id);
       //dd($transaccion);
       switch ($transaccion->tipo_transaccion)
        {
           case 'INGRESO':
               return redirect()->route('verdetalleingresos',$transaccion->id);
               break;
           case 'GASTO':
               return redirect()->route('verdetallegastos',$transaccion->id);
               break;
               case 'ANULADO':
               return redirect()->route('historialtransacciones');# code...
               break;
       }
       
    }

     public function editartransaccion($id)
    {
       $transaccion=Transaccionesbono::find($id);
       //dd($transaccion);
       switch ($transaccion->tipo_transaccion)
        {
           case 'INGRESO':
               return redirect()->route('editardetalleingresos',$transaccion->id);
               break;
           case 'GASTO':
               return redirect()->route('editardetallegastos',$transaccion->id);
               break;
               case 'ANULADO':
               return redirect()->route('editardocumentonulo',$transaccion->id);# code...
               break;
       }
       
    }

    public function eliminartransaccion($id)
{
$transaccion=Transaccionesbono::find($id);
switch ($transaccion->tipo_transaccion)
        {
           case 'INGRESO':
               return redirect()->route('eliminaringreso',$transaccion->id);
               break;
           case 'GASTO':
               return redirect()->route('eliminargasto',$transaccion->id);
               break;
               case 'ANULADO':
               return redirect()->route('eliminardocumentonulo',$transaccion->id);# code...
               break;
       }
}

  public function eliminardocumentonulo($id)
    {
      $gasto=Transaccionesbono::find($id); 
      $concepto=$gasto->concepto;
      $gasto->delete();
      Flash::error("La transacción " . $concepto . " ha sido eliminada exitosamente")->important();
return redirect()->route('historialtransacciones');
    }

}
