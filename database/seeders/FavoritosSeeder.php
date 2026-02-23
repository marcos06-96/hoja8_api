<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = User::all()->pluck('id');
        $animales = Animal::where('estado', 'disponible')->pluck('id');

        foreach ($usuarios as $usuarioId) {
            // Cada usuario marca 3 animales aleatorios como favoritos
            $favoritosIds = $animales->random(3)->toArray();
            
            User::find($usuarioId)->favoritos()->attach($favoritosIds);
        }
    }
}
