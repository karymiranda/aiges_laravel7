<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogodecuenta extends Model
{
    protected $table='tb_catalogodecuentas';
    protected $fillable=['v_nombrecuenta','v_nivel','v_codigocuenta','tipocuenta_id','v_tiposaldo','estado'];

         
     public function clasificacioncuentacatalogo()
    {
    	return $this->belongsTo('App\Clasificacioncuentacatalogo','tipocuenta_id');
    }
    
    public function activos()
    {
        return $this->hasMany('App\ActivoFijo');   
     }
}
