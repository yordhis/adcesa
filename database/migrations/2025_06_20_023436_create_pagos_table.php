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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_pedido', 55)->nullable();
            $table->string('id_cuenta', 11)->nullable();
            $table->double('monto', 55)->nullable();
            $table->string('fecha', 55)->nullable();
            $table->string('comprobante', 255)->nullable();
            $table->string('referencia', 255)->nullable();
            $table->string('metodo_pago', 255)->nullable();
            $table->string('codigo_cuenta', 255)->nullable();
            $table->string('titular_cuenta', 255)->nullable();
            $table->string('telefono_cuenta', 255)->nullable();
            $table->string('numero_cuenta', 255)->nullable();
            $table->string('nombre_cuenta', 255)->nullable();
            $table->string('estatus', 55)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
