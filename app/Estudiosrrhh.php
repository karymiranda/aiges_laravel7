<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiosrrhh extends Model
{
    protected $table='tb_estudiosrrhh';
    protected $fillable=['id','tipoestudio','institucion','titulo','observaciones','anioinicio','aniofin','empleado_id'];

    public function estudio_empleado()
    {
    	return $this->belongsTo('App\Empleado','empleado_id');
    }
}
