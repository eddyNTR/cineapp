<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeliculaIdToFuncionesTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        // Verificar si la columna ya existe antes de agregarla
        if (!Schema::hasColumn('funcions', 'pelicula_id')) {
            Schema::table('funcions', function (Blueprint $table) {
                $table->unsignedBigInteger('pelicula_id');
                $table->foreign('pelicula_id')->references('id')->on('peliculas')->onDelete('cascade');
            });
        }
    }


    /**
     * Deshacer las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcions', function (Blueprint $table) {
            // Eliminar la clave foránea y la columna pelicula_id
            $table->dropForeign(['pelicula_id']);
            $table->dropColumn('pelicula_id');
        });
    }
}
