<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('estudiantes', function (Blueprint $table) {
          $table->integer('idSubscripcion')->unsigned();
          $table->foreign('idSubscripcion')->references('id')->on('subscripcions')->onDelete('cascade');
      });

      Schema::table('users', function (Blueprint $table) {
          $table->integer('idSubscripcion')->unsigned();
          $table->foreign('idSubscripcion')->references('id')->on('subscripcions')->onDelete('cascade');
      });

      Schema::table('jornadas', function (Blueprint $table) {
          $table->integer('idSubscripcion')->unsigned();
          $table->foreign('idSubscripcion')->references('id')->on('subscripcions')->onDelete('cascade');
      });

      Schema::table('cursos', function (Blueprint $table) {
          $table->integer('idSubscripcion')->unsigned();
          $table->foreign('idSubscripcion')->references('id')->on('subscripcions')->onDelete('cascade');
      });

      Schema::table('clases', function (Blueprint $table) {
          $table->integer('idSubscripcion')->unsigned();
          $table->foreign('idSubscripcion')->references('id')->on('subscripcions')->onDelete('cascade');
      });

      Schema::table('seccions', function (Blueprint $table) {
          $table->integer('idSubscripcion')->unsigned();
          $table->foreign('idSubscripcion')->references('id')->on('subscripcions')->onDelete('cascade');
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
