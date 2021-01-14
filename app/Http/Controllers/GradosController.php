<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GradosRequest;
use App\Grados;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class GradosController extends Controller
{
   public function index()
	{
		$grados=Grados::orderBy('grado')->where('estado','=','1')->get();
		//dd($grados);
    return view('admin.configuraciones.administracionacademica.grados.listagrados')->with('grados',$grados);
	}
 
public function agregargrado()
	{
		return view('admin.configuraciones.administracionacademica.grados.agregargrado');
	}

	public function guardargrado(GradosRequest $request)
	{
		$grado=new Grados($request->all());
		$grado->estado='1';
		$grado->save();
		Flash::success("El grado " . $grado->grado . " ha sido creado exitosamente")->important();
		return redirect()->route('listagrados');
    
	}

	public function editargrado($id)
	{
		$grado=Grados::find($id);
		return view('admin.configuraciones.administracionacademica.grados.editargrado')->with('grado',$grado);
	}

	public function actualizargrado(GradosRequest $request, $id)
	{
		$grado=Grados::find($id);
		$grado->fill($request->all());
		$grado->save();
		Flash::warning("El grado " . $grado->grado . " ha sido actualizado exitosamente")->important();
		return redirect()->route('listagrados');
	}

	public function desactivargrado( $id)
	{
		$grado=Grados::find($id);
$grado->estado=0;
$grado->save();
Flash::error('El grado '.$grado->grado.' a sido eliminado exitosamente')->important();
return redirect()->route('listagrados');
		}

	
   }
