<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestrojornadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*Aquí se esta la tabla transaccional con las llaves foraneas*/
        Schema::create('maestrojornadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idJornada')->unsigned();
            /*Sin unsigned da errores*/
            $table->foreign('idJornada')->references('id')->on('jornadas');
            /*Campo de esta table hace referencia al id de la tabla x*/
            $table->integer('idMaestro')->unsigned();
            $table->foreign('idMaestro')->references('id')->on('maestros');

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
        Schema::drop('maestrojornadas');
    }
}
