<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccionesbono extends Model
{
    protected $table='tb_transacciones_bono';
    protected $fillable=['id','fecha_transaccion','tipo_transaccion','tipo_documento','numero_cheque','concepto','a_favor_de','ingreso','gasto','saldo','ciclocontable_id','fondodisponible_id','saldo_bancos','opyfuncionamientoSN','rubro_id'];

public function transaccion_fondodisponible(){
	return $this->belongsTo('App\Fondodisponible','fondodisponible_id');
} 
public function transaccion_ciclocontable(){
  return $this->belongsTo('App\Periodoactivo','ciclocontable_id');
} 

public function transaccion_rubro(){
	return $this->belongsTo('App\Rubrogasto','rubro_id');
}


 public function scopeSaldo($saldo,$idejercicioactivo)//cuando quiera llamar esta funcion lo debo hacer con el nomnre ->saldo($idejercicioactivo), ejercicioactivo es el id del fondodisponible que este activo al que pertenecen las transacciones que se estan realizando
 {
    $ingresos=Transaccionesbono::whereHas('transaccion_fondodisponible', function ($q) use ($idejercicioactivo){$q->where('id','=',$idejercicioactivo);})->where('tipo_transaccion','like','INGRESO')->sum('ingreso');

     $gastos=Transaccionesbono::whereHas('transaccion_fondodisponible', function ($q) use ($idejercicioactivo){$q->where('id','=',$idejercicioactivo);})->where('tipo_transaccion','like','GASTO')->sum('gasto');

    $saldo=$ingresos-$gastos;
    return $saldo;
 }

  public function scopeSaldobancos($saldo_bancos,$idejercicioactivo){
   $ingresos=Transaccionesbono::whereHas('transaccion_ciclocontable', function ($q) use ($idejercicioactivo){$q->where('id','=',$idejercicioactivo);})->where('tipo_transaccion','like','INGRESO')->sum('ingreso');

     $gastos=Transaccionesbono::whereHas('transaccion_ciclocontable', function ($q) use ($idejercicioactivo){$q->where('id','=',$idejercicioactivo);})->where('tipo_transaccion','like','GASTO')->sum('gasto');

 return   $saldo_bancos=$ingresos-$gastos;
 }

 public function scopeRecalcularsaldo($mensaje,$idejercicioactivo)
 { 
 $transacciones=Transaccionesbono::OrderBy('fecha_transaccion','ASC')->where('fondodisponible_id','=',$idejercicioactivo)->get();
$i=0;
    foreach ($transacciones as $transacciones)
     {
       $ingresos[]=$transacciones->ingreso;
       $gastos[]=$transacciones->gasto;
       $saldoactual[]=array_sum($ingresos)-array_sum($gastos); 
       $actualizarregistro=Transaccionesbono::find($transacciones->id);
       $actualizarregistro->saldo = $saldoactual[$i];    
       $actualizarregistro->save(); 
       $i++;
    }
    $mensaje="ok";
  return $mensaje;
 }

  public function scopeRecalcularsaldobancos($mensaje,$idejercicioactivo)
 { 
 $transacciones=Transaccionesbono::OrderBy('fecha_transaccion','ASC')->where('ciclocontable_id','=',$idejercicioactivo)->get();
$i=0;
    foreach ($transacciones as $transacciones)
     {
       $ingresos[]=$transacciones->ingreso;
       $gastos[]=$transacciones->gasto;
       $saldoactual[]=array_sum($ingresos)-array_sum($gastos); 
       $actualizarregistro=Transaccionesbono::find($transacciones->id);
       $actualizarregistro->saldo_bancos = $saldoactual[$i];    
       $actualizarregistro->save(); 
       $i++;
    }
    $mensaje="ok";
  return $mensaje;
 }

}
