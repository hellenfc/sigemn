<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nota');
            $table->string('parcial',20);

        
            
            $table->integer('idEstudiante')->unsigned();
            $table->foreign('idEstudiante')->references('id')->on('estudiantes');
            
            $table->integer('idSeccionclase')->unsigned();
            $table->foreign('idSeccionclase')->references('id')->on('seccionclases');
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
        Schema::drop('notas');
    }
}
