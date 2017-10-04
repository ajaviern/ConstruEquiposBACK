<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateEquipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria')->unsigned();
            $table->string('descripcion');
            $table->string('modelo');
            $table->foreign('categoria')->references ('id')->on('categoriaequipo');
            $table->integer('estado');
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
        //
        Schema::dropIfExists('equipos');
    }
}