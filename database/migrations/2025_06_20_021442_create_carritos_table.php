<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_pedido');
            $table->string('id_producto');
            $table->string('id_variante')->nullable();
            $table->string('nombre_producto')->nullable();
            $table->string('tipo_producto')->nullable();
            $table->string('alto_variante')->nullable();
            $table->string('ancho_variante')->nullable();
            $table->string('medida_variante')->nullable(); // m, cm, u, etc.
            $table->double('cantidad')->default(1);
            $table->double('precio')->nullable();
            $table->double('sub_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};
