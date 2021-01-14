<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fondodisponible;
use App\Transaccionesbono;
use App\Http\Requests\FondodisponibleRequest;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class FondodisponibleController extends Controller
{
    public function index()
    {
    	$datos=Fondodisponible::orderBy('id','ASC')->get();
    	$mostrarboton=Fondodisponible::where('estatus','like','ACTIVO')->count();
    	//dd($mostrarboton);
    	return view('admin.configuraciones.bonoescolar.fondosdisponibles.listadepositodefondos')->with('datos',$datos)->with('mostrarboton',$mostrarboton);
    }

    public function agregarregistrodefondo()
    {
return view('admin.configuraciones.bonoescolar.fondosdisponibles.agregarregistrodefondo');
    }
    public function guardaregistrodefondo(FondodisponibleRequest $request)
    {
$datos=new Fondodisponible($request->all()); 
$datos->estatus="ACTIVO";
$datos->save();
Flash::success( $datos->descripcion . " ha sido creado exitosamente")->important();
		return redirect()->route('listadepositodefondos');
    }

    public function editarregistrodefondo($id)
    {
$datos=Fondodisponible::find($id);
return view('admin.configuraciones.bonoescolar.fondosdisponibles.editarregistrodefondo')->with('datos',$datos);
    }

    public function actualizarregistrodefondo(FondodisponibleRequest $request)
    {

$datos=Fondodisponible::find($request->id);
//dd($request);
$datos->fill($request->all());
$datos->save();
 Flash::success($datos->descripcion . " ha sido actualizado exitosamente")->important();
        return redirect()->route('listadepositodefondos'); 
    }

    public function eliminarregistrodefondo($id)
    {
 $datos=Fondodisponible::find($id);
 $titulo=$datos->descripcion;
 $contador=Fondodisponible::find($id)->fondos_transacciones()->count();

 if($contador==0)//no hay registros relacionados en la tabla de transacciones, entonces borre
  {
$datos = Fondodisponible::find($id)->delete();
Flash::success($titulo . " eliminado exitosamente")->important();
    return redirect()->route('listadepositodefondos');
  } 
  else
  {
Flash::error($titulo . "  No puede eliminarse ya que cuenta con transacciones registradas en la base de datos")->important();
    return redirect()->route('listadepositodefondos');
  }

 }

  public function liquidarfondo($id)
    {
$datos=Fondodisponible::find($id);
$datos->estatus='LIQUIDADO';
$datos->save();
Flash::success($datos->descripcion . " liquidado exitosamente")->important();
    return redirect()->route('listadepositodefondos');

    }
}
