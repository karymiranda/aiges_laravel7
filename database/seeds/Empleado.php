<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Empleado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_empleado')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        DB::table('tb_empleado')->insert([
            'v_nombres' => 'SUPER ADMINISTRADOR',
            'v_apellidos' => 'DEFAULT', 
            'f_fechanaci' => '1989-01-01',
            'v_genero' => 'Masculino',
            'v_direccioncasa' => 'APASTEPEQUE',
            'v_dui' => '00000000-0', 
            'v_nit' => '0000-000000-000-0',
            'v_tipocontratacion' => 'SB',
            'tipopersonal_id' => 1,
            'cargo_id' => 1, 
            'especialidad_id' => 1,
            'v_nivelescalafon' => '1',
            'v_categoriaescalafon' => '1',
            'v_numeroexp' => 'RH0000-0',
            'v_correo' => 'ctaadminCECSMC@gmail.com', 
            'estado' => '1',
        ]);
    }
}
