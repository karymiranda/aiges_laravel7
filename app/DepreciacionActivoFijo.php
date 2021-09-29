<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepreciacionActivoFijo extends Model
{
    use HasFactory;
    protected $table = "tb_depreciacionanual";
    protected $fillable = ['f_fechamovimiento','d_depreciacionanual','d_depreciacionacumulada','d_valorenlibros','anio'];

     public function depreciacion_activo()
    {
        return $this->belongsTo('App\ActivoFijo','activofijo_id');
    }
}
