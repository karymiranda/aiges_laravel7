<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodoevaluacion extends Model
{
    protected $table='tb_periodoevaluaciones';
    protected $fillable=['id','nombre','descripcion','periodo_id','estado'];

    public function periodoevaluacion_cicloescolar()
    { 	
    	return $this->belongsTo('App\Periodoactivo','periodo_id');	
	}
	public function periodo_notacompetenciaciudadana()
	{
	return $this->hasMany('App\Notascompetenciasciudadanas');
	}

}
