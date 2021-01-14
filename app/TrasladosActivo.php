<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrasladosActivo extends Model
{
    protected $table = "tb_trasladoactivofijo";

    protected $fillable = ['f_fechatraslado', 'procedencia_id', 'destino_id', 'activo_id', 'v_personaautoriza', 'v_personarecibe', 'v_observaciones', 'tipotraslado_id'];

    public function activofijo()
    {
    	return $this->belongsTo('App\ActivoFijo','activo_id');
	}

	public function tipotraslado()
    {
    	return $this->belongsTo('App\TipoTrasladoActivo','tipotraslado_id');
	}

    public function procedencia()
    {
        return $this->belongsTo('App\InfoCentroEducativo','procedencia_id');
    }

    public function destino()
    {
        return $this->belongsTo('App\InstitucionesDestino','destino_id');
    }

    public function retornos()
    {
        return $this->hasMany('App\RetornosActivo');
    }

}
