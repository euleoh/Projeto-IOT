<?php

namespace App\Livewire\Sensor;

use App\Models\Sensor;
use Livewire\Component;

class SensorIndex extends Component
{

    public $search = '';

    
    public function delete($id){
        $sensor = Sensor::find($id);
        if($sensor != null){
            $sensor->delete();
            session()->flash('sucess', 'Excluído');
        }
    }

    public function render()
    {

        $sensores = Sensor::all();

        $sensores = Sensor::where('codigo', 'like', '%' .$this->search. '%')->get();
        return view('livewire.sensor.sensor-index', compact('sensores'));
    }

     public function status($id){
        $sensor = Sensor::find($id);
        $sensor->status = !$sensor->status;
        $sensor->save();
    }
}
