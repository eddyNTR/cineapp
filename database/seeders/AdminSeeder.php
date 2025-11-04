<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@cineapp.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Cajero
        User::updateOrCreate(
            ['email' => 'cajero@cineapp.com'],
            [
                'name' => 'Cajero Principal',
                'password' => Hash::make('cajero123'),
                'role' => 'cajero',
            ]
        );

        // Cliente
        User::updateOrCreate(
            ['email' => 'cliente@cineapp.com'],
            [
                'name' => 'Cliente Demo',
                'password' => Hash::make('cliente123'),
                'role' => 'cliente',
            ]
        );
    }
}
