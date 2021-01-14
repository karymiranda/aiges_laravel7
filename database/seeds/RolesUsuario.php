<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_rolusuario')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
        
        DB::table('tb_rolusuario')->insert([
            'v_nombrerol' => 'Super Administrador',
            'i_estado' => '1',
        ]);
        DB::table('tb_rolusuario')->insert([
            'v_nombrerol' => 'Administrador bono escolar',
            'i_estado' => '1',
        ]);
        DB::table('tb_rolusuario')->insert([
            'v_nombrerol' => 'Administrador activo fijo',
            'i_estado' => '1',
        ]);
        DB::table('tb_rolusuario')->insert([
            'v_nombrerol' => 'Administrador academico',
            'i_estado' => '1',
        ]);
        DB::table('tb_rolusuario')->insert([
            'v_nombrerol' => 'Docente',
            'i_estado' => '1',
        ]);
        DB::table('tb_rolusuario')->insert([
            'v_nombrerol' => 'Estudiante',
            'i_estado' => '1',
        ]);
        DB::table('tb_rolusuario')->insert([
            'v_nombrerol' => 'Padre de familia',
            'i_estado' => '1',
        ]);
        DB::table('tb_rolusuario')->insert([
            'v_nombrerol' => 'Administrador recurso humano',
            'i_estado' => '1',
        ]);
    }
}
