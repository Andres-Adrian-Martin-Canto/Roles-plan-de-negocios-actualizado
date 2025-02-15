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
        Schema::create('sueldo_anual', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('proyección_de_sueldos'); 
            $table->foreign('proyección_de_sueldos')
                  ->references('id')->on('proyeccion_de_sueldo')
                  ->onDelete('cascade');
            $table->integer('mes');      
            $table->decimal('sueldo_total_por_mes', 10, 2);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sueldo_anual');
    }
};
