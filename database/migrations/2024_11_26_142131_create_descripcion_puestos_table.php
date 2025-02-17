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
        Schema::create('descripcion_puestos', function (Blueprint $table) {
            $table->id(); // ID autoincrementable
            $table->foreignId('plan_de_negocio_id')->constrained('plan_de_negocios')->onDelete('cascade'); // Relación con la tabla plan_de_negocios
            $table->string('nivel'); // Nivel del puesto
            $table->string('codigo')->unique(); // Código que el usuario puede ingresar manualmente y debe ser único
            $table->string('unidad_administrativa'); // Unidad administrativa del puesto
            $table->string('nombre_puesto'); // Nombre del puesto
            $table->text('descripcion_generica'); // Descripción general
            $table->text('descripcion_especifica'); // Descripción específica
            $table->text('objetivos_puesto'); // Objetivos del puesto
            $table->decimal('salario_minimo', 10, 2); // Salario mínimo
            $table->decimal('salario_maximo', 10, 2); // Salario máximo
            $table->string('jornada_laboral'); // Tipo de jornada laboral
            $table->integer('numero_plaza'); // Número de plaza
            $table->integer('reporta_a')->nullable(); // Quién reporta a este puesto
            $table->integer('supervisa_a')->nullable(); // Quién supervisa este puesto
            $table->text('comunicacion_interna')->nullable(); // Comunicación interna
            $table->text('comunicacion_externa')->nullable(); // Comunicación externa
            $table->string('estado_civil')->nullable(); // Estado civil del candidato
            $table->integer('edad')->nullable(); // Edad del candidato
            $table->string('genero')->nullable(); // Género del candidato
            $table->text('requisitos_generales')->nullable(); // Requisitos generales
            $table->text('habilidades_fisicas')->nullable(); // Habilidades físicas
            $table->text('habilidades_mentales')->nullable(); // Habilidades mentales
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descripcion_puestos');
    }
};
