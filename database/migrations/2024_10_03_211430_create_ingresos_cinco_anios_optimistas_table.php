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
        Schema::create('ingresos_cinco_anios_optimistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_estudio_financiero')->constrained('estudio_financieros','id','fk_ingresosOptimistas_estudio_financiero')->onDelete('cascade');
            $table->foreignId('Id_ingresos')->constrained('ingresos','id','fk_ingreso_optimista_pertenece')->onDelete('cascade');
            $table->integer('anio');
            $table->decimal('monto_optimista',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos_cinco_anios_optimistas');
    }
};
