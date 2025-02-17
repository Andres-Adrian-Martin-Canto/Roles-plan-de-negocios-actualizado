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
        Schema::create('imagenes_corporativas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_de_negocio_id')->constrained('plan_de_negocios')->onDelete('cascade');
            $table->string('nombre_corporativo');
            $table->text('justificacion_nombre');
            $table->text('logotipo');
            $table->text('justificacion_logo');
            $table->string('eslogan');
            $table->text('justificacion_eslogan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_corporativas');
    }
};
