<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familiares extends Model
{
    protected $table='tb_familiares';
    protected $fillable=['expediente','nombres','apellidos','genero','dui','profesion','lugardetrabajo','direcciondetrabajo','direccionderesidencia','estado','telefonocasa','telefonotrabajo','celular','fechanacimiento','niveleducativo','correo'];

     public function familiar_usuario()
    {
        return $this->hasMany('App\Usuario','familiar_id');
    }
   
    public function familiares_estudiante()
    {
    return $this->belongsToMany('App\Expedienteestudiante','tb_estudiante_familiar','familiar_id','estudiante_id')->withPivot('parentesco','encargado','autorizacion')->withTimestamps();
    }
}
