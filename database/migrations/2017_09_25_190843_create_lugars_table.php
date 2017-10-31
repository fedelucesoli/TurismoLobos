<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLugarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lugares', function (Blueprint $table) {
          $table->increments('id');

          $table->string('nombre');
          $table->string('direccion');
          $table->string('localidad');
          $table->string('telefono')->nullable()	;
          $table->string('web')->nullable()	;
          $table->string('email')->nullable()	;
          $table->integer('categoria_id')->unsigned()->nullable();
          $table->foreign('categoria_id')->references('id')->on('categorias');


          $table->decimal('lng', 11, 7)->nullable()	;
          $table->decimal('lat', 11, 7)->nullable()	;

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
        Schema::dropIfExists('lugares');
    }
}
