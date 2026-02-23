<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::factory(17)->create();

       


        $this->call([
           
            ProtectoraSeeder::class,]);

            Animal::factory(40)->create(); 
            
        $this->call([
            
             FavoritosSeeder::class,]);
            
           
            
         User::factory()->create([
           'nombre' => 'Admin',
            'apellidos' => 'ADOPTASTUR',
            'email' => 'admin@adoptastur.es',
            'password' => Hash::make('123456'),
           'role'=>'admin',
            
        ]);
        User::factory()->create([
           'nombre' => 'adoptante',
            'apellidos' => 'ADOPTASTUR',
            'email' => 'adoptante@adoptastur.es',
            'password' => Hash::make('123456'),
           'role'=>'adoptante',
            
        ]);
        User::factory()->create([
           'nombre' => 'protectora',
            'apellidos' => 'ADOPTASTUR',
            'email' => 'protectora@adoptastur.es',
            'password' => Hash::make('123456'),
           'role'=>'protectora',
            
        ]);
       
       
    }
}
