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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_banco')->nullable();
            $table->string('nombre_banco')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('telefono')->nullable();
            $table->string('titular')->nullable();
            $table->string('tipo_cuenta')->nullable(); // Ahorros, Corriente, etc.
            $table->string('metodo')->nullable(); // Transferencia, Deposito, etc.
            $table->string('estatus')->default(1); // 1: Activo, 0: Inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas');
    }
};
