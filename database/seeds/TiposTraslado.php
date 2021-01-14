<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposTraslado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_tipotrasladoactivofijo')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        DB::table('tb_tipotrasladoactivofijo')->insert([
            'v_descripcion' => 'Préstamo',
        ]);
        DB::table('tb_tipotrasladoactivofijo')->insert([
            'v_descripcion' => 'Reparación',
        ]);
        DB::table('tb_tipotrasladoactivofijo')->insert([
            'v_descripcion' => 'Traslado Definitivo',
        ]);
    }
}
