<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 55)->unique()->nullable();
            $table->string('nombre', 55)->nullable();
            $table->string('codigo_nivel', 55)->nullable();
            $table->string('cedula_profesor', 55)->nullable();
            $table->string('dias', 55)->nullable(); // dias que corresponde las clases
            $table->string('hora_inicio', 55)->nullable();
            $table->string('hora_fin', 55)->nullable();
            $table->string('fecha_inicio', 55)->nullable();
            $table->string('fecha_fin', 55)->nullable();
            $table->string('estatus', 55)->default(1);
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
        Schema::dropIfExists('grupos');
    }
}
