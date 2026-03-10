<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('compras') }}">{{ __('Compras') }}</a>
        </h2>


    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table
                        class=" border-separate border border-gray-400 w-full text-sm text-gray-500 dark:text-gray-400">
                        <thead>
                           
                            <tr>
                                
                                    
                                
                                <th class="border border-gray-300">Rif o Cedula</th>
                                <td class="border border-gray-300">{{ $compras->proveedor->rif  }}</td>
                                <th class="border border-gray-300">Nombre</th>
                                <td class="border border-gray-300">{{ $compras->proveedor->nombre }}</td>
                            </tr>

                            <tr>
                                <th class="border border-gray-300">Telefono</th>
                                <td class="border border-gray-300">{{ $compras->proveedor->telefono }}</td>
                                <th class="border border-gray-300">Direccion</th>
                                <td class="border border-gray-300">{{ $compras->proveedor->direccion }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Fecha</th>
                                <td class="border border-gray-300">{{ $compras->fecha }}</td>
                                <th class="border border-gray-300">Nro Factura</th>
                                <td class="border border-gray-300">{{ $compras->numero_factura }}</td>
                            </tr>
                            <tr>
                                <th class="border border-gray-300">Estatus</th>
                                <td class="border border-gray-300">
                                    @if ($compras->status == 1)
                                        Cargada
                                    @else
                                        Sin Cargar
                                    @endif
                                </td>
                            </tr>
                            
                        </thead>
                    </table>


                    <div class="flex items-center justify-end mt-4">
                        <form action="{{ route('compra.cambiarStatus', $compras->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <x-primary-button type="submit" onclick="return confirm('¿Estás seguro de que deseas Cargar el Inventario?')">
                                {{ __('Cargar Compra') }}
                            </x-primary-button>
                        </form>
                    </div>
                    <div>Agregar Productos</div>
                    <form action="{{ route('compra.agregarProducto') }}" method="POST">
                        @csrf
                        <input type="hidden" name="compra_id" value="{{ $compras->id }}">
                        <div class="mt-4 flex flex-col md:flex-row gap-4 items-end">

                            <div class="flex-1 w-full">
                                <x-input-label for="producto_id" :value="__('Producto')" />
                                <select id="producto_id" name="producto_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm dark:bg-gray-700 dark:text-white">
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->codigo }} - {{ $producto->nombre }} - {{ $producto->categoria->name }}</option>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleCompra as $detalle)
                                     
                                    <tr>
                                        <td class="border border-gray-300">{{ $detalle->producto->codigo }}</td>
                                        <td class="border border-gray-300">{{ $detalle->producto->nombre }}</td>
                                        <td class="border border-gray-300">
                                            {{ $detalle->cantidad }}
                                        </td>
                                        <td class="border border-gray-300"><button></button>
                                            <form action="{{ route('compra.destroyDetalle', $detalle->id) }}" method="POST">
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
