<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbPersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tb_personal',function(Blueprint $table){
            $table->increments('id');
            $table->string('v_nombres');
            $table->string('v_apellidos');
            $table->string('v_genero',9);
            $table->string('v_nit');
            $table->string('v_dui');
            $table->string('v_nip');
            $table->string('v_nup');
            $table->string('v_direccion',100);
            $table->string('v_telefonocasa',9);
            $table->string('v_celular',9);
            $table->date('f_fecnacimiento');
            $table->date('f_fecingresoalce');
            $table->date('f_fecingresoalmined');
            $table->string('v_tipopersonal');//no ira en otra tabla sino codificado en el mismo formulario  Admin- administrativo, Doc- docente, Co-cocina
            $table->string('v_tipocontratacion');//no ira en otra tabla sino codificado en el mismo formulario  SB- sueldo base, SS- sobresueldo, HC- horas clase
            $table->integer('cargo_id')->unsigned();
            $table->foreign('cargo_id')->references('id')->on('tb_cargoempleado');
            $table->double('d_sueldo');
            $table->string('v_tituloacademico');
            $table->string('especialidad_id')->unsigned();
            $table->foreign('especialidad_id')->references('id')->on('tb_especialidaddocente');
            $table->string('v_nivelescalafon');
            $table->string('v_categoriaescalafon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
