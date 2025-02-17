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
        Schema::create('costo_fijos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudio_financiero_id')->constrained('estudio_financieros')->onDelete('cascade');
            $table->string('nombre', 255);
            $table->decimal('valor_unitario');
            $table->decimal('monto_unitario',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costo_fijos');
    }
};
