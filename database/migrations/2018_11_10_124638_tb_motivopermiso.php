
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbMotivopermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_motivopermisos',function(Blueprint $table){
            $table->increments('id');
            $table->string('v_motivo');
            $table->integer('i_maxpermisosanual');
            $table->integer('i_duracionmax');
            $table->boolean('estado');
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
        Schema::dropIfExists('tb_motivopermisos');
    }
}
