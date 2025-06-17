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
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_barra')->nullable();
            $table->string('nombre', 255);
            $table->decimal('precio');
            $table->decimal('costo');
            $table->decimal('cantidad');
            $table->decimal('unidad'); // total de metros ... de cada unidad
            $table->decimal('stock'); // total de metros... del insumo
            $table->string('marca')->nullable();
            $table->string('categoria')->nullable();
            $table->string('almacen')->nullable();
            $table->string('imagen')->nullable();
            $table->string('estatus')->default('ACTIVO');
            $table->string('id_medida')->nullable(); 
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
        Schema::dropIfExists('insumos');
    }
};
