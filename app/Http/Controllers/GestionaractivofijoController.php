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
use Illuminate\Support\Facades\DB;
use App\Bitacora;
use App\Usuario;
use App\DepreciacionActivoFijo;


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

		//$activos = ActivoFijo::orderBy('v_codigoactivo','desc')->where('v_estadoaf','!=','DESCARGADO')->get();
			$activos = ActivoFijo::orderBy('v_codigoactivo','desc')->get();
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
		$activo->v_estadoaf = "EXISTENTE";
		if($Request->valorrecuperacionSN=="SI")
		{
		$activo->valorrecuperacionSN = "SI";
		$activo->d_valorrecuperacion = $Request->d_valor*0.10;
		$activo->d_basedepreciacion = $Request->d_valor*0.90;
		}
	     else{
	     $activo->valorrecuperacionSN = "NO";
	     $activo->d_valorrecuperacion = 0;
		$activo->d_basedepreciacion = $Request->d_valor;
	     }

	     if($Request->depreciacionSN=="SI")
		{
		$activo->depreciacionSN = "SI";
		$activo->v_vidautil = $Request->v_vidautil;
		}
	     else{
	     $activo->depreciacionSN = "NO";
		$activo->v_vidautil = null;
	     }

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

if($request->valorrecuperacionSN=="SI")
		{
		$activo->valorrecuperacionSN = "SI";
		$activo->d_valorrecuperacion = $request->d_valor*0.10;
		$activo->d_basedepreciacion = $request->d_valor*0.90;
		}
	     else{
	     $activo->valorrecuperacionSN = "NO";
	     $activo->d_valorrecuperacion = 0;
		$activo->d_basedepreciacion = $request->d_valor;
	     }

	     if($request->depreciacionSN=="SI")
		{
		$activo->depreciacionSN = "SI";
		$activo->v_vidautil = $request->v_vidautil;
		}
	     else{
	     $activo->depreciacionSN = "NO";
		$activo->v_vidautil = null;
	     }

		$activo->save();
		Flash::success("El activo " . $activo->v_codigoactivo . " ha sido actualizado")->important();
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

	public function listasolicitudesdescarga()
	{
  
	$query="select  des.id,des.numsolicitud,des.f_fechasolicitud,des.f_fechaaprobacion,count(daf.solicitud_id) as cantidad, sum(af.d_valor) as suma,des.estado  from tb_activofijo as af inner join tb_detallesolicituddescargo_activofijo as daf  inner join tb_descargoactivo as des where af.id = daf.activofijo_id and des.id=daf.solicitud_id group by des.id";

	$afdescargados= DB::select( DB::raw($query) );
	//dd($afdescargados);
		return view('admin.activofijo.descargos.gestiondesolicitudesdescargo',compact('afdescargados'));

	}

	public function crearsolicituddescarga()
	{
		$contador=DescargosActivo::count();
		if($contador!=0)//la base no esta vacia
		{
			$contExp=DescargosActivo::all();
			$correlativo=$contExp->Last()->id+1;
			$correlativo=str_pad($correlativo,6,"0",STR_PAD_LEFT);
		}else{
			$correlativo=1;//si la base esta vacia el correlativo del numero expediente sera 1
			$correlativo=str_pad($correlativo,6,"0",STR_PAD_LEFT);
		}

		$tipodescargo = TipoDescargoActivo::orderBy('v_descripcion','ASC')->pluck('v_descripcion','id');
		$fecha = Carbon::today();
		$fecha=$fecha->format('d/m/Y');

		return view('admin.activofijo.descargos.crearsolicituddescarga',compact('tipodescargo','correlativo','fecha'));

	}

	public function listaactivos(){		
		$activo = ActivoFijo::orderBy('v_codigoactivo','ASC')->where('v_estadoaf','like','EXISTENTE')->get();
		return response()->json($activo);
	}

	public function guardarsolicituddescargo(Request $r)
	{
		

		$val=json_decode($r->array);
		$solicitud = new DescargosActivo();
		$solicitud->id=$r->numsolicitud;
		$solicitud->numsolicitud=$r->numsolicitud;
		$formato = Carbon::createFromFormat('d/m/Y',$r->f_fechasolicitud);
		$solicitud->f_fechasolicitud = $formato->format('Y-m-d');	$solicitud->estado='PENDIENTE';
		$solicitud->f_fechaaprobacion=null;
		$solicitud->urlactadeaprobacion=null;
		$solicitud->nombredearchivo=null;
		$solicitud->observaciones=null;
		$solicitud->save();


		//guardar detalle de solicitud de descargo
	$res=json_decode($r->array,true);

	 $detallesolicitud= DescargosActivo::find($r->numsolicitud);
	 foreach ($res as $value) { 
	 	switch  ($value[3]){
	 		case 'DAÑO':
	 		$motivo=1;
	 		break;
	 		case 'HURTO':
	 		$motivo=2;
	 		break;
	 		case 'OBSOLETO':
	 		$motivo=3;
	 		break; 
	 	}

	 $detallesolicitud->descargo_detalle()->attach($value[1],['tipodescargo_id'=>$motivo]);

	 //actualizamos el estado del activo
	 $activo=ActivoFijo::find($value[1]);
	 $activo->v_estadoaf='EN PROCESO DE DESCARGO';
	 $activo->save();


	 } 
	
	return response()->json($r);

	}

	public function versolicituddescargo($id,$origen)
	{
	$solicitud=DescargosActivo::find($id);
	$formato = Carbon::createFromFormat('Y-m-d',$solicitud->f_fechasolicitud);
    $solicitud->f_fechasolicitud = $formato->format('d/m/Y');
    if($solicitud->f_fechaaprobacion!=null)
    {
    $formato2 = Carbon::createFromFormat('Y-m-d',$solicitud->f_fechaaprobacion);
    $solicitud->f_fechaaprobacion = $formato2->format('d/m/Y');
	}

$res=DescargosActivo::orderBy('f_fechasolicitud')->with('descargo_detalle')->withCount(['descargo_detalle'=> function($q) use ($id){
	$q->where('tb_detallesolicituddescargo_activofijo.solicitud_id','=',$id); }])->where('id',$id)->get();
$motivo=TipoDescargoActivo::all()->pluck('v_descripcion','id');

return view('admin.activofijo.descargos.versolicituddescargo',compact('solicitud','res','motivo','origen'));
	}

public function negaractadeaprobacion(Request $request)
{
$id=$request->id;
$solicitud=DescargosActivo::with('descargo_detalle')->withCount(['descargo_detalle'=> function($q) use ($id){
	$q->where('tb_detallesolicituddescargo_activofijo.solicitud_id','=',$id); }])->where('id',$id)->first();

//Cambiar el estado de cada activo a EXISTENTE nuevamente
foreach ($solicitud->descargo_detalle as $value) 
     {
				 $activo=ActivoFijo::find($value->id);
				 $activo->v_estadoaf="EXISTENTE";
				 $activo->save();     
      }

$solicitud->estado="NEGADA";
$solicitud->save();
return redirect()->route('descargopendientedeaprobar');
}

	public function subiractadeaprobacion($id)
{
	$solicitud=DescargosActivo::find($id);
	$hoy=Carbon::today(); 
	$hoyc = $hoy->format('Y-m-d');
	$hoy = $hoy->format('d/m/Y');
	
	return view('admin.activofijo.descargos.subiractadeaprobacion',compact('solicitud','hoy'));
}

public function guardaractadeaprobacion( Request $request)
{
$sol=$request->id;
$solicitud=DescargosActivo::with('descargo_detalle')->withCount(['descargo_detalle'=> function($q) use ($sol){
	$q->where('tb_detallesolicituddescargo_activofijo.solicitud_id','=',$sol); }])->where('id',$sol)->first();
//$solicitud=DescargosActivo::find($request->id);

//Cambiar el estado de cada activo a DESCARGDO
foreach ($solicitud->descargo_detalle as $value) {
 $activo=ActivoFijo::find($value->id);
 $activo->v_estadoaf="DESCARGADO";
 $activo->save();     
      }

if ($request->hasfile('files')) 
{
	foreach ($request->file('files') as $file)
            {
      $name = $file->getClientOriginalName();
		$formato = Carbon::createFromFormat('d/m/Y',$request->f_fechaaprobacion);
		$solicitud->f_fechaaprobacion = $formato->format('Y-m-d');
		$solicitud->urlactadeaprobacion=public_path('actasActivoFijo');
		$solicitud->nombredearchivo=$name;
		$solicitud->observaciones=$request->observaciones;
		$solicitud->estado='APROBADA';
		//$file->move(public_path() . '\actasActivoFijo', $name);
		$file->move('\actasActivoFijo', $name);
		
		$solicitud->save();
             
           }


      Flash::success("Archivo subido exitosamente")->important();
	return redirect()->route('lista-solicitudes-descarga');	
  } 

}


public function eliminaritemsolicituddescarga(Request $request)
	{
		$activo=ActivoFijo::find($request->activofijo_id);
		$activo->detalle_descargo()->detach($request->solicitud_id);
		$activo->v_estadoaf="EXISTENTE";
		$activo->save();
		 return redirect()->route('editarsolicituddescargo',$request->solicitud_id);
	}	


public function agregaritemsolicituddescarga(Request $req)
{
$solicitud=DescargosActivo::where('numsolicitud',$req->numsolicitud)->first();
$solicitud->descargo_detalle()->attach($solicitud->id,['activofijo_id'=>$req->id,'tipodescargo_id'=>$req->motivodescargo]);
//actualizar el estado de los activos

$activo=ActivoFijo::find($req->id);
$activo->v_estadoaf="EN PROCESO DE DESCARGO";
$activo->save();

return redirect()->route('editarsolicituddescargo',$solicitud->id);
}

	public function editarsolicituddescargo($id)
	{
		
$solicitud=DescargosActivo::find($id);
	$formato = Carbon::createFromFormat('Y-m-d',$solicitud->f_fechasolicitud);
    $solicitud->f_fechasolicitud = $formato->format('d/m/Y');
$tipodescargo = TipoDescargoActivo::orderBy('v_descripcion','ASC')->pluck('v_descripcion','id');
$res=DescargosActivo::orderBy('f_fechasolicitud')->with('descargo_detalle')->withCount(['descargo_detalle'=> function($q) use ($id){
	$q->where('tb_detallesolicituddescargo_activofijo.solicitud_id','=',$id); }])->where('id',$id)->get();
$motivo=TipoDescargoActivo::all()->pluck('v_descripcion','id');
return view('admin.activofijo.descargos.editarsolicituddescargo',compact('solicitud','res','motivo','tipodescargo'));

}

public function registrarcalculo($anio)
{//WhereDoesntHave
	//verifico si ya hay registros de depreciacion para el presente periodo
	$AFVerify=ActivoFijo::where('v_estadoaf','like','EXISTENTE')->WhereHas('activo_depreciacion', function ($q) use ($anio) {
	$q->where('tb_depreciacionanual.anio',$anio);
	})->count();

//dd($AFVerify);
	if($AFVerify>0)//si ya se ha hecho calculo de depreciacion retorna a ventana anterior
	{
		Flash::warning("No se puede completar el proceso. La depreciación de Activo Fijo para el período ".$anio ." ya ha sido calculada previamente.")->important();
		return redirect()->route('depreciacionactivos');

	}
	
	$historialdepre=array();
	$activos=ActivoFijo::with('activo_depreciacion')->where('v_estadoaf','like','EXISTENTE')->whereDoesntHave('activo_depreciacion', function ($q) use ($anio) {
	$q->where('tb_depreciacionanual.anio','=',$anio);
	})->get();

	$fecha = Carbon::today();
	$fecha=$fecha->format('Y-m-d');

	foreach ($activos as $activo) 
	{
	$cod=$activo->id;	
	$historialdepre[$activo->id]=ActivoFijo::withCount('activo_depreciacion')->where('v_estadoaf','like','EXISTENTE')->whereHas('activo_depreciacion', function ($q) use ($cod) {
	$q->where('tb_depreciacionanual.activofijo_id','=',$cod);
	})->first();
	 
	 

	 if(!$activo->activo_depreciacion()->exists())
	 {
$depreciacion=new DepreciacionActivoFijo();
$depreciacion->activofijo_id=$activo->id;
$depreciacion->f_fechamovimiento=$fecha;
$depreciacion->d_depreciacionanual=$activo->d_basedepreciacion/$activo->v_vidautil;
$depreciacion->d_depreciacionacumulada=$depreciacion->d_depreciacionanual;
$depreciacion->d_valoenlibros=$activo->d_basedepreciacion-$depreciacion->d_depreciacionanual;
$depreciacion->anio=$anio;
$depreciacion->save();
	 }

	 else
	 {

if($historialdepre[$activo->id]->activo_depreciacion_count<$historialdepre[$activo->id]->v_vidautil){
//$ultimoreg=DepreciacionActivoFijo::latest('activofijo_id')->where('activofijo_id','=',$cod)->first();
	$ultimoreg=DepreciacionActivoFijo::where('activofijo_id','=',$cod)->orderBy('anio','DESC')->first();

$depreciacion=new DepreciacionActivoFijo();
$depreciacion->activofijo_id=$activo->id;
$depreciacion->f_fechamovimiento=$fecha;
$depreciacion->d_depreciacionanual=$activo->d_basedepreciacion/$activo->v_vidautil;
$depreciacion->d_depreciacionacumulada=$depreciacion->d_depreciacionanual+$ultimoreg->d_depreciacionacumulada;
$depreciacion->d_valoenlibros=$ultimoreg->d_valoenlibros-$depreciacion->d_depreciacionanual;
$depreciacion->anio=$anio;
$depreciacion->save();
    }
}
	}

Flash::success(" Cálculo de depreciación de activo fijo para el periodo ".$anio ." finalizado con éxito.")->important();
return redirect()->route('depreciacionactivos');
}

public function depreciacionactivos()
{
$anio=Carbon::now()->year;
$deprecVerify=DepreciacionActivoFijo::where('anio','=',$anio)->count();

$activos=ActivoFijo::with('activo_depreciacion')->where('v_estadoaf','like','EXISTENTE')->get();
//dd($activos);

return view('admin.activofijo.depreciaciones.activosdepreciables',compact('anio','deprecVerify','activos'));
}

public function calculardepreciacion($anio)
{
return view('admin.activofijo.depreciaciones.calculodepreciacion',compact('anio'));
}
 
public function verhistorialdepreciacion($id)
{
$activo=ActivoFijo::with(['activo_depreciacion'=>function ($q) use ($id){
$q->where('tb_depreciacionanual.activofijo_id','=',$id);
}])->where([['v_estadoaf','like','EXISTENTE'],['id',$id]])->first();

return view('admin.activofijo.depreciaciones.verhistorialdepreciacion',compact('activo'));
}

public function descargopendientedeaprobar()
{
	$query="select  des.id,des.numsolicitud,des.f_fechasolicitud,des.f_fechaaprobacion,count(daf.solicitud_id) as cantidad, sum(af.d_valor) as suma,des.estado  from tb_activofijo as af inner join tb_detallesolicituddescargo_activofijo as daf  inner join tb_descargoactivo as des where af.id = daf.activofijo_id and des.id=daf.solicitud_id and des.estado= 'PENDIENTE' group by des.id";
	$afdescargados= DB::select( DB::raw($query) );

	return view('admin.activofijo.descargos.descargospendientesdeaprobar',compact('afdescargados'));
	
}


	/*
   public function descargaractivo($id)
	{
		$activo = ActivoFijo::find($id);
		$activo->each(function($activo){ 
			$activo->cuentacatalogo;
		});
		$tiposdescargo = TipoDescargoActivo::orderBy('v_descripcion','ASC')->pluck('v_descripcion','id');
		return view('admin.activofijo.activos.descargaractivo')->with('activo',$activo)->with('tiposdescargo',$tiposdescargo);	
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
	}*/	


}
