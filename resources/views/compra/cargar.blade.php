<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compras') }}
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
        <div class="row">
        <div class="col-md-12">
            <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                    <table
                        class="table table-hover">
                        <thead>
                           
                            <tr>
                                <th>Rif o Cedula</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Fecha</th>
                                <th>Nro Factura</th>
                                <th>Estatus</th>
                                </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $compras->proveedor->rif  }}</td>
                                
                                <td>{{ $compras->proveedor->nombre }}</td>
                                <td>{{ $compras->proveedor->telefono }}</td>
                                <td>{{ $compras->proveedor->direccion }}</td>
                                <td>{{ $compras->fecha }}</td>
                                <td>{{ $compras->numero_factura }}</td>
                                <td>
                                    @if ($compras->status == 1)
                                        Cargada
                                    @else
                                        Sin Cargar
                                    @endif
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                                <div class="flex justify-end mb-3">
                                    <center><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarProducto">Agregar Producto</button></center>
                                </div>
                                <div class="modal fade" id="AgregarProducto" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Agregar Producto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('compra.agregarProducto') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="compra_id" value="{{ $compras->id }}">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <select id="producto_id" name="producto_id" class="form-select">
                                                            @foreach ($productos as $producto)
                                                                <option value="{{ $producto->id }}">{{ $producto->codigo }} - {{ $producto->nombre }} - {{ $producto->categoria->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input id="cantidad" class="form-control" type="number" name="cantidad"
                                                            :value="old('cantidad')" required />
                                                        <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success">Agregar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4"><h3>Productos Agregados</h3></div>


                        <div class="col-md-4">
                            <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                                <div class="flex justify-end mb-3"><center>
                        <form action="{{ route('compra.cambiarStatus', $compras->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary" onclick="return confirm('¿Estás seguro de que deseas Cargar el Inventario?')">
                                {{ __('Cargar Compra') }}
                            </button>
                        </form></center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                    <div class="col-md-12">
                        <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                        <table
                            class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleCompra as $detalle)
                                     
                                    <tr>
                                        <td >{{ $detalle->producto->codigo }}</td>
                                        <td >{{ $detalle->producto->nombre }}</td>
                                        <td >
                                            {{ $detalle->cantidad }}
                                        </td>
                                        <td >
                                            <form action="{{ route('compra.destroyDetalle', $detalle->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                                    {{ __('Eliminar') }}
                                                </button>
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
