<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbHorarioasignatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tb_horarioasignaturas',function(Blueprint $table){
            $table->increments('id');
            $table->string('v_dia');
            $table->time('t_horainicio');
            $table->time('t_horafin');
            $table->integer('asignatura_id')->unsigned();
            $table->foreign('asignatura_id')->references('id')->on('tb_asignaturas');
            $table->integer('grado_id')->unsigned();
            $table->foreign('grado_id')->references('id')->on('tb_grados');
            $table->integer('seccion_id')->unsigned();
            $table->foreign('seccion_id')->references('id')->on('secciones');
            $table->integer('turno_id')->unsigned();
            $table->foreign('turno_id')->references('id')->on('turnos');
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
        Schema::dropIfExist('tb_horarioasignaturas');
    }
}
