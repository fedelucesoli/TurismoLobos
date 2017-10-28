<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
  protected $fillable =[
  'titulo',
  'slug',
  'descripcion',
  'fecha',
  'hora',
  'badge',
  'categoria_id',
  'lugar',
  'lugar_id',
  'superevento',
  'subevento',
  'order_column',
  'fecha_fin',
  'activo',
];
  public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'categoria_id', 'id');
    }
}
