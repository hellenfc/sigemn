<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEstudiantesSeccioncurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            /*campos que son agregados a la tabla estudiante*/
            $table->integer('idCurso')->unsigned();
            $table->foreign('idCurso')->references('id')->on('cursos');
            $table->integer('idSeccion')->unsigned()->nullable();
            $table->foreign('idSeccion')->references('id')->on('seccions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            /*campos que son agregados a la tabla estudiante*/
            $table->dropForeign('idCurso', 'idSeccion')->unsigned();

        });
    }
}
