<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscripcion extends Model
{
  protected $fillable = ['nombre', 'fechaFinal', 'fechaInicio','correo'];
}
