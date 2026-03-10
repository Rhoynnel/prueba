<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Despachos') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ open: false, cedula: '' }" @keydown.window.escape="open = false" x-cloak>
    
    <button @click="open = true" class="flex items-center gap-2 px-3 py-1.5 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        Buscar Cédula
    </button>

    <div x-show="open" class="fixed max-w-xs inset-0 z-50 flex items-center justify-center p-4">
        
        <div x-show="open" 
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 bg-black/40 backdrop-blur-[2px]" 
             @click="open = false"></div>

        <div x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             class="relative bg-white rounded-xl shadow-xl max-w-xs overflow-hidden">
            
            <form action="{{ route('cliente.buscar') }}" method="GET" class="p-4">
                <div class="text-center mb-4">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Consultar Cédula</h3>
                </div>

                <div class="relative">
                    <input type="text" 
                           name="cedula"
                           x-model="cedula"
                           x-on:input="cedula = $event.target.value.toUpperCase().replace(/[^VE0-9]/g, '')"
                           class="text-center border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-0 text-lg font-semibold tracking-widest uppercase"
                           placeholder="V12345678"
                           autofocus required>
                </div>

                <div class="mt-4 flex flex-col gap-2">
                    <button type="submit" class="w-full bg-indigo-600 text-gray-400 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                        Buscar
                    </button>
                    <button type="button" @click="open = false" class="w-full text-xs text-gray-400 hover:text-gray-600 transition">
                        Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class=" border-separate border border-gray-400 w-full text-sm text-gray-500 dark:text-gray-400">
                        <thead>
                            
                             <tr>
                                <th class="border border-gray-300">Cedula</th>
                                <th class="border border-gray-300">Nombre</th>
                                <th class="border border-gray-300">Direccion</th>
                                <th class="border border-gray-300">Telefono</th>
                                <th class="border border-gray-300">Tasa</th>
                                <th class="border border-gray-300">Nro de Despacho</th>
                                <th class="border border-gray-300">Estatus</th>
                                <th class="border border-gray-300">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($despachos as $item)
                                <tr>
                                    <td>{{ $item->cliente->cedula }}</td>
                                    <td>{{ $item->cliente->nombreCompleto }}</td>
                                    <td>{{ $item->cliente->direccion }}</td>
                                    <td>{{ $item->cliente->telefono }}</td>
                                    <td>{{ $item->tasa ? $item->tasa->tasa : 'N/A' }}</td>
                                    <td>{{ $item->numeroDespacho() }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            Cargada
                                        @else
                                            Sin Cargar
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('despacho.cargar', $item->id) }}" class="text-blue-500 hover:underline">Cargar</a>
                                        <!-- Aquí puedes agregar más acciones como Editar o Eliminar -->
                                    </td>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $despachos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
