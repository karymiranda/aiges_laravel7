<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasificacionCuentas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_clasificacioncuentacatalogo')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        DB::table('tb_clasificacioncuentacatalogo')->insert([
            'v_tipocuenta' => 'Activo',
            'estado' => '1',
        ]);
        DB::table('tb_clasificacioncuentacatalogo')->insert([
            'v_tipocuenta' => 'Pasivo',
            'estado' => '1',
        ]);
        DB::table('tb_clasificacioncuentacatalogo')->insert([
            'v_tipocuenta' => 'Patrimonio',
            'estado' => '1',
        ]);
        DB::table('tb_clasificacioncuentacatalogo')->insert([
            'v_tipocuenta' => 'Cuentas de resultado deudora',
            'estado' => '1',
        ]);
        DB::table('tb_clasificacioncuentacatalogo')->insert([
            'v_tipocuenta' => 'Cuentas de resultado acreedora',
            'estado' => '1',
        ]);
        DB::table('tb_clasificacioncuentacatalogo')->insert([
            'v_tipocuenta' => 'Cuentas de orden',
            'estado' => '1',
        ]);
        DB::table('tb_clasificacioncuentacatalogo')->insert([
            'v_tipocuenta' => 'Cuentas de cierre',
            'estado' => '1',
        ]);
    }
}
