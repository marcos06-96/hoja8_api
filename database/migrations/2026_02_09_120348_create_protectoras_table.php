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
        Schema::create('protectoras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_protectora', 150);
            $table->string('slug', 150)->unique(); 
            $table->string('cif', 20)->unique();
            $table->string('numero_registro', 100)->nullable();
            $table->string('direccion_protectora', 255);
            $table->string('telefono_protectora', 20);
            $table->string('email_protectora', 150)->unique();
            $table->text('descripcion')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('web', 255)->nullable();
            $table->enum('estado', ['activa', 'pendiente', 'inactiva'])->default('pendiente');
            
            // Relación con usuario principal (nullable hasta que se asigne)
          $table->unsignedBigInteger('usuario_principal_id')->nullable();
     });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protectoras');
    }
};
