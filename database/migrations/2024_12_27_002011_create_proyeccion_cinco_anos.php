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
        Schema::create('proyeccion_cinco_anos', function (Blueprint $table) {
            $table->id();

            // Relación con proyección_de_sueldo (eliminación en cascada)
            $table->unsignedBigInteger('proyección_de_sueldos'); 
            $table->foreign('proyección_de_sueldos')
                  ->references('id')->on('proyeccion_de_sueldo')
                  ->onDelete('cascade');
            // Año de la proyección (1 a 5)
            $table->integer('anio');

            // Sueldo proyectado total por año
            $table->decimal('sueldo_total_anual', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeccion_cinco_anos');
    }
};
