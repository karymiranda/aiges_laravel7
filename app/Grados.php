<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grados extends Model
{
    protected $table='tb_grados';
    protected $fillable=['grado','nivel_educativo','estado'];
 
  public function grado_secciones()
    {
    	return $this->hasMany('App\Seccion');
	}
	
}
