<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbCaserio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
        public function up()
    {
        Schema::create('tb_caserios', function (Blueprint $table){
            $table->increments('id');
            $table->string('v_caserio');
            $table->string('v_zonaRuoUrba');
            $table->string('v_zonariesgoSN');
            $table->string('v_tiporiesgo');
            $table->integer('municipio_id')->unsigned();
            $table->foreign('municipio_id')->references('id')->on('tb_municipios');
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
        Schema::dropIfExists('tb_caserios');
    }
}
