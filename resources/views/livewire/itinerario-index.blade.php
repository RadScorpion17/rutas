<div>
    <div>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left">
        Itinerarios
    </h2>
</x-slot>
    </div>
<div>
<div class="py-12">
    <div class="relative overflow-x-auto max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <x-button wire:click="showItinerarioModal" class="bg-blue-500 hover:bg-blue-700 text-white py-1 mb-6 px-3 rounded my-3 mt-1">Crear Itinerario</x-button>
            
            <table class="w-full text-m text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">ID</th>
                        <th class="px-4 py-2 w-50">Descripción</th>
                        <th class="px-4 py-2">Tipo</th>
                        <th class="px-4 py-2">Linea</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2 w-60">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itinerarios as $itinerario)
                    <tr>
                        <td class="border px-4 py-2">{{ $itinerario->id }}</td>
                        <td class="border px-4 py-2">{{ $itinerario->descripcion }}</td>
                        <td class="border px-4 py-2">{{ $itinerario->tipo }}</td>
                        <td class="border px-4 py-2">{{ $itinerario->linea }}</td>
                        <td class="border px-4 py-2">{{ $itinerario->estado }}</td>
                        <td class="border px-4 py-2 text-center">
                            <x-button wire:click="showEditItinerarioModal({{ $itinerario->id }})" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">Edit</x-button>
                            <x-button class="bg-gray-500 hover:bg-red-700 text-white py-1 px-3 rounded">View</x-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>Pagination</div>
        </div>
    </div>
</div>
</div>
<!---------------------------------Modal---------------------------------------------->
<div id="mainModal">
    <x-dialog-modal wire:model="showingItinerarioModal" maxWidth="xl">
      @if($isEditMode)
          <x-slot name="title">Actualizar Itinerario</x-slot>
          @else
          <x-slot name="title">Crear Itinerario</x-slot>
      @endif
      <x-slot name="content">
        <form class="w-full max-w-lg" @if($isEditMode) 
                                    wire:submit.prevent="updateItinerario"
                                    @else
                                    wire:submit.prevent="storeItinerario"
                                    @endif>
            <div class="-mx-3 mb-6 flex flex-wrap">      
              <div class="flex grid-cols-3 flex-wrap gap-4">
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="ruta_hex">Descripción</label>
                  <input wire:model.lazy="descripcion" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" name="descripcion" id="descripcion" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="ruta_dec">Salida</label>
                  <input wire:model.lazy="horario_salida" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="time" name="horario_salida" id="horario_salida" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="ruta_gtfs">Intervalo</label>
                  <input wire:model.lazy="intervalo" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="time" name="intervalo" id="intervalo" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="tamano_ruta">Tipo</label>
                  <input wire:model.lazy="tipo" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" step="any" name="tipo" id="tipo" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="tamano_ruta">Linea</label>
                  <input wire:model.lazy="linea" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" name="linea" id="linea" />
                </div>
                <div>
                  <label class="mb-1 block font-bold text-gray-700" for="tamano_ruta">Estado</label>
                  <input wire:model.lazy="estado" class="focus:shadow-outline rounded border bg-gray-200 px-3 py-2 shadow focus:outline-none" type="text" name="estado" id="estado" />
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
</div>