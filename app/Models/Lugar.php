<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    protected $table = 'lugares';
    protected $fillable = [
    'nombre',
    'direccion',
    'localidad',
    'telefono',
    'web',
    'email',
    'lng',
    'lat',
    'activo',
    'categoria',
    'listar_en',
    'id_usuario'
   ];
}
