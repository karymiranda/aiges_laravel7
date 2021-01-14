<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class Usuario extends Authenticatable
//class Usuario extends Model
{
    protected $table = "users";

    protected $fillable = ['name', 'email', 'password','personal_id', 'familiar_id', 'estudiante_id','estado','foto'];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleado','personal_id');
	}

    public function estudiante()
    {
        return $this->belongsTo('App\Expedienteestudiante','estudiante_id');
    }
     public function familiar()
    {
        return $this->belongsTo('App\Familiares','familiar_id');
    }
    public function usuario_rol()
    {
        return $this->belongsToMany('App\RolUsuario','tb_usuario_rol','usuario_id','rolusuario_id')->withTimestamps();
        
    }

    public function usuario_bitacora()
    {
    return $this->hasMany('App\Bitacora');
    }

}

