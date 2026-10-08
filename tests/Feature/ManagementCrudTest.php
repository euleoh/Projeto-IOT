<?php

namespace Tests\Feature;

use App\Models\Ambiente;
use App\Models\Registro;
use App\Models\Sensor;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagementCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(ValidateCsrfToken::class);
    }

    public function test_ambientes_can_be_created_updated_and_deleted(): void
    {
        $this->post(route('ambientes.store'), [
            'nome' => 'Laboratório', 'descricao' => 'Sala de testes dos dispositivos.', 'status' => '1',
        ])->assertRedirect(route('ambientes.index'));

        $ambiente = Ambiente::where('nome', 'Laboratório')->firstOrFail();
        $this->assertTrue($ambiente->status);

        $this->put(route('ambientes.update', $ambiente), [
            'nome' => 'Laboratório IoT', 'descricao' => 'Espaço atualizado.', 'status' => '0',
        ])->assertRedirect(route('ambientes.index'));
        $this->assertDatabaseHas('ambientes', ['id' => $ambiente->id, 'nome' => 'Laboratório IoT', 'status' => 0]);

        $this->delete(route('ambientes.destroy', $ambiente))->assertRedirect(route('ambientes.index'));
        $this->assertDatabaseMissing('ambientes', ['id' => $ambiente->id]);
    }

    public function test_sensor_crud_and_deletion_remove_associated_readings(): void
    {
        $ambiente = Ambiente::create(['nome' => 'Estufa', 'descricao' => 'Cultivo monitorado.', 'status' => true]);

        $this->post(route('sensores.store'), [
            'ambiente_id' => $ambiente->id,
            'codigo' => 'TEMP-EST-01',
            'tipo' => 'Temperatura',
            'descricao' => 'Medição central da estufa.',
            'status' => '1',
        ])->assertRedirect(route('sensores.index'));

        $sensor = Sensor::where('codigo', 'TEMP-EST-01')->firstOrFail();
        $this->put(route('sensores.update', $sensor), [
            'ambiente_id' => $ambiente->id,
            'codigo' => 'TEMP-EST-02',
            'tipo' => 'Temperatura',
            'descricao' => 'Sensor reposicionado.',
            'status' => '0',
        ])->assertRedirect(route('sensores.index'))->assertSessionHasNoErrors();
        $this->assertDatabaseHas('sensors', ['id' => $sensor->id, 'codigo' => 'TEMP-EST-02', 'status' => 0]);

        Registro::create(['sensor_id' => $sensor->id, 'valor' => '23.5', 'unidade' => '°C', 'data_hora' => now()]);
        $this->delete(route('sensores.destroy', $sensor))->assertRedirect(route('sensores.index'));
        $this->assertDatabaseMissing('sensors', ['id' => $sensor->id]);
        $this->assertDatabaseMissing('registros', ['sensor_id' => $sensor->id]);
    }

    public function test_sensor_codigo_must_be_unique(): void
    {
        $ambiente = Ambiente::create(['nome' => 'Escritório', 'descricao' => 'Espaço de trabalho.', 'status' => true]);
        Sensor::create(['ambiente_id' => $ambiente->id, 'codigo' => 'UMID-01', 'tipo' => 'Umidade', 'descricao' => 'Sensor existente.', 'status' => true]);

        $this->from(route('sensores.create'))->post(route('sensores.store'), [
            'ambiente_id' => $ambiente->id, 'codigo' => 'UMID-01', 'tipo' => 'Umidade', 'descricao' => 'Duplicado.',
        ])->assertSessionHasErrors('codigo');
    }

    public function test_ambiente_with_sensors_cannot_be_deleted(): void
    {
        $ambiente = Ambiente::create(['nome' => 'Garagem', 'descricao' => 'Área da garagem.', 'status' => true]);
        Sensor::create(['ambiente_id' => $ambiente->id, 'codigo' => 'MOV-01', 'tipo' => 'Movimento', 'descricao' => 'Sensor da garagem.', 'status' => true]);

        $this->delete(route('ambientes.destroy', $ambiente))->assertSessionHas('error');
        $this->assertDatabaseHas('ambientes', ['id' => $ambiente->id]);
    }
}
