<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //
    protected $fillable = [
      'primerNombre',
      'segundoNombre',
      'primerApellido',
      'segundoApellido',
      'nroIdentidad',
      'correo',
      'direccion',
      'telefono',
      'tipoSangre',
      'fechaNacimiento',
      'padecimiento',
      'genero',
      'pago',
      'idTutor',
      'idCurso',
      'idSeccion',
      'idSubscripcion'
    ];

    public function tutor(){
      return $this->belongsTo('\App\Tutor');
    }
}
