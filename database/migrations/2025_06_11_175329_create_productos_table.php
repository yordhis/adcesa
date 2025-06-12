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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_barra')->nullable();
            $table->string('nombre', 255);
            $table->string('descripcion', 255)->nullable();
            $table->string('tipo_producto', 255)->default(0); // 1: Compuesto | 0: No compuesto
            $table->decimal('precio')->default(0);
            $table->string('imagen');
            $table->decimal('stock')->default(0); // total de metros... del insumo
            $table->decimal('costo')->nullable();
            $table->string('marca')->nullable();
            $table->string('categoria')->nullable();
            $table->string('almacen')->nullable();
            $table->string('estatus')->default('ACTIVO'); // ACTIVOS | INACTIVO
            $table->string('id_almacen')->nullable();
            $table->string('id_marca')->nullable();
            $table->string('id_categoria')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
