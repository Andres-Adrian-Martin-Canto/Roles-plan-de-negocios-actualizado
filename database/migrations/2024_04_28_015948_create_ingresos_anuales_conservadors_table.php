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
        Schema::create('ingresos_anuales_conservador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_estudio_financiero')->constrained('estudio_financieros','id','idx_ingresos_estudio_financiero')->onDelete('cascade');
            $table->foreignId('Id_ingresos')->constrained('ingresos')->onDelete('cascade');
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
        Schema::table('ingresos_anuales_conservador', function (Blueprint $table) {
            // Eliminar las llaves foráneas
            $table->dropForeign('idx_ingresos_estudio_financiero');
            $table->dropForeign('ingresos_anuales_conservador_id_ingresos_foreign');
        });
        Schema::dropIfExists('ingresos_anuales_conservador');
    }
};
