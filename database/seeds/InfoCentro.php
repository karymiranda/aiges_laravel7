<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoCentro extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_infocentroeducativo')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
        
        DB::table('tb_infocentroeducativo')->insert([
            'v_nombrecentro' => 'CEC Santa Maria del Camino',
            'v_codigoinfraestructura' => '11810',
            'v_zona' => 'Rural',
            'canton_colonia_id' => 1,
            'v_direccion' => '',
            'v_telefono' => '',
            'correo_electronico' => 'CECSantaMariadelCamino@gmail',
            'nombre_director_ar' => 'Jorge Alberto Melara',
            'v_distrito' => 'San Vicente',
            'f_fechafundacion' => '2019-01-01',
        ]);
    }
}
