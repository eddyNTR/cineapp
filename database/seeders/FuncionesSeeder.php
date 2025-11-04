<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionesSeeder extends Seeder
{
    public function run()
    {
        DB::table('funcions')->insert([
            [
                'pelicula_id' => 1, // ID de la película Avengers
                'sala_id' => 1,     // ID de la sala 1
                'fecha' => '2025-11-05',
                'hora' => '18:00:00',
                'precio' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelicula_id' => 2, // ID de la película The Lion King
                'sala_id' => 2,     // ID de la sala 2
                'fecha' => '2025-11-06',
                'hora' => '16:00:00',
                'precio' => 12.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
