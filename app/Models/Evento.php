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
    public function imagen(){
        return $this->hasMany('App\Models\Image', 'item_id', 'id');
        //todo -- imagen ID -- ???
    }

    public function lugarInfo(){
        return $this->hasOne('App\Models\Lugar', 'id', 'lugar_id');
        //todo -- imagen ID -- ???
    }
}
