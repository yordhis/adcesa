<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 155)->nullable();
            $table->string('cedula', 35)->nullable();
            $table->string('telefono', 55)->nullable();
            $table->integer('edad')->nullable();
            $table->string('ocupacion', 100)->nullable();
            $table->text('direccion')->nullable();
            $table->string('correo', 255)->nullable();
            $table->boolean('estatus')->default(true);
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
        Schema::dropIfExists('representantes');
    }
}
