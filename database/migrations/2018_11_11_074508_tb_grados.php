<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Grado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('grado');
            $table->string('estado');
            $table->integer('turno_id')->unsigned();
           $table->integer('seccion_id')->unsigned();          

            $table->foreign('turno_id')->references('id')->on('turnos');
             $table->foreign('seccion_id')->references('id')->on('secciones');

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
        Schema::dropIfExists('grados');
    }
}
