<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganigramasTable extends Migration
{
    public function up()
    {
        Schema::create('organigramas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_de_negocio_id')->constrained('plan_de_negocios')->onDelete('cascade');//id de plan negocios
            $table->string('nombre'); // Nombre del archivo
            $table->binary('archivo'); // Contenido binario del archivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organigramas');
    }
}
