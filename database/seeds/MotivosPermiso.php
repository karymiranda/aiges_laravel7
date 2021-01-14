<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivosPermiso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_motivopermisos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
        
        DB::table('tb_motivopermisos')->insert([
            'v_motivo' => 'Personal',
            'estado' => '1',
        ]);
        DB::table('tb_motivopermisos')->insert([
            'v_motivo' => 'Cita Médica',
            'estado' => '1',
        ]);
        DB::table('tb_motivopermisos')->insert([
            'v_motivo' => 'Vacaciones',
            'estado' => '1',
        ]);
    }
}
