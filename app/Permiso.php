<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = "tb_permisosempleados";

    protected $fillable = ['f_fechasolicitud', 'solicitante_id','motivo_id', 'i_tiemposolicitado','i_horas','i_minutos','f_desde', 'f_hasta', 'v_observaciones', 'estado', 'h_desde', 'h_hasta','v_congocedesueldoSN'];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleado','solicitante_id');
	}

	public function motivoPermiso()
    {
    	return $this->belongsTo('App\MotivoPermiso','motivo_id');
	}

	public function tipoPermiso()
    {
    	return $this->belongsTo('App\TipoPermiso','tipopermiso_id');
	}
}
