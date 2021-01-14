<?php

namespace App\Http\Controllers;

use App\InstitucionesDestino;
use App\Http\Requests\InstitucionesRequest;
use Laracasts\Flash\Flash;

class InstitucionesDestinoController extends Controller
{
    public function index()
	{
		$instituciones = InstitucionesDestino::orderBy('codigo_institucion','ASC')->where('estado','=','1')->get();
		return view('admin.configuraciones.activofijo.institucionesdestino.listainstituciones')->with('instituciones',$instituciones);		
	}

	public function crearinstitucion()
	{
		return view('admin.configuraciones.activofijo.institucionesdestino.crearinstitucion');		
	}

	public function editarinstitucion($id)
	{
		$institucion = InstitucionesDestino::find($id);
		return view('admin.configuraciones.activofijo.institucionesdestino.editarinstitucion')->with('institucion',$institucion);		
	}

	public function verinstitucion($id)
	{
		$institucion = InstitucionesDestino::find($id);
		return view('admin.configuraciones.activofijo.institucionesdestino.verinstitucion')->with('institucion',$institucion);		
	}

	public function actualizarinstitucion(InstitucionesRequest $request, $id)
	{
		$institucion = InstitucionesDestino::find($id);
		$institucion->fill($request->all());
		$institucion->save();
		Flash::success("La institucion " . $institucion->nombre_institucion . " ha sido actualizada")->important();
		return redirect()->route('listainstituciones');		
	}

	public function eliminarinstitucion($id)
	{
		$institucion = InstitucionesDestino::find($id);
		$institucion->estado = 0;
		$institucion->save();
		Flash::error("La institucion " . $institucion->nombre_institucion . " ha sido eliminada")->important();
		return redirect()->route('listainstituciones');
	}

	public function agregarinstitucion(InstitucionesRequest $Request)
	{
		$institucion = new InstitucionesDestino($Request->all());
		$institucion->save();
		Flash::success("La institucion " . $institucion->nombre_institucion . " ha sido guardada")->important();
		return redirect()->route('listainstituciones');		
	}

}
