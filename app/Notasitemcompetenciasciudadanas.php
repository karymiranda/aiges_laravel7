<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notasitemcompetenciasciudadanas extends Model
{
    protected $table='nota_items_competenciaciudadana';
    protected $fillable=['id','notascompetenciasciudadanas_id','estudiante_id','nota','observaciones'];

    public function alumno()
    {
        return $this->belongsTo('App\Expedienteestudiante','estudiante_id');
    }

    public function notacompetenciaciudadana()
    {
        return $this->belongsTo('App\Notascompetenciasciudadanas');
    }
}
