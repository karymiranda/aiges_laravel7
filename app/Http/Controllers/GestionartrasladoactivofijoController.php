<?php

namespace App\Http\Controllers;

use App\TrasladosActivo;
use App\InstitucionesDestino;
use App\ActivoFijo;
use App\RetornosActivo;
use App\InfoCentroEducativo;
use App\TipoTrasladoActivo;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests\TrasladoActivoRequest;
use App\Http\Requests\RetornoActivoRequest;

class GestionartrasladoactivofijoController extends Controller
{
    public function index()
	{
		$traslados = TrasladosActivo::select('*')->from('tb_trasladoactivofijo as t')->orderBy('id','ASC')->whereNotExists(function($query)
            {
                $query->select('id')
                      ->from('tb_retornoactivo as r')
                      ->whereRaw('t.id = r.traslado_id');
            })->whereRaw('t.v_estado = 1')->get();
            
		foreach($traslados as $traslado)
	    {
		    $formato = Carbon::createFromFormat('Y-m-d',$traslado->f_fechatraslado);
		    $traslado->f_fechatraslado = $formato->format('d/m/Y');
	    }
	    $traslados->each(function($traslados){ 
			$traslados->activofijo;
			$traslados->tipotraslado;
			$traslados->destino;
		});
	    return view('admin.activofijo.traslados.gestionartraslado')->with('traslados',$traslados);	
	}

	 public function creartraslado()
	{
		$activos = ActivoFijo::orderBy('v_codigoactivo','ASC')->where([['v_estado','=','1'],['v_trasladadoSN','=','N']])->get();
		$activos->each(function($activos){ 
			$activos->cuentacatalogo;
		});
		$tipotraslado=TipoTrasladoActivo::orderBy('id','ASC')->pluck('v_descripcion','id');
		$procedencia = InfoCentroEducativo::find(1);
		$destinos = InstitucionesDestino::orderBy('codigo_institucion','ASC')->where('estado','=','1')->get();
		//dd($activos->first());
		return view('admin.activofijo.traslados.agregartraslado')->with('activos',$activos)->with('tipotraslado',$tipotraslado)->with('procedencia',$procedencia)->with('destinos',$destinos);
	}

	public function guardartraslado(TrasladoActivoRequest $Request)
	{
		$traslado = new TrasladosActivo($Request->all());
		$activo = ActivoFijo::find($traslado->activo_id);
		$activo->v_trasladadoSN = 'S';
		$activo->save();
		$formato = Carbon::createFromFormat('d/m/Y',$traslado->f_fechatraslado);
		$traslado->f_fechatraslado = $formato->format('Y/m/d');
		$traslado->v_estado=1;
		$traslado->save();
		Flash::success("El activo " . $activo->v_codigoactivo . " ha sido trasladado")->important();
		return redirect()->route('listatraslado');		
	}

	public function verdetalletraslado($id)
	{
		$traslado = TrasladosActivo::find($id);
		$traslado->each(function($traslado){ 
			$traslado->activofijo;
			$traslado->procedencia;
			$traslado->destino;
		});
		$tipotraslado=TipoTrasladoActivo::orderBy('id','ASC')->pluck('v_descripcion','id');
		$formato = Carbon::createFromFormat('Y-m-d',$traslado->f_fechatraslado);
		$traslado->f_fechatraslado = $formato->format('d/m/Y');
		return view('admin.activofijo.traslados.verdetalletraslado')->with('traslado',$traslado)->with('tipotraslado',$tipotraslado);
	}

	public function editartraslado($id)
	{
		$traslado = TrasladosActivo::find($id);
		$traslado->each(function($traslado){ 
			$traslado->activofijo;
			$traslado->procedencia;
			$traslado->destino;
		});
		$tipotraslado=TipoTrasladoActivo::orderBy('id','ASC')->pluck('v_descripcion','id');
		$formato = Carbon::createFromFormat('Y-m-d',$traslado->f_fechatraslado);
		$traslado->f_fechatraslado = $formato->format('d/m/Y');
		$destinos = InstitucionesDestino::orderBy('codigo_institucion','ASC')->where('estado','=','1')->get();
		$activos = ActivoFijo::orderBy('v_codigoactivo','ASC')->where([['v_estado','=','1'],['v_trasladadoSN','=','N']])->get();
		$activos->each(function($activos){ 
			$activos->cuentacatalogo;
		});
		return view('admin.activofijo.traslados.editartraslado')->with('activos',$activos)->with('destinos',$destinos)->with('traslado',$traslado)->with('tipotraslado',$tipotraslado);
	}

	public function actualizartraslado(TrasladoActivoRequest $Request,$id)
	{
		$traslado = TrasladosActivo::find($id);
		if($traslado->activo_id!=$Request->activo_id){
			$activoOld = ActivoFijo::find($traslado->activo_id);
			$activoOld->v_trasladadoSN = 'N';
			$activoOld->save();
		}
		$traslado->fill($Request->all());
		$activo = ActivoFijo::find($traslado->activo_id);
		$activo->v_trasladadoSN = 'S';
		$activo->save();
		$formato = Carbon::createFromFormat('d/m/Y',$traslado->f_fechatraslado);
		$traslado->f_fechatraslado = $formato->format('Y/m/d');
		$traslado->save();
		Flash::success("El traslado del activo " . $activo->v_codigoactivo . " ha sido actualizado")->important();
		return redirect()->route('listatraslado');
	}

	public function eliminartraslado($id)
	{
		$traslado = TrasladosActivo::find($id);
		$activo = ActivoFijo::find($traslado->activo_id);
		$activo->v_trasladadoSN = 'N';
		$activo->save();
		$traslado->v_estado = 0;
		$traslado->save();
		Flash::error("El traslado del activo " . $activo->v_codigoactivo . " ha sido eliminado")->important();
		return redirect()->route('listatraslado');
	}

	public function crearretorno($id)
	{
		$traslado = TrasladosActivo::find($id);
		$traslado->each(function($traslado){ 
			$traslado->activofijo;
			$traslado->procedencia;
			$traslado->destino;
		});
		$formato = Carbon::createFromFormat('Y-m-d',$traslado->f_fechatraslado);
		$traslado->f_fechatraslado = $formato->format('d/m/Y');
		return view('admin.activofijo.traslados.agregarretorno')->with('traslado',$traslado);
	}

	public function guardarretorno(RetornoActivoRequest $Request)
	{
		$traslado = TrasladosActivo::find($Request->traslado_id);
		$activo = ActivoFijo::find($traslado->activo_id);
		$activo->v_trasladadoSN = 'N';
		$activo->save();
		$retorno = new RetornosActivo($Request->all());
		$formato = Carbon::createFromFormat('d/m/Y',$retorno->fecha);
		$retorno->fecha = $formato->format('Y/m/d');
		$retorno->save();
		Flash::success("El activo " . $activo->v_codigoactivo . " ha sido retornado")->important();
		return redirect()->route('listatraslado');		
	}

}
