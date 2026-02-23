<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Protectora;
use App\Models\User;
use Illuminate\Support\Str;

class ProtectoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $protectoras = [
            [
                'nombre_protectora' => 'Asociación Protectora de Animales y Plantas de Oviedo',
                'cif' => 'G33123456',
                'numero_registro' => 'REG-33-2001-001',
                'direccion_protectora' => 'Calle Foncalada, 1, 33002 Oviedo',
                'telefono_protectora' => '985123456',
                'email_protectora' => 'info@protectoraoviedo.org',
                'descripcion' => 'Protectora de animales ubicada en Oviedo. Trabajamos por el bienestar animal desde 2001.',
                'web' => 'https://www.protectoraoviedo.org',
                'estado' => 'activa',
            ],
            [
                'nombre_protectora' => 'Protectora de Animales de Gijón',
                'cif' => 'G33234567',
                'numero_registro' => 'REG-33-1998-002',
                'direccion_protectora' => 'Calle Marqués de San Esteban, 56, 33206 Gijón',
                'telefono_protectora' => '985234567',
                'email_protectora' => 'contacto@protectoragijon.es',
                'descripcion' => 'Dedicados al rescate y adopción de animales abandonados en Gijón y alrededores.',
                'web' => 'https://www.protectoragijon.es',
                'estado' => 'activa',
            ],
            [
                'nombre_protectora' => 'Sociedad Protectora de Animales de Avilés',
                'cif' => 'G33345678',
                'numero_registro' => 'REG-33-2005-003',
                'direccion_protectora' => 'Calle Rivero, 23, 33400 Avilés',
                'telefono_protectora' => '985345678',
                'email_protectora' => 'info@protectoraaviles.com',
                'descripcion' => 'Protectora sin ánimo de lucro que busca hogar para animales abandonados.',
                'web' => null,
                'estado' => 'activa',
            ],
            [
                'nombre_protectora' => 'El Refugio de los Peludos',
                'cif' => 'G33456789',
                'numero_registro' => 'REG-33-2015-004',
                'direccion_protectora' => 'Calle La Lila, 8, 33900 Langreo',
                'telefono_protectora' => '985456789',
                'email_protectora' => 'peludos@refugioasturias.org',
                'descripcion' => 'Refugio dedicado principalmente al rescate de perros y gatos. Promovemos la adopción responsable.',
                'web' => 'https://www.refugiopeludos.org',
                'estado' => 'pendiente',
            ],
            [
                'nombre_protectora' => 'Amigos de los Animales Asturias',
                'cif' => 'G33567890',
                'numero_registro' => 'REG-33-2018-005',
                'direccion_protectora' => 'Avenida de Galicia, 15, 33920 Mieres',
                'telefono_protectora' => '985567890',
                'email_protectora' => 'amigos@animalesasturias.es',
                'descripcion' => 'Organización dedicada a la defensa y protección de animales en situación de abandono.',
                'web' => null,
                'estado' => 'pendiente',
            ],
            [
                'nombre_protectora' => 'Patitas Felices Asturias',
                'cif' => 'G33678901',
                'numero_registro' => 'REG-33-2010-006',
                'direccion_protectora' => 'Calle Constitución, 45, 33860 Siero',
                'telefono_protectora' => '985678901',
                'email_protectora' => 'patitas@felicesasturias.org',
                'descripcion' => 'Trabajamos para dar una segunda oportunidad a perros, gatos y otros animales abandonados.',
                'web' => 'https://www.patitasfelices.es',
                'estado' => 'inactiva',
            ],
        ];

        $usuariosDisponibles = User::where('role', '!=', 'admin')
            ->whereNull('protectora_id')
            ->get();

        $indexUsuario = 0;

        foreach ($protectoras as $protectoraData) {

            $protectoraData['slug'] = Str::slug($protectoraData['nombre_protectora']);

            if ($protectoraData['estado'] === 'activa' && 
                $indexUsuario < $usuariosDisponibles->count()) {

                $usuario = $usuariosDisponibles[$indexUsuario];
                $protectoraData['usuario_principal_id'] = $usuario->id;
                $indexUsuario++;

            } else {
                $protectoraData['usuario_principal_id'] = null;
            }

            $protectora = Protectora::create($protectoraData);

            if ($protectora->usuario_principal_id) {

                $usuarioResponsable = User::find($protectora->usuario_principal_id);

                $usuarioResponsable->update([
                    'protectora_id' => $protectora->id,
                    'es_responsable' => true,
                    'role' => 'protectora' 
                ]);
            }
        }
    }
}