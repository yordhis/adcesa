<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->string("codigo", 55)->nullable();
            $table->string("cedula_estudiante", 55)->nullable();
            $table->string("codigo_grupo", 55)->nullable();
            $table->string("codigo_plan", 55)->nullable(); // este es el codigo del plan de pago
            $table->string("codigo_nivel", 55)->nullable(); // este es el codigo del curso o nivel
            $table->string("nota", 55)->nullable();
            $table->string("fecha", 55)->nullable();
            $table->text("extras")->nullable();
            $table->string("estatus", 55)->default(1); // estatus 2 es preinscripto | 3 es curso culminado
            $table->double('total', 11)->default(0);
            $table->double('abono', 11)->default(0);
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
        Schema::dropIfExists('inscripciones');
    }
}
