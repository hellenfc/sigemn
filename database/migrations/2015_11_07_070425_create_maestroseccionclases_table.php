<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestroseccionclasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestroseccionclases', function (Blueprint $table) {
            $table->increments('id');
            $table->time('horaInicio');
            $table->time('horaFin');

            $table->integer('idMaestro')->unsigned();
            $table->foreign('idMaestro')->references('id')->on('maestros');
            $table->integer('idSeccion')->unsigned();
            $table->foreign('idSeccion')->references('id')->on('seccions');
            $table->integer('idClase')->unsigned();
            $table->foreign('idClase')->references('id')->on('clases');
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
        Schema::drop('maestroseccionclases');
    }
}
