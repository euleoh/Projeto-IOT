<?php

namespace Database\Seeders;

use App\Models\Ambiente;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(['email' => 'test@example.com'], ['name' => 'Test User', 'password' => 'password']);

        $sala = Ambiente::firstOrCreate(['nome' => 'Sala de estar'], [
            'descricao' => 'Ambiente principal da casa, com monitoramento de conforto.', 'status' => true,
        ]);
        $cozinha = Ambiente::firstOrCreate(['nome' => 'Cozinha'], [
            'descricao' => 'Monitoramento de temperatura e luminosidade da cozinha.', 'status' => true,
        ]);
        $varanda = Ambiente::firstOrCreate(['nome' => 'Varanda'], [
            'descricao' => 'Área externa para acompanhar as condições ambientais.', 'status' => false,
        ]);

        Sensor::firstOrCreate(['codigo' => 'TEMP01'], [
            'ambiente_id' => $sala->id, 'tipo' => 'Temperatura', 'descricao' => 'Temperatura ambiente próxima à janela.', 'status' => true,
        ]);
        Sensor::firstOrCreate(['codigo' => 'UMID01'], [
            'ambiente_id' => $sala->id, 'tipo' => 'Umidade', 'descricao' => 'Umidade relativa do ar na sala.', 'status' => true,
        ]);
        Sensor::firstOrCreate(['codigo' => 'LUX01'], [
            'ambiente_id' => $cozinha->id, 'tipo' => 'Luminosidade', 'descricao' => 'Nível de iluminação sobre a bancada.', 'status' => true,
        ]);
        Sensor::firstOrCreate(['codigo' => 'TEMP02'], [
            'ambiente_id' => $varanda->id, 'tipo' => 'Temperatura', 'descricao' => 'Sensor externo atualmente desativado.', 'status' => false,
        ]);
    }
}
