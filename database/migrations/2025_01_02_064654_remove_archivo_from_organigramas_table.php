<?php
// filepath: /c:/xampp/htdocs/Roles-plan-de-negocios-actualizado-moduloAremy/database/migrations/xxxx_xx_xx_xxxxxx_remove_archivo_from_organigramas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveArchivoFromOrganigramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organigramas', function (Blueprint $table) {
            $table->dropColumn('archivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organigramas', function (Blueprint $table) {
            $table->binary('archivo')->nullable();
        });
    }
}