<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallecotizacion extends Model
{
    protected $table='tb_detallecotizacion';
    protected $fillable=['cotizacion_id','d_cantidad','v_unidaddemedida','v_producto','d_preciounitario'];

    public function detallecotizacion()
{
return $this->belongsTo('App\Cotizacion','cotizacion_id');
}

}
