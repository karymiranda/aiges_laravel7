<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacioncuentacatalogo extends Model
{
    protected $table='tb_clasificacioncuentacatalogo';
    protected $fillable=['v_tipocuenta','estado'];

    public function cuenta()
    {

    	return $this->hasMany('App\Catalogodecuenta');   
     }
}
