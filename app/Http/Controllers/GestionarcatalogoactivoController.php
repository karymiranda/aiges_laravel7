<?php

namespace App\Http\Controllers;

use App\Catalogodecuenta;
use App\ActivoFijo;
use App\Http\Requests\CatalogoCuentaRequest;
use Laracasts\Flash\Flash;
use Illuminate\Support\Str;

class GestionarcatalogoactivoController extends Controller
{
    public function index()
	{
		$cuentas = Catalogodecuenta::orderBy('id','ASC')->whereBetween('v_nivel', [3, 4])->where([['estado','=','1'],['tipocuenta_id','=','1'],[\DB::raw('substr(v_codigocuenta, 1,2)'),'=','12']])->get();
		$cuentas->each(function($cuentas){ 
			$cuentas->clasificacioncuentacatalogo;
		});
		return view('admin.activofijo.catalogo.gestionarcatalogo')->with('cuentas',$cuentas);	
	}

	public function crearcatalogoactivo()
	{
		return view('admin.activofijo.catalogo.agregarcatalogo');	
	}

	public function agregarcatalogoactivo(CatalogoCuentaRequest $Request)
	{
		$cuenta = new Catalogodecuenta($Request->all());
		$cuenta->tipocuenta_id = 1;
		$cuenta->v_tiposaldo = 'DEUDOR';
		$cuenta->save();
		Flash::success("La cuenta " . $Request->v_nombrecuenta . " ha sido guardada")->important();
		return redirect()->route('catalogoactivo');	
	}

	public function editarcatalogoactivo($id)
	{
		$cuenta = Catalogodecuenta::find($id);
		$cuenta->each(function($cuenta){ 
			$cuenta->clasificacioncuentacatalogo;
		});
		$sup = ['',''];
		$codSup = '12';

		if($cuenta->v_nivel=='3'){
			$sup = ['12'=>'12 - Activo Fijo'];
		}elseif ($cuenta->v_nivel=='4') {
			$codSup = substr($cuenta->v_codigocuenta, 0,4);
			$sup = Catalogodecuenta::select(\DB::raw('CONCAT(v_codigocuenta," - ",v_nombrecuenta) as nombre'),'v_codigocuenta')->orderBy('v_codigocuenta','ASC')->where([['estado','=','1'],['tipocuenta_id','=','1'],['v_nivel','=','3']])->pluck('nombre','v_codigocuenta');
		}
		$mask='"mask":"'.$codSup .'99", "clearIncomplete":"true"';
		return view('admin.activofijo.catalogo.editarcatalogo')->with('cuenta',$cuenta)->with('codsup',$codSup)->with('sup',$sup)->with('mask',$mask);	
	}

	public function actualizarcatalogoactivo(CatalogoCuentaRequest $request, $id)
	{
		$cuenta = Catalogodecuenta::find($id);
		if($cuenta->v_codigocuenta==$request->v_sup){
			Flash::error("No puede elegir la cuenta que desea actualizar como cuenta superior")->important();
			return redirect()->route('editarcatalogoactivo',$id);
		}else{
			if($cuenta->v_codigocuenta!=$request->v_codigocuenta && $request->v_nivel=='4'){//cambiar codigo de cuenta nivel 4 / cambiar codigo de activos de esa cuenta
				$activos = ActivoFijo::where('cuentacatalogo_id','=',$cuenta->id)->get();
				$infra='';
				$codcata='';
				$correlativo='';
				$nuevocodigoactivo='';
				$nuevocodigocata=Str::substr($request->v_codigocuenta, 2,4);
				foreach ($activos as $activo) {
					$infra=Str::substr($activo->v_codigoactivo,0,5);
					$codcata=Str::substr($activo->v_codigoactivo,5,4);
					$correlativo=Str::substr($activo->v_codigoactivo,9);
					$nuevocodigoactivo=$infra.$nuevocodigocata.$correlativo;
					$activo->v_codigoactivo=$nuevocodigoactivo;
					$activo->save();
				}
			}elseif ($cuenta->v_codigocuenta!=$request->v_codigocuenta && $request->v_nivel=='3') { //cambiar cuenta nivel 3 / cambiar codigos de cuentas nivel 4 de esa cuenta / cambiar codigos de activos de esa cuenta nivel 4
				$codcuenta3=$cuenta->v_codigocuenta;
				$nuevocodigocuenta3=$request->v_codigocuenta;
				$cuentasN4=Catalogodecuenta::where([[\DB::raw('substr(v_codigocuenta, 1, 4)'),'=',$codcuenta3],['v_nivel','=','4']])->get();
				$correlativo='';
				$nuevocodigocuenta4='';
				foreach ($cuentasN4 as $cuentaN4) {
					$correlativo=Str::substr($cuentaN4->v_codigocuenta,4);
					$nuevocodigocuenta4=$nuevocodigocuenta3.$correlativo;

					$activos = ActivoFijo::where('cuentacatalogo_id','=',$cuentaN4->id)->get();
					$infra='';
					$codcata='';
					$correlativo2='';
					$nuevocodigoactivo='';
					$nuevocodigocata=Str::substr($nuevocodigocuenta4, 2,4);
					foreach ($activos as $activo) {
						$infra=Str::substr($activo->v_codigoactivo,0,5);
						$codcata=Str::substr($activo->v_codigoactivo,5,4);
						$correlativo2=Str::substr($activo->v_codigoactivo,9);
						$nuevocodigoactivo=$infra.$nuevocodigocata.$correlativo2;
						$activo->v_codigoactivo=$nuevocodigoactivo;
						$activo->save();
					}

					$cuentaN4->v_codigocuenta=$nuevocodigocuenta4;
					$cuentaN4->save();
				}
			}

		$cuenta->fill($request->all());	
		$cuenta->save();
			Flash::success("La cuenta " . $cuenta->v_nombrecuenta . " ha sido actualizada")->important();
			return redirect()->route('catalogoactivo');	
		}
	}

	public function eliminarcatalogoactivo($id)
	{
		$cuenta = Catalogodecuenta::find($id);
		if($cuenta->v_nivel=='4'){//desactivo cuenta nivel 4 y sus activos
			$activos = ActivoFijo::where([['cuentacatalogo_id','=',$cuenta->id],['v_estado','=','1']])->count();
				if($activos!=0){
					Flash::warning("No se puede eliminar esta cuenta, contiene activos sin descargar")->important();					
				}else{
					$cuenta->estado = 0;
					$cuenta->save();
					Flash::error("La cuenta " . $cuenta->v_nombrecuenta . " ha sido eliminada")->important();
				}
		}elseif ($cuenta->v_nivel=='3') {//desactivo cuenta nivel 3 y sus cuentas nivel 4 y sus activos
			$codcuenta3=$cuenta->v_codigocuenta;
			$cuentasN4=Catalogodecuenta::where([[\DB::raw('substr(v_codigocuenta, 1, 4)'),'=',$codcuenta3],['v_nivel','=','4'],['estado','=','1']])->get();
			$contiene=0;
			foreach ($cuentasN4 as $cuentaN4) {
				$activos = ActivoFijo::where([['cuentacatalogo_id','=',$cuentaN4->id],['v_estado','=','1']])->count();
				if($activos!=0){
					$contiene=1;
					Flash::warning("No se puede eliminar la subcuenta ".$cuentaN4->v_nombrecuenta.", contiene activos sin descargar")->important();
				}else{
					$cuentaN4->estado=0;
					$cuentaN4->save();
					Flash::error("La subcuenta " . $cuentaN4->v_nombrecuenta . " ha sido eliminada")->important();
				}
			}
			if($contiene==0){
				$cuenta->estado=0;
				$cuenta->save();
				Flash::error("La cuenta " . $cuenta->v_nombrecuenta . " ha sido eliminada")->important();
			}
		}
		return redirect()->route('catalogoactivo');
	}

	public function cuentasnivel3()
	{
		$cuentas = Catalogodecuenta::orderBy('v_codigocuenta','ASC')->where([['estado','=','1'],['tipocuenta_id','=','1'],['v_nivel','=','3']])->get();
		$output = '';
		$c=1;
		foreach($cuentas as $row)
          {
          	if($c==1){
          		$output .= '
            <option value='.$row->v_codigocuenta.' selected>'.$row->v_codigocuenta.' - ' .$row->v_nombrecuenta.'</option>';
          	}else{
            	$output .= '
            <option value='.$row->v_codigocuenta.'>'.$row->v_codigocuenta.' - ' .$row->v_nombrecuenta.'</option>';
        	}
        	$c++;
          }
		echo $output;
	}

}
