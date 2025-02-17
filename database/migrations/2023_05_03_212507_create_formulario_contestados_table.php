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
        Schema::create('formulario_contestados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_id');
            $table->unsignedBigInteger('pregunta_id');
            $table->unsignedBigInteger('respuesta_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulario_contestados');
    }
};
