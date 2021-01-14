<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbMunicipio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_municipios', function(Blueprint $table){
            $table->increments('id');
            $table->string('v_municipio');
            $table->integer('departamento_id')->unsigned();
            $table->foreign('departamento_id')->references('id')->on('tb_departamentos');
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
         Schema::dropIfExists('tb_municipios');
    }
}
