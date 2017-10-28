<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastronomia extends Model
{
    protected $table = 'gastronomia';
    protected $fillable =[
      'nombre',
      'direccion',
      'localidad',
      'telefono',
      'web',
      'email',
      'lng',
      'lat',
      'categoria',
      'activo',
      'id_usuario',
      'horarios'
      ];
}
