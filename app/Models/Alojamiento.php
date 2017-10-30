<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
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
    'estrellas',
    'activo',
    'id_usuario'
    ];

    public function categoria(){
          return $this->belongsTo('App\Models\Categoria', 'categoria_id', 'id');
      }

}
