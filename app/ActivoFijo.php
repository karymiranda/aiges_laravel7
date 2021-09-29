<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivoFijo extends Model
{
    protected $table = "tb_activofijo";

    protected $fillable = ['cuentacatalogo_id', 'v_nombre', 'v_codigoactivo','f_fecha_adquisicion', 'v_serie', 'v_modelo', 'v_marca', 'v_estado', 'd_valor', 'v_ubicacion', 'v_vidautil', 'v_medida', 'v_materialdeconstruccion', 'v_condicionactivo', 'v_observaciones','v_trasladadoSN', 'v_formaadquisicion', 'v_documento', 'v_estadoaf'];

    public function cuentacatalogo()
    {
    	return $this->belongsTo('App\Catalogodecuenta','cuentacatalogo_id');
	}

	public function traslados()
    {
    	return $this->hasMany('App\TrasladosActivo');
	}

//relacion muchos a muchos
	  public function detalle_descargo()
    {
        return $this->belongsToMany(DescargosActivo::class,'tb_detallesolicituddescargo_activofijo','activofijo_id','solicitud_id')->withPivot('id','tipodescargo_id');
        
    }

    public function activo_depreciacion()
    {
        return $this->hasMany('App\DepreciacionActivoFijo','activofijo_id');   
     }
}
