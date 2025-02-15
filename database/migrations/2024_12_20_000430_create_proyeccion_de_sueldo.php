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
        Schema::create('proyeccion_de_sueldo', function (Blueprint $table) {
            $table->id();
            // Relación con plan_de_negocios (eliminación en cascada)
            $table->unsignedBigInteger('plan_de_negocio_id');
            $table->foreign('plan_de_negocio_id')
                  ->references('id')->on('plan_de_negocios')
                  ->onDelete('cascade');

            // Relación con descripcion_puestos (eliminación en cascada)
            $table->unsignedBigInteger('descripcion_de_puesto_id'); // Corregido el nombre
            $table->foreign('descripcion_de_puesto_id')
                  ->references('id')->on('descripcion_puestos')
                  ->onDelete('cascade');
            $table->decimal('sueldo', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeccion_de_sueldo');
    }
};
