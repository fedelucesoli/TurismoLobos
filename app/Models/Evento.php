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
  'categoria',
  'lugar',
  'lugar_id',
  'superevento',
  'subevento',
  'order_column',
  'fecha_fin',
  'activo',
];
}
