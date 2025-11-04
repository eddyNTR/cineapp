<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalasSeeder extends Seeder
{
    public function run()
    {
        DB::table('salas')->insert([
            [
                'nombre' => 'Sala 1',
                'capacidad' => 100,
                'tipo' => '2D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sala 2',
                'capacidad' => 150,
                'tipo' => '3D',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
