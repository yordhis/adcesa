<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 155)->nullable();
            $table->string('nacionalidad', 25)->nullable();
            $table->string('cedula', 35)->nullable();
            $table->string('telefono', 55)->nullable();
            $table->string('correo', 255)->nullable();
            $table->string('nacimiento', 100)->nullable();
            $table->integer('edad')->nullable();
            $table->text('direccion')->nullable();
            $table->string('foto')->default('/assets/img/avatar.png');
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
        Schema::dropIfExists('profesores');
    }
}
