<?php

namespace App\Http\Controllers;

use App\Catalogodecuenta;
use App\ActivoFijo;
use App\InfoCentroEducativo;
use App\TipoDescargoActivo;
use App\DescargosActivo;
use App\TrasladosActivo;
use App\TipoTrasladoActivo;
use App\InstitucionesDestino;
use Illuminate\Http\Request;
use App\Http\Requests\ActivoFijoRequest;
use App\Http\Requests\TrasladoActivoRequest;
use App\Http\Requests\DescargosActivoRequest;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Bitacora;
use App\Usuario;

class GestionaractivofijoController extends Controller
{
	public function bitacora($operacion = array())
	{
		$usuario = Auth::user()->id;
		$user=Usuario::find(Auth::user()->id);
		$usuarioname=$user->empleado->v_nombres ." ".$user->empleado->v_apellidos;
		$item = new Bitacora;
		$item->user_id = $usuario;
		$item->usuario_nombre = $usuarioname;
		$item->operacion = json_encode($operacion);
		$item->save();
	}

    public function index()
	{
		$this->bitacora(array(
			"operacion" => 'Consultar lista de activos.'
		));

		$activos = ActivoFijo::orderBy('v_codigoactivo','desc')->where('v_estado','=','1')->get();
		foreach($activos as $activo)
	    {
		    $formato = Carbon::createFromFormat('Y-m-d',$activo->f_fecha_adquisicion);
		    $activo->f_fecha_adquisicion = $formato->format('d/m/Y');
	    }
		return view('admin.activofijo.activos.gestionaractivofijo')->with('activos',$activos);	
	}

	public function crearactivo()
	{
		$cuentas = Catalogodecuenta::select(\DB::raw('CONCAT(v_codigocuenta," - ",v_nombrecuenta) as nombre'),\DB::raw('substr(v_codigocuenta, 3,4) as codigo'))->orderBy('v_codigocuenta','ASC')->where([['estado','=','1'],['tipocuenta_id','=','1'],['v_nivel','=','4']])->pluck('nombre','codigo');
		$cod_infra = InfoCentroEducativo::find(1);
		return view('admin.activofijo.activos.agregaractivo')->with('cuentas',$cuentas)->with('infra',$cod_infra->v_codigoinfraestructura);	
	}
	public function editaractivo($id)
	{
		$activo = ActivoFijo::find($id);
		$activo->each(function($activo){ 
			$activo->cuentacatalogo;
		});
		$formato = Carbon::createFromFormat('Y-m-d',$activo->f_fecha_adquisicion);
		$activo->f_fecha_adquisicion = $formato->format('d/m/Y');
		$cuentas = Catalogodecuenta::select(\DB::raw('CONCAT(v_codigocuenta," - ",v_nombrecuenta) as nombre'),\DB::raw('substr(v_codigocuenta, 3,4) as codigo'))->orderBy('v_codigocuenta','ASC')->where([['estado','=','1'],['tipocuenta_id','=','1'],['v_nivel','=','4']])->pluck('nombre','codigo');
		$cod_infra = InfoCentroEducativo::find(1);
		$codigoCuenta=Catalogodecuenta::select(\DB::raw('substr(v_codigocuenta, 3,4) as codigo'))->where('id','=',$activo->cuentacatalogo_id)->pluck('codigo');
		$activo->cuentacatalogo->v_codigocuenta=$codigoCuenta;
		return view('admin.activofijo.activos.editaractivo')->with('cuentas',$cuentas)->with('activo',$activo)->with('infra',$cod_infra->v_codigoinfraestructura);	
	}

	public function descargaractivo($id)
	{
		$activo = ActivoFijo::find($id);
		$activo->each(function($activo){ 
			$activo->cuentacatalogo;
		});
		$tiposdescargo = TipoDescargoActivo::orderBy('v_descripcion','ASC')->pluck('v_descripcion','id');
		return view('admin.activofijo.activos.descargaractivo')->with('activo',$activo)->with('tiposdescargo',$tiposdescargo);	
	}

	public function verdetalleactivo($id)
	{
		$activo = ActivoFijo::find($id);
		$activo->each(function($activo){ 
			$activo->cuentacatalogo;
		});
		$formato = Carbon::createFromFormat('Y-m-d',$activo->f_fecha_adquisicion);
		$activo->f_fecha_adquisicion = $formato->format('d/m/Y');
		$cuentas = Catalogodecuenta::select(\DB::raw('CONCAT(v_codigocuenta," - ",v_nombrecuenta) as nombre'),\DB::raw('substr(v_codigocuenta, 3,4) as codigo'))->orderBy('v_codigocuenta','ASC')->where([['estado','=','1'],['tipocuenta_id','=','1'],['v_nivel','=','4']])->pluck('nombre','codigo');
		$codigoCuenta=Catalogodecuenta::select(\DB::raw('substr(v_codigocuenta, 3,4) as codigo'))->where('id','=',$activo->cuentacatalogo_id)->pluck('codigo');
		$activo->cuentacatalogo->v_codigocuenta=$codigoCuenta;
		return view('admin.activofijo.activos.verdetalleactivo')->with('cuentas',$cuentas)->with('activo',$activo);	
	}

	public function correlativo(Request $request)
	{
		$id_cuenta = Catalogodecuenta::select('id')->where([[\DB::raw('substr(v_codigocuenta, 3, 4)'),'=',$request->codigo],['v_nivel','=','4']])->first();
		$cont = ActivoFijo::where('cuentacatalogo_id','=',$id_cuenta->id)->count();
		if($cont!=0){
			$activos = ActivoFijo::where('cuentacatalogo_id','=',$id_cuenta->id)->get();
			$codigo = Str::substr($activos->Last()->v_codigoactivo,9);
		}else{
			$codigo = 0000;
		}
		$codigo4 = sprintf("%04d",$codigo+1);
		echo $codigo4;
	}

	public function agregaractivo(ActivoFijoRequest $Request)
	{
		
		$activo = new ActivoFijo($Request->all());
		$activo->v_trasladadoSN = 'N';
		$formato = Carbon::createFromFormat('d/m/Y',$activo->f_fecha_adquisicion);
		$activo->f_fecha_adquisicion = $formato->format('Y/m/d');
		$activo->v_estado = 1;
		$id_cuenta = Catalogodecuenta::select('id')->where([[\DB::raw('substr(v_codigocuenta, 3, 4)'),'=',$activo->cuentacatalogo_id],['v_nivel','=','4']])->first();
		$activo->cuentacatalogo_id = $id_cuenta->id;
		$this->bitacora(array(
			"operacion" => 'Registrar activo '.$activo->v_codigoactivo 
		));
		$activo->save();
		Flash::success("El activo " . $activo->v_codigoactivo . " ha sido guardado")->important();
		return redirect()->route('activofijo');		
	}

	public function actualizaractivo(ActivoFijoRequest $request, $id)
	{
		$activo = ActivoFijo::find($id);
		$activo->fill($request->all());
		$formato = Carbon::createFromFormat('d/m/Y',$activo->f_fecha_adquisicion);
		$activo->f_fecha_adquisicion = $formato->format('Y/m/d');
		$id_cuenta = Catalogodecuenta::select('id')->where([[\DB::raw('substr(v_codigocuenta, 3, 4)'),'=',$activo->cuentacatalogo_id],['v_nivel','=','4']])->first();
		$activo->cuentacatalogo_id = $id_cuenta->id;
		$activo->save();
		Flash::success("El activo " . $activo->v_codigoactivo . " ha sido actualizado")->important();
		return redirect()->route('activofijo');		
	}

	public function guardardescargo(DescargosActivoRequest $Request)
	{
		$descargo = new DescargosActivo($Request->all());
		$formato = Carbon::createFromFormat('d/m/Y',$descargo->f_fechadescargo);
		$descargo->f_fechadescargo = $formato->format('Y/m/d');
		$activo = ActivoFijo::find($descargo->activofijo_id);
		$activo->v_estado = 0;
		$activo->save();
		$descargo->save();
		Flash::error("El activo " . $activo->v_codigoactivo . " ha sido descargado")->important();
		return redirect()->route('activofijo');		
	}	

	public function creartraslado($id)
	{
		$activo = ActivoFijo::find($id);
		$activo->each(function($activo){ 
			$activo->cuentacatalogo;
		});
		$tipotraslado=TipoTrasladoActivo::orderBy('id','ASC')->pluck('v_descripcion','id');
		$procedencia = InfoCentroEducativo::find(1);
		$destinos = InstitucionesDestino::orderBy('codigo_institucion','ASC')->where('estado','=','1')->get();
		return view('admin.activofijo.activos.agregartraslado')->with('activo',$activo)->with('tipotraslado',$tipotraslado)->with('procedencia',$procedencia)->with('destinos',$destinos);	
	}

	public function agregartraslado(TrasladoActivoRequest $Request)
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
		return redirect()->route('activofijo');		
	}

}
