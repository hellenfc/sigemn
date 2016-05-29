<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $fillable=['nota', 'parcial', 'idEstudiante','idSeccionclase'];
}
