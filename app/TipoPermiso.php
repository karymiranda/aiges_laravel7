<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPermiso extends Model
{
    protected $table = "tb_tipopermisos";

    protected $fillable = ['v_descripcion', 'i_maxpermisosanual', 'i_duracionmax', 'estado'];

    public function permisos()
    {
        return $this->hasMany('App\Permiso','tipopermiso_id');
    }
}
