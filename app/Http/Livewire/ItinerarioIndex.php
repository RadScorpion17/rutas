<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Itinerario;
use Livewire\WithPagination;

class ItinerarioIndex extends Component
{
    use WithPagination;

    public $descripcion,
        $horario_salida,
        $intervalo,
        $tipo,
        $linea,
        $estado,
        $itinerario,
        $search = '';
    public $showingItinerarioModal = false;
    public $showingViewItinerarioModal = false;
    public $isEditMode = false;

    public function showItinerarioModal()
    {
        $this->reset();
        $this->showingItinerarioModal = true;
    }


    public function storeItinerario()
    {
        Itinerario::create([
            'descripcion' => $this->descripcion,
            'horario_salida' => $this->horario_salida,
            'intervalo' => $this->intervalo,
            'tipo' => $this->tipo,
            'linea' => $this->linea,
            'estado' => $this->estado
        ]);
        $this->reset();
    }

    public function showEditItinerarioModal($id)
    {
        $this->itinerario = Itinerario::findOrFail($id);
        $this->descripcion = $this->itinerario->descripcion;
        $this->horario_salida = $this->itinerario->horario_salida;
        $this->intervalo = $this->itinerario->intervalo;
        $this->tipo = $this->itinerario->tipo;
        $this->linea = $this->itinerario->linea;
        $this->estado = $this->itinerario->estado;
        $this->isEditMode = true;
        $this->showingItinerarioModal = true;
    }

    public function updateItinerario()
    {
        $this->itinerario->update([
            'descripcion' => $this->descripcion,
            'horario_salida' => $this->horario_salida,
            'intervalo' => $this->intervalo,
            'tipo' => $this->tipo,
            'linea' => $this->linea,
            'estado' => $this->estado
        ]);
        $this->reset();
    }



    public function deleteItinerario($id)
    {
        $itinerario = Itinerario::findOrFail($id);
        $itinerario->delete();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.itinerario-index', [
            'itinerarios' => Itinerario::all()
        ]);
    }
}
