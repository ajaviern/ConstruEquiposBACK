<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTTpeticionesinternasProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tt_peticionesinternas_producto', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('id_peticionesinternas')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_peticionesinternas')->references ('id')->on('peticionesinternas');
            $table->foreign('id_producto')->references ('id')->on('producto');
            $table->string('aprobado');
            $table->string('cantidad');
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
        Schema::dropIfExists('tt_peticionesinternas_producto');
    }
}

