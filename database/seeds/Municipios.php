<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Municipios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('tb_municipios')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

//Depto Ahuachapan 12 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ahuachapán',
            'departamento_id' => 1,
        ]);
    	DB::table('tb_municipios')->insert([
            'v_municipio' => 'Apaneca',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Atiquizaya',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Concepción de Ataco',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Refugio',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Guaymango',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jujutla',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Francisco Menéndez',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Lorenzo',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Pedro Puxtla',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tacuba',
            'departamento_id' => 1,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Turín',
            'departamento_id' => 1,
        ]);

//Depto Cabañas 9 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Cinquera',
            'departamento_id' => 2,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Dolores/Villa Dolores',
            'departamento_id' => 2,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Guacotecti',
            'departamento_id' => 2,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ilobasco',
            'departamento_id' => 2,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jutiapa',
            'departamento_id' => 2,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Isidro',
            'departamento_id' => 2,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Sensuntepeque',
            'departamento_id' => 2,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tejutepeque',
            'departamento_id' => 2,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Victoria',
            'departamento_id' => 2,
        ]);

//Depto Chalatenango 33 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Agua Caliente',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Arcatao',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Azacualpa',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Chalatenango',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Citalá',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Comalapa',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Concepción Quezaltepeque',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Dulce Nombre de María',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Carrizal',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Paraíso',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'La Laguna',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'La Palma',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'La Reina',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Las Vueltas',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nombre de Jesús',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nueva Concepción',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nueva Trinidad',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ojos de Agua',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Potonico',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Antonio de la Cruz',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Antonio Los Ranchos',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Fernando',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Francisco Lempa',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Francisco Morazán',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Ignacio',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Isidro Labrador',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San José Cancasque/Cancasque',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San José Las Flores/Las Flores',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Luis del Carmen',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Miguel de Mercedes',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Rafael',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Rita',
            'departamento_id' => 3,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tejutla',
            'departamento_id' => 3,
        ]);

//Depto Cuscatlán 16 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Candelaria',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Cojutepeque',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Carmen',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Rosario',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Monte San Juan',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Oratorio de Concepción',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Bartolomé Perulapía',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Cristóbal',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San José Guayabal',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Pedro Perulapán',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Rafael Cedros',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Ramón',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Cruz Analquito',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Cruz Michapa',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Suchitoto',
            'departamento_id' => 4,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tenancingo',
            'departamento_id' => 4,
        ]);

//Depto Morazán 26 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Arambala',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Cacaopera',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Chilanga',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Corinto',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Delicias de Concepción',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Divisadero',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Rosario',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Gualococti',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Guatajiagua',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Joateca',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jocoaitique',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jocoro',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Lolotiquillo',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Meanguera',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Osicala',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Perquín',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Carlos',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Fernando',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Francisco Gotera',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Isidro',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Simón',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Sensembra',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Sociedad',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Torola',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Yamabal',
            'departamento_id' => 5,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Yoloaiquín',
            'departamento_id' => 5,
        ]);

//Depto La Libertad 22 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Antiguo Cuscatlán',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Chiltiupán',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ciudad Arce',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Colón',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Comasagua',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Huizúcar',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jayaque',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jicalapa',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'La Libertad',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Tecla',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nuevo Cuscatlán',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Juan Opico',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Quezaltepeque',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Sacacoyo',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San José Villanueva',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Matías',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Pablo Tacachico',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Talnique',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tamanique',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Teotepeque',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tepecoyo',
            'departamento_id' => 6,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Zaragoza',
            'departamento_id' => 6,
        ]);

//Depto La Paz 22 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Cuyultitán',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Rosario/Rosario de La Paz',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jerusalén',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Mercedes La Ceiba',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Olocuilta',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Paraíso de Osorio',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Antonio Masahuat',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Emigdio',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Francisco Chinameca',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Juan Nonualco',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Juan Talpa',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Juan Tepezontes',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Luis La Herradura',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Luis Talpa',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Miguel Tepezontes',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Pedro Masahuat',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Pedro Nonualco',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Rafael Obrajuelo',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa María Ostuma',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santiago Nonualco',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tapalhuaca',
            'departamento_id' => 7,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Zacatecoluca',
            'departamento_id' => 7,
        ]);

//Depto La Unión 18 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Anamorós',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Bolívar',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Concepción de Oriente',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Conchagua',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Carmen',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Sauce',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Intipucá',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'La Unión',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Lilisque',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Meanguera del Golfo',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nueva Esparta',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Pasaquina',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Polorós',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Alejo',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San José',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Rosa de Lima',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Yayantique',
            'departamento_id' => 8,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Yucuaiquín',
            'departamento_id' => 8,
        ]);

//Depto San Miguel 20 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Carolina',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Chapeltique',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Chinameca',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Chirilagua',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ciudad Barrios',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Comacarán',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Tránsito',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Lolotique',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Moncagua',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nueva Guadalupe',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nuevo Edén de San Juan',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Quelepa',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Antonio del Mosco',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Gerardo',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Jorge',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Luis de la Reina',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Miguel',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Rafael Oriente',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Sesori',
            'departamento_id' => 9,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Uluazapa',
            'departamento_id' => 9,
        ]);

//Depto San Salvador 19 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Aguilares',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Apopa',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ayutuxtepeque',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Delgado',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Cuscatancingo',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Paisnal',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Guazapa',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ilopango',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Mejicanos',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nejapa',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Panchimalco',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Rosario de Mora',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Marcos',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Martín',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Salvador',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santiago Texacuangos',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santo Tomás',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Soyapango',
            'departamento_id' => 10,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tonacatepeque',
            'departamento_id' => 10,
        ]);

//Depto San Vicente 13 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Apastepeque',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Guadalupe',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Cayetano Istepeque',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Esteban Catarina',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Ildefonso',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Lorenzo',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Sebastián',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Vicente',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Clara',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santo Domingo',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tecoluca',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tepetitán',
            'departamento_id' => 11,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Verapaz',
            'departamento_id' => 11,
        ]);

//Depto Santa Ana 13 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Candelaria de la Frontera',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Chalchuapa',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Coatepeque',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Congo',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Porvenir',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Masahuat',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Metapán',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Antonio Pajonal',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Sebastián Salitrillo',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Ana',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Rosa Guachipilín',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santiago de la Frontera',
            'departamento_id' => 12,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Texistepeque',
            'departamento_id' => 12,
        ]);

//Depto Sonsonate 16 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Acajutla',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Armenia',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Caluco',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Cuisnahuat',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Izalco',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Juayúa',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nahuizalco',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nahulingo',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Salcoatitán',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Antonio del Monte',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Julián',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Catarina Masahuat',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Isabel Ishuatán',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santo Domingo de Guzmán',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Sonsonate',
            'departamento_id' => 13,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Sonzacate',
            'departamento_id' => 13,
        ]);

//Depto Usulután 23 municipios
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Alegría',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Berlín',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'California',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Concepción Batres',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'El Triunfo',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ereguayquín',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Estanzuelas',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jiquilisco',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jucuapa',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Jucuarán',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Mercedes Umaña',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Nueva Granada',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Ozatlán',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Puerto El Triunfo',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Agustín',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Buenaventura',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Dionisio',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'San Francisco Javier',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa Elena',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santa María',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Santiago de María',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Tecapán',
            'departamento_id' => 14,
        ]);
        DB::table('tb_municipios')->insert([
            'v_municipio' => 'Usulután',
            'departamento_id' => 14,
        ]);
    }
}
