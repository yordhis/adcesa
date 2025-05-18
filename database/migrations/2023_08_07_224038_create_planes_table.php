<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->string("codigo", 55)->unique()->nullable();
            $table->string("nombre", 255)->nullable();
            $table->string("cantidad_cuotas", 11)->nullable(); // cuantas veces se va a dividir los pagos
            $table->string("plazo", 255)->nullable();
            $table->string("descripcion", 255)->nullable(); // el plazo en lo que se dividira el pago
            $table->string("estatus", 55)->default(1); /** 0 = eliminado; 1 = Activo para el sistema; 2 = Activo para elsistema y la WEB */
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
        Schema::dropIfExists('planes');
    }
}
