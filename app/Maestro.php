<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
     protected $fillable = [
      'primerNombre',
      'primerNombre',
      'segundoNombre',
      'primerApellido',
      'segundoApellido',
      'nroIdentidad',
      'correo',
      'direccion',
      'telefono',
      'user_id'
    ];
}
