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
        Schema::create('nodos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('puesto');
            $table->longtext('foto');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('organigrama_id');
            $table->timestamps();

            // Relaciones
            $table->foreign('parent_id')->references('id')->on('nodos')->onDelete('cascade');
            $table->foreign('organigrama_id')->references('id')->on('organigramas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodos');
    }
};
