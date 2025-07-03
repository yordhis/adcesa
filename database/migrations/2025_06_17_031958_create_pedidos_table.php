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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->double('total_a_pagar')->nullable();
            $table->string('id_cliente')->nullable();
            $table->string('nombres_cliente')->nullable();
            $table->string('apellidos_cliente')->nullable();
            $table->string('direccion_cliente')->nullable();
            $table->string('nacionalidad_cliente')->nullable();
            $table->string('cedula_cliente')->nullable();
            $table->string('telefono_cliente')->nullable();
            $table->string('email_cliente')->nullable();
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_entrega')->nullable();
            $table->string('tasa')->default(0);
            $table->string('estatus')->nullable(); 
            // Ejemplo: 'pendiente', 'presupuesto_enviado', 'rechazado', 'completado', 'pago_recibido', 'procesando_pedido', 'entregado'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
