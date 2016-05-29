<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $fillable = ['nombre', 'aula', 'idCurso', 'cupos','idJornada','idSubscripcion'];
}
