<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_ingresos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_detalles_salidas')->unsigned();
            $table->foreign('id_detalles_salidas')->references ('id')->on('detalles_salidas');
            $table->integer('cantidad_ingreso');
            $table->date('fecha_ingreso');
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
        Schema::dropIfExists('ingresos');
    }
}
