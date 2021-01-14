<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Usuario_Rol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_usuario_rol')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
        
        DB::table('tb_usuario_rol')->insert([
            'usuario_id' => 1,
            'rolusuario_id' => 1,
        ]);
    }
}
