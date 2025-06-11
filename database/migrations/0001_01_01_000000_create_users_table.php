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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 155)->nullable();
            $table->string('apellidos', 155)->nullable();
            $table->string('cedula', 155)->nullable();
            $table->string('nacionalidad', 155)->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('telefono', 155)->nullable();
            $table->string('direccion', 155)->nullable();
            $table->string('pais', 155)->nullable();
            $table->string('estado', 155)->nullable();
            $table->string('ciudad', 155)->nullable(); // municipio
            $table->string('rol', 55)->default(3); // 1: Admin, 2: Editor, 3: User
            $table->string('foto', 255)->nullable();
            $table->string('fecha_nacimiento', 255)->nullable();
            $table->string('email')->unique();
            $table->boolean('estatus')->default(true); // true: activo, false: inactivo
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
