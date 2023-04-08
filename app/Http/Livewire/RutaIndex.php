<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Ruta;
use App\Models\Itinerario;
use App\Models\Localidad;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RutaIndex extends Component
{ 
    public $itinerario, 
           $ruta_hex, 
           $ruta_gtfs,
           $ruta_dec,
           $sentido,
           $id_origen,
           $id_destino,
           $tamano_ruta,
           $tipo_ruta,
           $estado,
           $ingreso_asu,
           $file,
           $oldfile,
           $ruta,
           $itinerarios,
           $localidades,
           $search='';

    use WithPagination;
    use WithFileUploads;
    public $showingRutaModal = false;
    public $showingViewRutaModal =false;
    public $isEditMode = false;


    public function updatingSearch(){
        $this->search;
        $this->resetPage();
    }
    public function showRutaModal()
    {
        $this->reset();
        $this->showingRutaModal = true;
    }

    public function showViewRutaModal($id)
    {
        $this->showingViewRutaModal=true;
    }

    public function showEditRutaModal($id){
        $this->ruta = Ruta::findOrFail($id);
        $this->itinerario = $this->ruta->itinerario;
        $this->ruta_hex = $this->ruta->ruta_hex;
        $this->ruta_gtfs = $this->ruta->ruta_gtfs;
        $this->ruta_dec = $this->ruta->ruta_dec;
        $this->sentido = $this->ruta->sentido;
        $this->id_origen = $this->ruta->id_origen;
        $this->id_destino = $this->ruta->id_destino;
        $this->tamano_ruta = $this->ruta->tamano_ruta;
        $this->tipo_ruta = $this->ruta->tipo_ruta;
        $this->estado = $this->ruta->estado;
        $this->ingreso_asu = $this->ruta->ingreso_asu;
        $this->oldfile = $this->ruta->file;
        $this->isEditMode = true;
        $this->showingRutaModal = true;
    }

    public function updateRuta()
    {
        $file = $this->ruta->file;
        if($this->file){
            $file = $this->file->store('public/rutas');
        }
        $this->ruta->update([
            'itinerario'=>$this->itinerario, 
            'ruta_hex'=>$this->ruta_hex,
            'ruta_gtfs'=>$this->ruta_gtfs,
            'ruta_dec'=>$this->ruta_dec,
            'sentido'=>$this->sentido,
            'id_origen'=>$this->id_origen,
            'id_destino'=>$this->id_destino,          
            'tamano_ruta'=>$this->tamano_ruta,
            'tipo_ruta'=>$this->tipo_ruta,
            'estado'=>$this->estado,
            'ingreso_asu'=>$this->ingreso_asu,
            'file'=>$file
        ]);
        $this->reset();
    }
    public function storeRuta()
    {

        $newfile = $this->file->store('public/rutas');

        Ruta::create([
            'itinerario'=>$this->itinerario, 
            'ruta_hex'=>$this->ruta_hex,
            'ruta_gtfs'=>$this->ruta_gtfs,
            'ruta_dec'=>$this->ruta_dec,
            'sentido'=>$this->sentido,
            'id_origen'=>$this->id_origen,
            'id_destino'=>$this->id_destino,          
            'tamano_ruta'=>$this->tamano_ruta,
            'tipo_ruta'=>$this->tipo_ruta,
            'estado'=>$this->estado,
            'ingreso_asu'=>$this->ingreso_asu,
            'file'=>$newfile
        ]);

        $this->reset();
    }

    public function deleteRuta($id)
    {
        $ruta = Ruta::findOrFail($id);
        Storage::delete($ruta->file);
        $ruta->delete();
        $this->reset();
    }

    public function loadItinerario(){
        $this->itinerarios = Itinerario::all();
    }

    public function loadLocalidades(){
        $this->localidades = Localidad::all();
    }

    public function render()
    {
        $this->loadLocalidades();
        $this->loadItinerario();
        return view('livewire.ruta-index',[
            'rutas' => Ruta::where('ruta_hex','like','%'.$this->search.'%')->paginate(20),
        ]);
    }
}
