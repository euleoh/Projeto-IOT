<?php

namespace Database\Seeders;

use App\Models\Ambiente;
use App\Models\Sensor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);

        Ambiente::create([
        'nome' => 'Sala 11',
        'descricao' => 'Sala 11 da Escola',
        'status' => false
        ]);

        Ambiente::create([
        'nome' => 'Sala 12',
        'descricao' => 'Sala 12 da Escola',
        'status' => true
        ]);

        Sensor::create([
        'codigo' => 'TEMP01',
        'descricao' => 'Medindo a temperatura',
        'status' => false,
        'tipo' => 'Temperatura',
        'ambiente_id' => 1
        ]);

        Sensor::create([
        'codigo' => 'UMI01',
        'descricao' => 'Calculando a umidade',
        'status' => true,
        'tipo' => 'Umidade',
        'ambiente_id' => 2
        ]);
    }
}
