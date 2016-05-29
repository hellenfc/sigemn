<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
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

    public function estudiantes(){
      return $this->hasMany('\App\Estudiante');
    }

    public function user(){
      return $this->belongsTo('\App\User');
    }
}
