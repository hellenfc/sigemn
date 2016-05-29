<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primerNombre',50);
            $table->string('segundoNombre',50)->nullable();
            $table->string('primerApellido',50);
            $table->string('segundoApellido',50)->nullable();
            $table->string('nroIdentidad', 50);
            $table->string('correo', 50)->nullable();
            $table->string('direccion');
            $table->integer('telefono');
            $table->string('tipoSangre', 30);
            $table->date('fechaNacimiento', 30);
            $table->string('padecimiento');
            $table->string('genero', 40);
            $table->string('pago', 40);
            /*Asi se crea una llave foranea*/
            $table->integer('idTutor')->unsigned();
            $table->foreign('idTutor')->references('id')->on('tutors');
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
        Schema::drop('estudiantes');
    }
}
