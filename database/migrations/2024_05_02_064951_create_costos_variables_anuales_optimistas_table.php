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
        Schema::create('costos_variables_anuales_optimistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_estudio_financiero')->constrained('estudio_financieros')->onDelete('cascade')->index('idx_costos_variables_optimista_estudio_financiero');
            $table->foreignId('Id_costo_variable')->constrained('costos_variables')->onDelete('cascade');
            $table->integer('mes');
            $table->float('monto_optimista');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costos_variables_anuales_optimistas');
    }
};
