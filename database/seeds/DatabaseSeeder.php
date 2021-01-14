<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	/*$this->truncateTables([
    		'tb_empleado',
    		'tb_usuario_rol',
    		'tb_users',
    	]);*/

    	$this->call(Usuario_Rol::class);
    }
}
