<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoPermisosRequest;

use App\TipoPermiso;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class TipopermisorhController extends Controller
{
    public function index()
	{
		$tiposPermisos = TipoPermiso::orderBy('id','ASC')->where('estado','=','1')->get();
		return view('admin.configuraciones.recursohumano.permisos.listatipopermisosrh')->with('tipos',$tiposPermisos);		
	}
	
	public function creartipopermisos()
	{
		$cont = TipoPermiso::count();
		if($cont!=0){
			$tipos = TipoPermiso::all();
			$codigo = $tipos->Last()->id+1;
		}else{
			$codigo = 1;
		}
		
		return view('admin.configuraciones.recursohumano.permisos.creartipopermisosrh')->with('codigo',$codigo);		
	}

	public function editartipopermisos($id)
	{
		$tipo = TipoPermiso::find($id);
		return view('admin.configuraciones.recursohumano.permisos.editartipopermisosrh')->with('tipo',$tipo);		
	}

	public function agregartipopermisos(TipoPermisosRequest $Request)
	{
		$tipo = new TipoPermiso($Request->all());
		$tipo->save();
		Flash::success("El tipo de permiso " . $tipo->v_descripcion . " ha sido guardado")->important();
		return redirect()->route('listatipopermisosrh');		
	}

	public function actualizartipopermisos(TipoPermisosRequest $request, $id)
	{
		$tipo = TipoPermiso::find($id);
		$tipo->fill($request->all());
		$tipo->save();
		Flash::success("El tipo de permiso " . $tipo->v_descripcion . " ha sido actualizado")->important();
		return redirect()->route('listatipopermisosrh');		
	}

	public function eliminartipopermisos($id)
	{
		$tipo = TipoPermiso::find($id);
		$tipo->estado = 0;
		$tipo->save();
		Flash::error("El tipo de permiso " . $tipo->v_descripcion . " ha sido eliminado")->important();
		return redirect()->route('listatipopermisosrh');
	}
}
