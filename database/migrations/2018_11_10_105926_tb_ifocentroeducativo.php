<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbIfocentroeducativo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_infocentroeducativo', function (Blueprint $table){
            $table->increments('id');
            $table->string('v_nombrecentro');
            $table->string('v_codigoinfraestructura');
            $table->string('v_zona');
            $table->string('v_departamento');
            $table->string('v_municipio');
            $table->string('v_canton');
            $table->string('v_direccion');
            $table->string('v_telefono');
            $table->string('v_distrito');
            $table->date('f_fechafundacion');

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
        Schema::dropIfExists('tb_infocentroeducativo');
    }
}
