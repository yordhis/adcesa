<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreinscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preinscripciones', function (Blueprint $table) {
            $table->id();
            $table->string("codigo", 55)->nullable();
            $table->string("cedula_estudiante", 55)->nullable();
            $table->string("codigo_plan", 55)->nullable(); // este es el codigo del plan de pago
            $table->string("codigo_nivel", 55)->nullable(); // este es el codigo del curso o nivel
            $table->double('total', 11)->default(0);
            $table->double('abono', 11)->default(0);
            $table->string('comprobante', 255)->nullable();
            $table->string('referencia', 11)->nullable();
            $table->string("estatus", 55)->default(0); // 0 es pendiente por inscribir | 1 inscripto
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
        Schema::dropIfExists('preinscripciones');
    }
}
