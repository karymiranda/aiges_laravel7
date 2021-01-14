<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table='tb_cotizacionbonoescolar';
    protected $fillable=['v_numerocotizacion','v_descripcion','f_fechaelaboracion','f_fecharecepcion','v_lugarentrega','v_estadoentrega','estado'];

   
    public function cotizaciondetallecotizacion()
    {
    	return $this->hasMany('App\Detallecotizacion');
    }
   /* public function oc_cotizacion()
    {
    return $this->hasMany('App\Ordendecompra');
     } */
 }