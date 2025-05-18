<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('niveles', function (Blueprint $table) {
            $table->id();
            $table->string("codigo", 55)->unique()->nullable();
            $table->string("nombre", 255)->nullable();
            $table->string("precio", 11)->nullable();
            $table->string("libro", 255)->nullable();
            $table->string("duracion", 255)->nullable(); // se ingresa la cantidad de meses
            $table->string("tipo_duracion", 255)->nullable(); // recive dias o meses
            $table->string("imagen", 255)->nullable(); // recive dias o meses
            $table->string("tipo_nivel", 255)->nullable(); // recive dias o meses
            $table->string("estatus", 255)->default(1); // 1.activo - 2.en promoción 
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
        Schema::dropIfExists('niveles');
    }
}
