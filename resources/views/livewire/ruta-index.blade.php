<div>
    <div>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left">
        Rutas Operativas
    </h2>
</x-slot>
    </div>
<div>
<div class="py-12">
    <div class="relative overflow-x-auto max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <x-button wire:click="showRutaModal" class="bg-blue-500 hover:bg-blue-700 text-white py-1 mb-6 px-3 rounded my-3 mt-1">Crear Ruta</x-button>
            <table class="w-full text-m text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">ID</th>
                        <th class="px-4 py-2">Ruta Hex</th>
                        <th class="px-4 py-2">Sentido</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">File</th>
                        <th class="px-4 py-2 w-60">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rutas as $ruta)
                    <tr>
                        <td class="border px-4 py-2">{{ $ruta->id }}</td>
                        <td class="border px-4 py-2">{{ $ruta->ruta_hex }}</td>
                        <td class="border px-4 py-2">{{ $ruta->sentido }}</td>
                        <td class="border px-4 py-2">{{ $ruta->estado }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ Storage::url($ruta->file) }}">{{ $ruta->file }}</a>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <x-button wire:click="showEditRutaModal({{ $ruta->id }})" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">Edit</x-button>
                            <!--<x-button wire:click="deleteRuta({{ $ruta->id }})" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">Delete</x-button>-->
                            <x-button wire:click="showViewRutaModal({{ $ruta->file }})" class="bg-gray-500 hover:bg-red-700 text-white py-1 px-3 rounded">View</x-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!---------------------------------Modal---------------------------------------------->
<div id="mainModal">
    <x-dialog-modal wire:model="showingRutaModal" maxWidth="xl">
      @if($isEditMode)
          <x-slot name="title">Actualizar Ruta</x-slot>
          @else
          <x-slot name="title">Crear Ruta</x-slot>
      @endif
      <x-slot name="content">
        <form class="w-full max-w-lg" @if($isEditMode) 
                                    wire:submit.prevent="updateRuta"
                                    @else
                                    wire:submit.prevent="storeRuta"
                                    @endif
                                    >
              <div class="px-3 md:w-1/2">
                <label class="mb-1 block font-bold text-gray-700" for="itinerario">N° Itinerario</label>
                <select wire:model.lazy="itinerario" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" name="itinerario" id="itinerario">
                    <option>Elige un itinerario...</option>
                    @foreach($itinerarios as $itn)
                        <option value="{{ $itn->id }}"> {{$itn->descripcion}} </option>
                    @endforeach
                </select>
              </div>       
              <div class="flex grid-cols-3 flex-wrap gap-4">
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="ruta_hex">HEX</label>
                  <input wire:model.lazy="ruta_hex" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" name="ruta_hex" id="ruta_hex" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="ruta_dec">DEC</label>
                  <input wire:model.lazy="ruta_dec" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" name="ruta_dec" id="ruta_dec" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="ruta_gtfs">GTFS</label>
                  <input wire:model.lazy="ruta_gtfs" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" name="ruta_gtfs" id="ruta_gtfs" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="sentido">Sentido</label>
                  <select wire:model.lazy="sentido" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" name="sentido" id="sentido">
                    <option>Seleccione un sentido...</option>
                    <option value="IDA" selected>Ida</option>
                    <option value="VUELTA">Vuelta</option>
                  </select>
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="id_origen">Origen</label>
                  <select wire:model.lazy="id_origen" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" name="id_origen" id="id_origen">
                    @foreach($localidades as $localidad)
                    <option value="{{ $localidad->id }}">{{ $localidad->localidad }}</option>
                    @endforeach
                  </select>  
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="id_destino">Destino</label>
                  <select wire:model.lazy="id_destino" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" name="id_destino" id="id_destino">
                    @foreach($localidades as $localidad)
                    <option value="{{ $localidad->id }}">{{ $localidad->localidad }}</option>
                    @endforeach
                  </select>  
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="tamano_ruta">Tamaño</label>
                  <input wire:model.lazy="tamano_ruta" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="number" step="any" name="tamano_ruta" id="tamano_ruta" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="tamano_ruta">Estado</label>
                  <input wire:model.lazy="estado" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" name="estado" id="estado" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="tamano_ruta">Ingreso ASU</label>
                  <input wire:model.lazy="ingreso_asu" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="number" name="ingreso_asu" id="ingreso_asu" />
                </div>
                <div>
                    <label class="mb-1 block font-bold text-gray-700" for="tamano_ruta">Tipo Ruta</label>
                    <input wire:model.lazy="tipo_ruta" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" name="tipo_ruta" id="tipo_ruta" />
                </div>
                 -
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="file">File</label>
                  <input wire:model.lazy="file" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="file" name="file" id="file" />
                </div>
              </div>
      </x-slot>
      <x-slot name="footer">
        @if($isEditMode)
            <x-button type="submit">Actualizar</x-button>
            @else
            <x-button type="submit">Crear</x-button>
        @endif
    </form>
      </x-slot>
    </x-dialog-modal>
</div>
<div id="viewModal">
       <x-dialog-modal wire:model="showingViewRutaModal" maxWidth="2xl">
            <x-slot name="title">Ruta</x-slot>
            <x-slot name="content">
                <div id="map" 
                style="position: relative; outline: none; margin-top:5px;">
              </div>
            </x-slot>
        <x-slot name="footer"></x-slot>
      </x-dialog-modal>
</div>
  <script>
var tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png',
    {
        attribution: false
    });

var map = L.map('map',
    {
        zoomControl: true,
        layers: [tileLayer],
        maxZoom: 18,
        minZoom: 6
    })
    .setView([-25.299804, -57.491509], 13);

   setTimeout(function () { map.invalidateSize() }, 800);
  </script>
</div>