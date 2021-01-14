<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Familiares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familiares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('genero');
            $table->string('dui');
            $table->string('profesion');
            $table->string('lugardetrabajo');
            $table->string('direcciondetrabajo');
            $table->string('direccionderesidencia');
            $table->string('telefonocasa');
            $table->string('telefonotrabajo');
            $table->string('celular');
            $table->string('encargado');
            $table->date('fechanacimiento');
            $table->string('ultimogradocursado');
            $table->string('estado');
            $table->string('autorizadoaretirarestudiante');
            $table->integer('parentesco_id')->unsigned();
            $table->foreign('parentesco_id')->references('id')->on('parentesco');       
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
        Schema::dropIfExists('familiares');
    }
}
