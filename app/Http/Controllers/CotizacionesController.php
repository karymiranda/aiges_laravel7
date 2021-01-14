<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cotizacion;
use App\Proveedor;
use App\Detallecotizacion;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

class CotizacionesController extends Controller
{
    public function index()
	{
	$listacotizaciones= Cotizacion::orderBy('v_numerocotizacion','ASC')->where('estado','=','1')->get();
	
	$listacotizaciones->each(function($listacotizaciones){$listacotizaciones->cotizacionproveedor;});
	return view('admin.bonoescolar.cotizaciones.listacotizaciones')->with('cotizaciones',$listacotizaciones);	
	}
	public function agregarcotizacion()
	{
		$cotizaciones=Cotizacion::all();
		$fecha=Carbon::today();
		$fecha=$fecha->format('d/m/Y');
		//dd($fecha);
		$cod=($cotizaciones->count())+1;
		//$listaproveedores=Proveedor::orderBy('id','ASC')->where('estado','=','1')->pluck('v_nombreproveedor','id');
		return view('admin.bonoescolar.cotizaciones.agregarcotizacion')->with('correlativo',$cod)->with('fecha',$fecha);	
	}

	public function agregardetallecotizacion($id)
	{
		
$cotizaciondetalle=Detallecotizacion::orderBy('id','ASC')->where('cotizacion_id','=',$id)->get();
//dd($id);
$datoscotizacion=Cotizacion::find($id);
$datoscotizacion->each(function($datoscotizacion){
$datoscotizacion->cotizacionproveedor;
});
//dd($datoscotizacion);
return view('admin.bonoescolar.cotizaciones.agregardetallecotizacion')->with('cotizaciondetalle',$cotizaciondetalle)->with('id',$id)->with('datoscotizacion',$datoscotizacion);	
	}


	public function guardarcotizacion(Request $request)
{
$nuevacotizacion=new Cotizacion($request->all());
$nuevacotizacion->v_estadoentrega='pendiente';
$nuevacotizacion->estado='1';
$fecha1=Carbon::createFromFormat('d/m/Y',$request->f_fechaelaboracion);
$nuevacotizacion->f_fechaelaboracion=$fecha1->Format('Y/m/d');
$fecha2=Carbon::createFromFormat('d/m/Y',$request->f_fecharecepcion);
$nuevacotizacion->f_fecharecepcion=$fecha2->Format('Y/m/d');
$nuevacotizacion->save();
return redirect()->route('agregardetallecotizacion',$nuevacotizacion->id);
}

public function detallecotizacion($id)
{

$cotizaciondetalle=Detallecotizacion::orderBy('id','ASC')->where('cotizacion_id','=',$id)->get();
return view('admin.bonoescolar.cotizaciones.ingresardetallecotizacion')->with('cotizaciondetalle',$cotizaciondetalle)->with('id',$id);	
}

public function guardardetallecotizacion(Request $request,$id)
{
$cotizacion=Cotizacion::find($id);

	$detallecotizaciones=new Detallecotizacion($request->all());
	$detallecotizaciones->cotizacion_id=$id;
	$detallecotizaciones->save();
return redirect()->route('agregardetallecotizacion',$detallecotizaciones->cotizacion_id);

}

public function borrardetallecotizacion($id)
{
	
	$detalleaborrar=Detallecotizacion::find($id);
	$iden=$detalleaborrar->cotizacion_id;
	$detalleaborrar->delete();
	return redirect()->route('agregardetallecotizacion',$iden);

}


public function borrarcotizacion($id)
{
	$coti=Cotizacion::find($id);
	//$coti->delete();
	$coti->estado=0;
	$coti->save();
	Flash::error('Cotizacion eliminada exitosamente')->important();
	return redirect()->route('listacotizaciones');

}

	public function editarcotizacion($id)
	{
		$cotizacion=Cotizacion::find($id);
		//$pos=(integer) $cotizacion->proveedor_id;
		//$listaproveedores=Proveedor::orderBy('id','ASC')->where('estado','=','1')->pluck('v_nombreproveedor','id');
		return view('admin.bonoescolar.cotizaciones.editarcotizacion')->with('cotizacion',$cotizacion);	
	}


	public function actualizarcotizacion(Request $request, $id)
	{
$cotizacion=Cotizacion::find($id);
$cotizacion->v_numerocotizacion=$request->v_numerocotizacion;
$cotizacion->f_fechaelaboracion=$request->f_fechaelaboracion;
$cotizacion->f_fecharecepcion=$request->f_fecharecepcion;
$cotizacion->v_descripcion=$request->v_descripcion;
//$cotizacion->proveedor_id=$request->proveedor_id;
$cotizacion->v_estadoentrega=$request->v_estadoentrega;
$cotizacion->estado='1';
$cotizacion->save();
	return redirect()->route('agregardetallecotizacion',$cotizacion->id);
	}

	public function editardetallecotizacion($id)
	{
		$cotizacionidentificador=Cotizacion::find($id);
		$recupdetallecotizacion=Detallecotizacion::all()->where('cotizacion_id','=',$cotizacionidentificador->id);
		return view('admin.bonoescolar.cotizaciones.editardetallecotizacion')->with('recupdetallecotizacion',$recupdetallecotizacion);
	}


	public function vercotizacion($id)
	{		
$datoscotizacion=Cotizacion::find($id);
$datoscotizacion->each(function($datoscotizacion){
$datoscotizacion->cotizacionproveedor;
});
$verdetallecotizacion=Detallecotizacion::all()->where('cotizacion_id','=',$datoscotizacion->id);
		return view('admin.bonoescolar.cotizaciones.vercotizacion')->with('datoscotizacion',$datoscotizacion)->with('verdetallecotizacion',$verdetallecotizacion);	
	}


}
