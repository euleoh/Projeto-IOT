<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Registro;
use App\Models\Sensor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SensorController extends Controller
{
    public function index(): View
    {
        return view('sensores.index', [
            'sensores' => Sensor::with('ambiente')->withCount('registros')->orderBy('codigo')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('sensores.create', [
            'sensor' => new Sensor(),
            'ambientes' => Ambiente::orderBy('nome')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['status'] = $request->boolean('status');
        Sensor::create($data);

        return redirect()->route('sensores.index')->with('success', 'Sensor cadastrado com sucesso.');
    }

    public function edit(Sensor $sensor): View
    {
        return view('sensores.edit', [
            'sensor' => $sensor,
            'ambientes' => Ambiente::orderBy('nome')->get(),
        ]);
    }

    public function update(Request $request, Sensor $sensor): RedirectResponse
    {
        $data = $this->validatedData($request, $sensor);
        $data['status'] = $request->boolean('status');
        $sensor->update($data);

        return redirect()->route('sensores.index')->with('success', 'Sensor atualizado com sucesso.');
    }

    public function destroy(Sensor $sensor): RedirectResponse
    {
        DB::transaction(function () use ($sensor): void {
            Registro::where('sensor_id', $sensor->id)->delete();
            $sensor->delete();
        });

        return redirect()->route('sensores.index')->with('success', 'Sensor e seus registros históricos foram excluídos.');
    }

    private function validatedData(Request $request, ?Sensor $sensor = null): array
    {
        return $request->validate([
            'ambiente_id' => ['required', 'integer', 'exists:ambientes,id'],
            'codigo' => ['required', 'string', 'max:255', Rule::unique('sensors', 'codigo')->ignore($sensor?->id)],
            'tipo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:2000'],
            'status' => ['sometimes', 'boolean'],
        ]);
    }
}
