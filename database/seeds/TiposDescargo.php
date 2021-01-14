<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDescargo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_tipodescargoactivofijo')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
        
        DB::table('tb_tipodescargoactivofijo')->insert([
            'v_descripcion' => 'Obsoleto',
        ]);
        DB::table('tb_tipodescargoactivofijo')->insert([
            'v_descripcion' => 'Mal Estado',
        ]);
        DB::table('tb_tipodescargoactivofijo')->insert([
            'v_descripcion' => 'Robo',
        ]);
        DB::table('tb_tipodescargoactivofijo')->insert([
            'v_descripcion' => 'Hurto',
        ]);
        DB::table('tb_tipodescargoactivofijo')->insert([
            'v_descripcion' => 'Inservible',
        ]);
    }
}
