<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peliculas')->insert([
            [
                'titulo' => 'Avengers: Endgame',
                'genero' => 'Acción, Aventura, Ciencia Ficción',
                'duracion' => 181,
                'sinopsis' => 'Los Vengadores deben encontrar una forma de derrotar a Thanos y restaurar el equilibrio del universo.',
                'imagen' => 'avengers_endgame.jpg',  // Si tienes imágenes, puedes referenciarlas
            ],
            [
                'titulo' => 'The Lion King',
                'genero' => 'Animación, Aventura, Drama',
                'duracion' => 118,
                'sinopsis' => 'Un joven león llamado Simba, que debe reclamar su lugar como rey después de la muerte de su padre.',
                'imagen' => 'lion_king.jpg',  // Si tienes imágenes, puedes referenciarlas
            ],
            [
                'titulo' => 'Joker',
                'genero' => 'Drama, Crimen, Thriller',
                'duracion' => 122,
                'sinopsis' => 'La historia de origen de Arthur Fleck, un hombre con problemas mentales que eventualmente se convierte en el infame villano Joker.',
                'imagen' => 'joker.jpg',  // Si tienes imágenes, puedes referenciarlas
            ],
        ]);
    }
}
