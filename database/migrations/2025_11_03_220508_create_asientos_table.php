<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsientosTable extends Migration
{
    public function up()
    {
        Schema::create('asientos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo'); // Código del asiento (A1, A2, B1, etc.)
            $table->enum('estado', ['disponible', 'reservado'])->default('disponible');
            $table->foreignId('funcion_id')->constrained()->onDelete('cascade'); // Relación con la tabla de funciones
            $table->foreignId('reserva_id')->nullable()->constrained()->onDelete('set null'); // Relación con la reserva, puede ser null
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asientos');
    }
}

