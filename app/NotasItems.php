<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotasItems extends Model
{
    
    protected $table='notas_items';

    public function alumno()
    {
        return $this->belongsTo('App\Expedienteestudiante');
    }

    public function nota()
    {
        return $this->belongsTo('App\Notas');
    }
}
