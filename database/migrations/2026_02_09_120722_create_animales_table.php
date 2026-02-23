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
        Schema::create('animales', function (Blueprint $table) {
            $table->id();
            
            // Relación con protectora
            $table->foreignId('protectora_id')
                  ->constrained('protectoras')
                  ->onDelete('cascade'); 
            
            $table->string('nombre', 100);
            $table->string('especie', 50); 
            $table->string('raza', 100)->nullable();
            $table->integer('edad_aproximada')->nullable(); 
            $table->enum('sexo', ['macho', 'hembra']);
            $table->enum('tamanio', ['pequeño', 'mediano', 'grande'])->nullable();
            $table->decimal('peso', 5, 2)->nullable(); 
            $table->string('color', 100)->nullable();
            $table->boolean('chip')->default(true);
            $table->boolean('esterilizado')->default(true);
            $table->boolean('vacunado')->default(true);
            $table->boolean('desparasitado')->default(true);
            $table->boolean('bueno_con_ninos')->default(false);
            $table->boolean('bueno_con_perros')->default(false);
            $table->boolean('bueno_con_gatos')->default(false);
            $table->enum('nivel_energia', ['bajo', 'medio', 'alto'])->nullable();
            $table->enum('adopcion_urgente', ['si', 'no'])->default('no');
            $table->text('necesidades_especiales')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('historia')->nullable();
            $table->enum('tipo_anuncio', ['adopcion', 'acogida', 'ambos'])->default('adopcion');
            $table->enum('estado', ['disponible', 'reservado', 'adoptado', 'fallecido'])->default('disponible');
            $table->string('localidad', 100)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
