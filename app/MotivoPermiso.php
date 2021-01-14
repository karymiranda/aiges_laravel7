<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoPermiso extends Model
{
    protected $table = "tb_motivopermisos";

    protected $fillable = ['v_motivo','i_maximodiasanual','i_maximodiasmensual','v_observaciones', 'estado'];

    public function permisos()
    {
        return $this->hasMany('App\Permiso','motivo_id');
    }
}
