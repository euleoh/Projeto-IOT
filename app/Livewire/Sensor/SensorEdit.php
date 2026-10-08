<?php

namespace App\Livewire\Sensor;

use App\Models\Sensor;
use Livewire\Component;

class SensorEdit extends Component
{
    public $codigo;
    public $descricao;
    public $status;
    public $tipo;
    public $ambiente_id;
    public $sensor_id;

    public function mount($id){
        $sensor = Sensor::find($id);

        $this-> sensor_id = $sensor->id;
        $this-> codigo = $sensor->codigo;
        $this-> status = $sensor->status;
        $this-> tipo = $sensor->tipo;
        $this-> ambiente_id = $sensor->ambiente_id;
    }

    public function update(){
        $sensor = Sensor::find($this->sensor_id);

        $sensor->codigo = $this->codigo;
        $sensor->descricao = $this->descricao;
        $sensor->status = $this-> status;
        $sensor->tipo = $this->tipo;
        $sensor->ambiente_id = $this-> ambiente_id;

        $sensor->save();

        session()->flash('success', 'Atualizado');
        return redirect()->route('sensor.index');
    }

    public function render()
    {
        return view('livewire.sensor.sensor-edit');
    }
}
