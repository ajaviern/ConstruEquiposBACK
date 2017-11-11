<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAlquiler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquileres', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('total');
            $table->enum('estado',['pendiente', 'despachado','entregado','finalizado']);
            $table->integer('usuarios_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usuarios_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alquileres');
    }
}
