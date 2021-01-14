<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
   protected $table = "tb_rolusuario";

   protected $fillable = ['v_nombrerol', 'i_estado'];

     public function rol_usuario()
    {
    return $this->belongsToMany('App\Usuario','tb_usuario_rol','rolusuario_id','usuario_id')->withTimestamps();
    }
  

}
