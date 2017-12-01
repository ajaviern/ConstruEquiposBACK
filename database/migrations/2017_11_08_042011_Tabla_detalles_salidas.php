<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaDetallesSalidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('detalles_salidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipos_id')->unsigned();
            $table->integer('alquileres_id')->unsigned();
            $table->date('fecha');
            $table->integer('cantidad');
            $table->integer('subtotal');
            $table->integer('estado')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('equipos_id')->references('id')->on('equipos');
            $table->foreign('alquileres_id')->references('id')->on('alquileres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_salidas');
    }
}
