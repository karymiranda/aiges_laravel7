<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodoactivo extends Model
{
	protected $table='tb_periodo_activo';
    protected $fillable=['id','anio','nombre','tipo_periodo','estado'];

public function ciclocontable_transacciones()
    {
        return $this->hasMany('App\Periodoactivo');
    }

public function cicloescolar_periodoevaluacion()
    {
    	return $this->hasMany('App\Periodoevaluacion');
	}
	 public function Periodoactivo_secciones()
    {
    	return $this->hasMany('App\Seccion');
	}

//SCOPE
public function scopePeriodoEscolar($anio)//query scope para sacar el periodo escolar que este activo
{
    return $anio->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']]);
}
public function scopeCorrelativociclos($seccion)
{
    $anio = Carbon::now()->year;
for ($i=$anio+1; $i >2000 ; $i--) { //ara qu me envie la lista de los años a partir del 2000 al año actual+1
	$periodos[$i]=$i;}

	return $periodos;
}
public function scopeListaperiodosescolares($anioslectivos)
{
return $anioslectivos->where('tipo_periodo','like','ACADEMICO')->pluck('anio','id');
}

public function scopePeriodosescolares($listaanioslectivos)
{
return $listaanioslectivos->where('tipo_periodo','like','ACADEMICO')->get();
}

}

