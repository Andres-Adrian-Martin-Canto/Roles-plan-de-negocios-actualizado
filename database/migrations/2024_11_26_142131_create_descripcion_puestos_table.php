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
            $table->string('codigo'); // Código que el usuario puede ingresar manualmente y debe ser único
            $table->string('unidad_administrativa'); // Unidad administrativa del puesto
            $table->string('nombre_puesto'); // Nombre del puesto
            $table->string('otros_nombres_puestos')->nullable(); // Otros nombres puestos
            $table->integer('numero_plaza'); // Número de plaza
            $table->string('jornada_laboral'); // Tipo de jornada laboral 
            $table->string('otros_jornada_laboral')->nullable(); //otros_jornada_laboral
            $table->decimal('salario_minimo', 10, 2); // Salario mínimo
            $table->decimal('salario_maximo', 10, 2); // Salario máximo
            $table->integer('puesto_superior')->nullable(); // Quién reporta a este puesto
            $table->json('puesto_subornidado')->nullable();// Quién supervisa este puesto
            $table->text('comunicacion_interna')->nullable(); // Comunicación interna
            $table->text('comunicacion_externa')->nullable(); // Comunicación externa
            $table->text('objetivos_puesto'); // Objetivos del puesto  
            $table->text('descripcion_generica'); // Descripción general
            $table->text('descripcion_especifica'); // Descripción específica
            $table->string('forma_pago'); // fomra del pago
            $table->string('estado_civil')->nullable(); // Estado civil del candidato
            $table->string('edad')->nullable(); // Edad del candidato
            $table->string('nacionalidad')->nullable(); // nacionalidad
            $table->string('sexo')->nullable(); // Género del candidato
            $table->string('estatura')->nullable(); // Estatura
            $table->string('antecedentes')->nullable(); // antecedentes
            $table->string('experiencia')->nullable(); // experiencia
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
