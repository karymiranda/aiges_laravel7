<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivoFijo extends Model
{
    protected $table = "tb_activofijo";

    protected $fillable = ['cuentacatalogo_id', 'v_nombre', 'v_codigoactivo','f_fecha_adquisicion', 'v_serie', 'v_modelo', 'v_marca', 'v_estado', 'd_valor', 'v_ubicacion', 'v_vidautil', 'v_medida', 'v_materialdeconstruccion', 'v_condicionactivo', 'v_observaciones', 'v_trasladadoSN'];

    public function cuentacatalogo()
    {
    	return $this->belongsTo('App\Catalogodecuenta','cuentacatalogo_id');
	}

	public function traslados()
    {
    	return $this->hasMany('App\TrasladosActivo');
	}

	public function descargos()
    {
    	return $this->hasMany('App\DescargosActivo');
	}
}
