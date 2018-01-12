<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Jenssegers\Date\Date;


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
    public function imagenes(){
        return $this->hasMany('App\Models\Image', 'item_id', 'uuid');
        //todo -- imagen ID -- ???
    }

    public function lugarInfo(){
        return $this->hasOne('App\Models\Lugar', 'id', 'lugar_id');
        //todo -- imagen ID -- ???
    }

    public function getFechaAttribute($fecha){
      $carbon = new Carbon($fecha);
      // return $carbon->diffForHumans();
      Date::setLocale('es');
      return $carbon->format('l d \d\e F');
    }
}
