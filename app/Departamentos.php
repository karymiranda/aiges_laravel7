<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table='tb_departamentos';
    protected $fillable=['v_departamento','estado'];

    public function municipio_departamento()
    {

    	return $this->hasMany('App\Municipios');   
     }
}
