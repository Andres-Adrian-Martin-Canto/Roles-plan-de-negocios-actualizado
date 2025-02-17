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
        Schema::create('estudio_financieros', function (Blueprint $table) {
            // Los campos de la tabla
            $table->id();
            $table->foreignId('plan_de_negocio_id')->unique()->constrained('plan_de_negocios')->onDelete('cascade');
            $table->decimal('total_costo_fijo',12,2);
            $table->decimal('total_costo_variable',12,2);
            $table->decimal('total_ingresos',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudio_financieros');
    }
};
