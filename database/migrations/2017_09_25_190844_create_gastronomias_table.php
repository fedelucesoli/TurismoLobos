<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastronomiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastronomia', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre');
          $table->string('direccion');
          $table->string('localidad');
          $table->string('telefono')->nullable()	;
          $table->string('web')->nullable()	;
          $table->string('email')->nullable()	;
          $table->string('horarios')->nullable()	;

          $table->decimal('lng', 11, 7)->nullable()	;
          $table->decimal('lat', 11, 7)->nullable()	;

          $table->integer('categoria_id')->unsigned();
          $table->foreign('categoria_id')->references('id')->on('categorias');

          $table->string('estrellas')->nullable()	;
          $table->boolean('activo')->default(0);
          
          $table->integer('usuario_id')->unsigned();
          $table->foreign('usuario_id')->references('id')->on('users');

          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastronomia');
    }
}
