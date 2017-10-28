<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
          $table->increments('id');

          $table->string('titulo');
          $table->string('slug')->unique();

          $table->text('descripcion')->nullable();
          $table->date('fecha');
          $table->string('hora');

          $table->string('badge')->nullable();

          $table->string('categoria');
          $table->integer('lugar_id')->unsigned();
          $table->foreign('lugar_id')->references('id')->on('lugares');

          $table->integer('usuario_id')->unsigned();
          $table->foreign('usuario_id')->references('id')->on('users');

          $table->integer('superevento')->nullable();
          $table->integer('subevento')->nullable();

          $table->integer('order_column')->nullable();
          $table->string('fecha_fin')->nullable();

          $table->boolean('activo')->default(0);

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
        Schema::dropIfExists('eventos');
    }
}
