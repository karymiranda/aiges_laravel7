<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Parentesco extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_parentesco')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        DB::table('tb_parentesco')->insert([
            'parentesco' => 'Padre',
        ]);
        DB::table('tb_parentesco')->insert([
            'parentesco' => 'Madre',
        ]);
        DB::table('tb_parentesco')->insert([
            'parentesco' => 'Hermano/a',
        ]);
        DB::table('tb_parentesco')->insert([
            'parentesco' => 'Abuelo/a',
        ]);
        DB::table('tb_parentesco')->insert([
            'parentesco' => 'Tio/a',
        ]);
    }
}
