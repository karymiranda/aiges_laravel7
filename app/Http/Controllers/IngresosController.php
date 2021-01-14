<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccionesbono;
use App\Fondodisponible;
use App\Http\Requests\IngresoRequest;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class IngresosController extends Controller
{
    public function index()
    {
      $cuentas=Fondodisponible::OrderBy('id','ASC')->pluck('descripcion','id');

    return view('admin.bonoescolar.movimientodefondos.ingresos.listadeingresos')->with('cuentas',$cuentas);
    }
    public function listacuentasingresos(Request $request)
    {
    $id=$request->id;
    $datos=Transaccionesbono::OrderBy('id','ASC')->with('transaccion_fondodisponible')->with('transaccion_rubro')->whereHas('transaccion_fondodisponible', function ($q) use ($id){$q->where('id','=',$id);})->where('tipo_transaccion','like','INGRESO')->get();
        return response()->json($datos); 
    }

    public function agregaringresos(Request $request)
    {
     // dd($request);
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
        else{$transaccionbono=null;}

   return view('admin.bonoescolar.movimientodefondos.ingresos.agregaringreso')->with('fecha',$fecha)->with('idejercicio',$idejercicio)->with('transaccionbono',$transaccionbono);
    }


    public function guardaringresos(IngresoRequest $request)
    {
    // dd($request);
    $id=$request->idejercicio;           
    $ingreso=new Transaccionesbono($request->all()); 
    $formato = Carbon::createFromFormat('d/m/Y',$request->fecha_transaccion);
    $ingreso->fecha_transaccion = $formato->format('Y-m-d'); 
    $ingreso->tipo_transaccion='INGRESO';
    $ingreso->tipo_documento='NA';
    $ingreso->numero_cheque=null;
    $ingreso->a_favor_de=null;
    $ingreso->gasto='0';
    $ingreso->rubro_id=null;
    $ingreso->ciclocontable_id=$id;
    $fondoactivobono=Fondodisponible::where('estatus','like','ACTIVO')->first();
    if ($request->opyfuncionamientoSN!=null) {
 //dd('NO NULL');
    $ingreso->fondodisponible_id=$fondoactivobono->id;
    $ingreso->opyfuncionamientoSN='SI';
     $ingreso->saldo=Transaccionesbono::saldo($fondoactivobono->id)+$request->ingreso;//saldo segun la cuenta de bono
    }else{ 
     // dd('SI NULL');
    $ingreso->fondodisponible_id=null;
     $ingreso->opyfuncionamientoSN='NO'; 
     $ingreso->saldo=Transaccionesbono::saldo($fondoactivobono->id);
     }
  $ingreso->saldo_bancos=Transaccionesbono::saldobancos($id)+$request->ingreso;  
    $ingreso->save();
        Flash::success("La transaccion  " . $ingreso->concepto . " ha sido almacenada exitosamente")->important();
   return redirect()->route('historialtransacciones');
    }

    public function verdetalleingresos($id)
    {
       $ingreso=Transaccionesbono::find($id);
       $formato = Carbon::createFromFormat('Y-m-d',$ingreso->fecha_transaccion);
       $ingreso->fecha_transaccion=$formato->format('d/m/Y');
       return view('admin.bonoescolar.movimientodefondos.ingresos.veringreso')->with('ingreso',$ingreso);
    }
    public function editardetalleingresos($id)
    {
       $ingreso=Transaccionesbono::find($id);
       $formato = Carbon::createFromFormat('Y-m-d',$ingreso->fecha_transaccion);
       $ingreso->fecha_transaccion=$formato->format('d/m/Y');
       return view('admin.bonoescolar.movimientodefondos.ingresos.editaringreso')->with('ingreso',$ingreso);
    }
    public function actualizardetalleingresos(IngresoRequest $request)
    {
   // dd($request->id);
    $ingreso=Transaccionesbono::find($request->id);  
    $montoanterior=$ingreso->ingreso;  
    $ingreso->fill($request->all());   
    $formato= Carbon::createFromFormat('d/m/Y',$request->fecha_transaccion);
    $ingreso->fecha_transaccion = $formato->format('Y-m-d');  
    $ingreso->save();
     if(isset($request->opyfuncionamientoSN))//SI ES TRANSACCION DE CUENTA BONO
     {
     if($montoanterior!=$ingreso->ingreso)//SI HA CAMBIADO EL MONTO DE INGRESO VA A LLAMAR EL RECALCULO DE SALDOS BONO Y AL SALDO DEL LIBRO BANCOS
    {   
     
       $nuevossaldos[]=Transaccionesbono::recalcularsaldo($ingreso->fondodisponible_id);
       $nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($ingreso->ciclocontable_id);
    } 
     }
     else//NO ES TRANSACCION DE CUENTA BONO
     { 
        if($montoanterior!=$ingreso->ingreso)//SI HA CAMBIADO EL MONTO DE INGRESO VA A LLAMAR EL RECALCULO DE SALDOS BANCOS , SI NO NO LO LLAMA
    {
       $nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($ingreso->ciclocontable_id);//RECALCULAR SALDOS Y ACTUALIZAR TRANSACCIONES
    } 
     }
  
    Flash::success("La transacción " . $ingreso->concepto . " ha sido actualizada exitosamente")->important();
        return redirect()->route('historialtransacciones');   
  
    }

    public function eliminaringreso($id)
    {
       $ingreso=Transaccionesbono::find($id);
       $datos=$ingreso;  
       $ingreso->delete();
       if($datos->fondodisponible_id!=null)
       {
        $nuevossaldos[]=Transaccionesbono::recalcularsaldo($datos->fondodisponible_id);
       }        
       $nuevossaldos[]=Transaccionesbono::recalcularsaldobancos($datos->ciclocontable_id);

Flash::error("La transacción " . $datos->concepto . " ha sido eliminada exitosamente")->important();
return redirect()->route('historialtransacciones');
    }

}
