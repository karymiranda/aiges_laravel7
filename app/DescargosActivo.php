<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescargosActivo extends Model
{
    protected $table = "tb_descargoactivo";

    protected $fillable = ['f_fechasolicitud','numsolicitud', 'f_fechaaprobacion', 'urlactadeaprobacion','nombredearchivo','estado','observaciones'];


   public function descargo_detalle()
    {
        return $this->belongsToMany(ActivoFijo::class,'tb_detallesolicituddescargo_activofijo','solicitud_id','activofijo_id')->withPivot('id','tipodescargo_id');
        //return $this->belongsToMany('App\ActivoFijo','activofijo_id');
    }

     /*  public function activofijo()
    {
        return $this->belongsToMany(ActivoFijo::class'tb_detallesolicituddescargo_activofijo','id','activofijo_id');
    	//return $this->belongsToMany('App\ActivoFijo','activofijo_id');
	}

	public function tipodescargo()
    {
        return $this->belongsToMany(TipoDescargoActivo::class,'tb_detallesolicituddescargo_activofijo','id','tipodescargo_id');
    	//return $this->belongsTo('App\TipoDescargoActivo','tipodescargo_id');
	}

     public function solicituddescargo_activofijo()
    {
 return $this->belongsToMany('App\ActivoFijo','tb_detallesolicituddescargo_activofijo','solicitud_id','activofijo_id')->withPivot('id','estadosolicitud');
 }*/

}
