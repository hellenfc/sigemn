<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestroseccionclase extends Model
{
    protected $fillable = ['horaInicio', 'horaFin', 'idClase', 'idMaestro', 'idSeccion', 'diaClase'];
}
