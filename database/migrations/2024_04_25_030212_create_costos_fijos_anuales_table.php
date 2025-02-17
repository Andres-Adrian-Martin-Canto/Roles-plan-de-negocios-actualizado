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
        Schema::create('costos_fijos_anuales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_estudio_financiero')->constrained('estudio_financieros')->onDelete('cascade');
            $table->foreignId('Id_costo_fijo')->constrained('costo_fijos')->onDelete('cascade');
            $table->integer('mes');
            $table->decimal('monto_conservador',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costos_fijos_anuales');
    }
};
