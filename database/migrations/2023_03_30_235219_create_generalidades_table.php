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
        Schema::create('generalidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_de_negocio_id')->constrained('plan_de_negocios')->onDelete('cascade');
            $table->text('antecedentes')->nullable();
            $table->text('descripcion_producto')->nullable();
            $table->text('aspectos_innovadores')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generalidades');
    }
};
