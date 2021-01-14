<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
	protected $table = "bitacoras";
    protected $fillable = ['id','user_id','usuario_nombre','operacion'];

     public function bitacora_usuarios()
    {
	return $this->belongsTo('App\User','user_id');
    }

}
