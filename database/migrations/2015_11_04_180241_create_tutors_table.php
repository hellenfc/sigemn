<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primerNombre',50);
            $table->string('segundoNombre',50)->nullable();
            $table->string('primerApellido',50);
            $table->string('segundoApellido',50)->nullable();
            $table->string('nroIdentidad', 50);
            $table->string('correo', 50)->nullable();
            $table->string('direccion');
            $table->integer('telefono');
            /*Asi se crea una llave foranea*/
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('tutors');
    }
}
