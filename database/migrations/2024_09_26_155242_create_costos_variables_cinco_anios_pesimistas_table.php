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
        Schema::create('costos_variables_cinco_anios_pesimistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_estudio_financiero')
                ->constrained('estudio_financieros', 'id','fk_estudio_financiero_cinco')
                ->onDelete('cascade');
            $table->foreignId('Id_costo_variable')
                ->constrained('costos_variables', 'id','fk_costo_variable_cinco')
                ->onDelete('cascade');
            $table->integer('anio');
            $table->decimal('monto_pesimista',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costos_variables_cinco_anios_pesimistas');
    }
};
