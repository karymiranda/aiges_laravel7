<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogoCuentas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_catalogodecuentas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        DB::table('tb_catalogodecuentas')->insert([
            'v_nombrecuenta' => 'ACTIVO',
            'v_nivel' => '1',
            'v_codigocuenta' => '1',
            'tipocuenta_id' => '1',
            'v_tiposaldo' => 'DEUDOR',
            'estado' => '1',
        ]);
        DB::table('tb_catalogodecuentas')->insert([
            'v_nombrecuenta' => 'ACTIVO CORRIENTE',
            'v_nivel' => '2',
            'v_codigocuenta' => '11',
            'tipocuenta_id' => '1',
            'v_tiposaldo' => 'DEUDOR',
            'estado' => '1',
        ]);
        DB::table('tb_catalogodecuentas')->insert([
            'v_nombrecuenta' => 'ACTIVO FIJO',
            'v_nivel' => '2',
            'v_codigocuenta' => '12',
            'tipocuenta_id' => '1',
            'v_tiposaldo' => 'DEUDOR',
            'estado' => '1',
        ]);
        DB::table('tb_catalogodecuentas')->insert([
            'v_nombrecuenta' => 'PASIVO',
            'v_nivel' => '1',
            'v_codigocuenta' => '2',
            'tipocuenta_id' => '2',
            'v_tiposaldo' => 'ACREEDOR',
            'estado' => '1',
        ]);
        DB::table('tb_catalogodecuentas')->insert([
            'v_nombrecuenta' => 'PASIVO A CORTO PLAZO',
            'v_nivel' => '2',
            'v_codigocuenta' => '21',
            'tipocuenta_id' => '2',
            'v_tiposaldo' => 'ACREEDOR',
            'estado' => '1',
        ]);
    }
}
