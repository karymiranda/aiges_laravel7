<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fondodisponible extends Model
{
    protected $table='tb_fondodisponible';
    protected $fillable=['id','numero_cuenta','descripcion','monto_disponible','estatus'];

public function fondos_transacciones()
    {
    	return $this->hasMany('App\Transaccionesbono');
	}
}
