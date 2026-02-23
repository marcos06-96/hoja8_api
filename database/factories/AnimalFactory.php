<?php

namespace Database\Factories;

use App\Models\Protectora;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
      public function definition(): array
    {
        $especie = fake()->randomElement(['perro', 'gato', 'conejo', 'hurón']);
        
        $razasPerro = ['Labrador', 'Pastor Alemán', 'Golden Retriever', 'Bulldog', 'Mestizo', 'Beagle', 'Chihuahua', 'Yorkshire Terrier'];
        $razasGato = ['Siamés', 'Persa', 'Maine Coon', 'Común Europeo', 'Bengalí', 'Ragdoll', 'Mestizo'];
        
        $raza = match($especie) {
            'perro' => fake()->randomElement($razasPerro),
            'gato' => fake()->randomElement($razasGato),
            default => null,
        };

        $nombresPerro = ['Max', 'Luna', 'Rocky', 'Bella', 'Coco', 'Toby', 'Nina', 'Thor', 'Lola', 'Bruno'];
        $nombresGato = ['Michi', 'Simba', 'Nala', 'Garfield', 'Pelusa', 'Felix', 'Miau', 'Tom', 'Bigotes'];
        $nombresOtros = ['Bola', 'Copito', 'Trufas', 'Canela', 'Nieve'];

        $nombre = match($especie) {
            'perro' => fake()->randomElement($nombresPerro),
            'gato' => fake()->randomElement($nombresGato),
            default => fake()->randomElement($nombresOtros),
        };

        $localidadesAsturias = ['Oviedo', 'Gijón', 'Avilés', 'Mieres', 'Langreo', 'Siero', 'Castrillón', 'Llanera', 'Corvera'];

        return [
'protectora_id' => Protectora::where('estado', 'activa')->inRandomOrder()->value('id'), 
           'nombre' => $nombre,
            'especie' => $especie,
            'raza' => $raza,
            'edad_aproximada' => fake()->numberBetween(1, 12),
            'sexo' => fake()->randomElement(['macho', 'hembra']),
            'tamanio' => fake()->randomElement(['pequeño', 'mediano', 'grande']),
            'peso' => fake()->randomFloat(2, 2, 40),
            'color' => fake()->randomElement(['negro', 'blanco', 'marrón', 'gris', 'atigrado', 'tricolor', 'rubio', 'naranja']),
            'chip' => fake()->boolean(70), // 70% tienen chip
            'esterilizado' => fake()->boolean(60),
            'vacunado' => fake()->boolean(80),
            'desparasitado' => fake()->boolean(75),
            'bueno_con_ninos' => fake()->boolean(50),
            'bueno_con_perros' => fake()->boolean(60),
            'bueno_con_gatos' => fake()->boolean(40),
            'nivel_energia' => fake()->randomElement(['bajo', 'medio', 'alto']),
            'adopcion_urgente' => fake()->randomElement(['si', 'no']),
            'necesidades_especiales' => fake()->optional(0.2)->sentence(),
            'descripcion' => fake()->paragraph(3),
            'historia' => fake()->optional(0.7)->paragraph(2),
            'tipo_anuncio' => fake()->randomElement(['adopcion', 'acogida', 'ambos']),
            'estado' => fake()->randomElement(['disponible', 'disponible', 'disponible', 'reservado', 'adoptado']), // Más disponibles
            'localidad' => fake()->randomElement($localidadesAsturias),
            'fecha_ingreso' => fake()->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
