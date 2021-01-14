<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Usuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        DB::table('users')->insert([
            'name' => 'RH2019-1',
            'email' => 'ctaadminCECSMC@gmail.com', 
            'password' => bcrypt('AdminCECSMC2019'),
            'personal_id' => 1,
            'estado' => '1',
            'foto' => 'nofound.jpg',
        ]);
    }
}
