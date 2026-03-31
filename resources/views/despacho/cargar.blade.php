<x-app-layout>
    <x-slot name="header">
        <h2 >
            <a href="{{ route('despachos') }}">{{ __('Despachos') }}</a>
        </h2>


    </x-slot>


    <div x-data>
        <div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <table
                        class="flex justify-end mb-2">
                        <thead>
                           
                            <tr>
                                
                                    
                                
                                <th class="border border-gray-300">Rif o Cedula</th>
                                <td class="border border-gray-300">{{ $despachoActivo->cliente->cedula  }}</td>
                                <th class="border border-gray-300">Nombre</th>
                                <td class="border border-gray-300">{{ $despachoActivo->cliente->nombreCompleto }}</td>
                            </tr>

                            <tr>
                                <th class="border border-gray-300">Telefono</th>
                                <td class="border border-gray-300">{{ $despachoActivo->cliente->telefono }}</td>
                                <th class="border border-gray-300">Direccion</th>
                                <td class="border border-gray-300">{{ $despachoActivo->cliente->direccion }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Tasa</th>
                                <td class="border border-gray-300">{{ $despachoActivo->tasa->tasa }} - con Fecha de: {{ $despachoActivo->tasa->fecha }}</td>
                                <th class="border border-gray-300">Nro de Despacho</th>
                                <td class="border border-gray-300">{{ $despachoActivo->numeroDespacho() }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Estatus</th>
                                <td class="border border-gray-300">
                                    @if ($despachoActivo->status == 1)
                                        Cargada
                                    @else
                                        Sin Cargar
                                    @endif
                                </td>
                            </tr>
                            
                        </thead>
                    </table>
            </div>
        </div>


                    <div class="flex items-center justify-end mt-4">
                        <form action="{{ route('despacho.cambiarStatus', $despachoActivo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <x-primary-button type="submit" onclick="return confirm('¿Estás seguro de que deseas Descontar del Inventario?')">
                                {{ __('Cargar Despacho') }}
                            </x-primary-button>
                        </form>
                    </div>
                    <div>Agregar Productos</div>
                    <form action="{{ route('despacho.agregarProducto') }}" method="POST">
                        @csrf
                        <input type="hidden" name="despachos_id" value="{{ $despachoActivo->id }}">
                        <div class="mt-4 flex flex-col md:flex-row gap-4 items-end">

                            <div class="flex-1 w-full">
                                <x-input-label for="productos_id" :value="__('Producto')" />
                                <select id="productos_id" name="productos_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm dark:bg-gray-700 dark:text-white">
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->codigo }} - {{ $producto->nombre }} - {{ $producto->categoria->name }} - {{ $producto->stock_actual }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
                            </div>

                            <div class="w-full md:w-32">
                                <x-input-label for="cantidad" :value="__('Cantidad')" />
                                <x-text-input id="cantidad" class="block w-full" type="number" name="cantidad"
                                    :value="old('cantidad')" required />
                                <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                            </div>

                            <div class="pb-1">
                                <x-primary-button type="submit">
                                    {{ __('+') }}
                                </x-primary-button>
                            </div>

                        </div>
                    </form>
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Productos Agregados</h3>
                        <table
                            class="border-separate border border-gray-400  text-sm text-gray-500 dark:text-gray-400">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300">Producto</th>
                                    <th class="border border-gray-300">Categoria</th>
                                    <th class="border border-gray-300">Cantidad</th>
                                    <th class="border border-gray-300">Precio $</th>
                                    <th class="border border-gray-300">Precio Bs</th>
                                    <th class="border border-gray-300">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleDespacho as $detalle)
                                     
                                    <tr>
                                        <td class="border border-gray-300">{{ $detalle->producto->codigo }}</td>
                                        <td class="border border-gray-300">{{ $detalle->producto->nombre }}</td>
                                        <td class="border border-gray-300">
                                            {{ $detalle->cantidad }}
                                        </td>
                                        <td class="border border-gray-300">{{ number_format($detalle->producto->precio, 2) }}</td>
                                        <td class="border border-gray-300">{{ number_format($detalle->producto->precio * $despachoActivo->tasa->tasa, 2) }}</td>
                                        <td class="border border-gray-300"><button></button>
                                            <form action="{{ route('despacho.destroyDetalle', $detalle->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                                    {{ __('Eliminar') }}
                                                </x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
</x-app-layout>
