<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservasSeeder extends Seeder
{
    public function run()
    {
        DB::table('reservas')->insert([
            [
                'usuario_id' => 1,   // ID del usuario que hizo la reserva
                'funcion_id' => 1,    // ID de la función de Avengers
                'asiento' => 'A1',    // Asiento reservado
                'estado' => 'confirmada',
                'total' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usuario_id' => 2,   // ID del usuario que hizo la reserva
                'funcion_id' => 2,    // ID de la función de The Lion King
                'asiento' => 'B1',
                'estado' => 'pendiente',
                'total' => 30.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

