<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Especialidad extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_especialidaddocente')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
        
        DB::table('tb_especialidaddocente')->insert([
            'v_especialidad' => 'Licenciatura',
            'estado' => '1',
        ]);
    }
}
