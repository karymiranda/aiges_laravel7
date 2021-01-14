<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Deptos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_departamentos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

    	DB::table('tb_departamentos')->insert([
            'v_departamento' => 'Ahuachapán',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'Cabañas',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'Chalatenango',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'Cuscatlán',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'Morazán',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'La Libertad',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'La Paz',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'La Unión',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'San Miguel',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'San Salvador',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'San Vicente',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'Santa Ana',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'Sonsonate',
        ]);
        DB::table('tb_departamentos')->insert([
            'v_departamento' => 'Usulután',
        ]);
    }
}
