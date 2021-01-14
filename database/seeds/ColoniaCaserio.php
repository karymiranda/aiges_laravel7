<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColoniaCaserio extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_colonia_caserio')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        DB::table('tb_colonia_caserio')->insert([
            'v_caserio' => 'Barrio El Centro',
            'municipio_id' => '198', //Apastepeque
            'zonaRoU' => 'Urbana',
            'zonariesgoSN' => 'No',
        ]);
    }
}
