<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Columnaseccionjornada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('seccions', function (Blueprint $table) {
            /*campos que son agregados a la tabla estudiante*/
            $table->integer('idJornada')->unsigned()->default('1');
            $table->foreign('idJornada')->references('id')->on('jornadas');
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
