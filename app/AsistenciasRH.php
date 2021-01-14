<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsistenciasRH extends Model
{
    protected $table = "tb_asistenciaempleado";

    protected $fillable = ['expedientepersonal_id', 'fecha', 'asistenciaSN','permisoSN', 'anio', 'horaEntrada', 'horaSalida'];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleado','expedientepersonal_id');
	}
}
