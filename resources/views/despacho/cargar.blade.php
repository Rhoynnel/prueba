<x-app-layout>
    <x-slot name="header">
        <h2 >
            {{ __('Despachos') }}
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
        <div class="col-md-9">
            <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                    <table
                        class="table table-hover">
                        <thead>
                           
                            <tr>
                                
                                    
                                
                                <th >Rif o Cedula</th>
                                <th >Nombre</th>
                                <th >Telefono</th>
                                <th >Direccion</th>
                                <th >Nro de Despacho</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td >{{ $despachoActivo->cliente->cedula  }}</td>
                                <td >{{ $despachoActivo->cliente->nombreCompleto }}</td>
                                <td >{{ $despachoActivo->cliente->telefono }}</td>  
                                <td >{{ $despachoActivo->cliente->direccion }}</td>
                                <td >{{ $despachoActivo->numeroDespacho() }}</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                    <table
                        class="table table-hover">
                        <thead>
                            <tr>
                                <th >Tasa</th>
                                <th >Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td >{{ $despachoActivo->tasa->tasa }}</td>
                                <td >{{ $despachoActivo->tasa->fecha }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex items-center justify-end mt-4">
                        <form action="{{ route('despacho.cambiarStatus', $despachoActivo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Estás seguro de que deseas Descontar del Inventario?')">
                                {{ __('Cargar Despacho') }}
                            </button>
                        </form>
                    </div>
            </div>
        </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                    <div class="flex justify-end mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarProducto">Agregar Producto</button>
                    </div>
                    
                    <!-- Modal para agregar producto -->
                    <div class="modal fade" id="AgregarProducto" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('despacho.agregarProducto') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="despachos_id" value="{{ $despachoActivo->id }}">
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <select id="productos_id" name="productos_id" class="form-select">
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}">{{ $producto->codigo }} - {{ $producto->nombre }} - {{ $producto->categoria->name }} - {{ $producto->stock_actual }}</option>
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
                    <table
                        class="table table-hover">
                        <thead>
                            <tr>
                                <th >Producto</th>
                                <th >Categoria</th>
                                <th >Cantidad</th>
                                <th >Precio $</th>
                                <th >Precio Bs</th>
                                <th >Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalleDespacho as $detalle)
                                <tr>
                                    <td >{{ $detalle->producto->codigo }}</td>
                                    <td >{{ $detalle->producto->nombre }}</td>
                                    <td >
                                        {{ $detalle->cantidad }}
                                    </td>
                                    <td >{{ number_format($detalle->precio_dolar*$detalle->cantidad, 2) }}</td>
                                    <td >{{ number_format(($detalle->precio_dolar*$detalle->cantidad), 2)*$despachoActivo->tasa->tasa }}</td>
                                    <td >
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditarProducto{{ $detalle->id }}">Editar</button>
                                        <!-- Modal para editar producto -->
                                        <div class="modal fade" id="EditarProducto{{ $detalle->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Producto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('detalleDespacho.updateDetalle', $detalle->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-floating mb-3">
                                                                <select id="productos_id" name="productos_id" class="form-select">
                                                                    @foreach ($productos as $producto)
                                                                        <option value="{{ $producto->id }}">{{ $producto->codigo }} - {{ $producto->nombre }} - {{ $producto->categoria->name }} - {{ $producto->stock_actual }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <input id="cantidad" class="form-control" type="number" name="cantidad"
                                                                    value="{{$detalle->cantidad}}" required />
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
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#EliminarProducto{{ $detalle->id }}">Eliminar</button>
                                        <!-- Modal para eliminar producto -->
                                        <div class="modal fade" id="EliminarProducto{{ $detalle->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Eliminar Producto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('detalleDespacho.destroyDetalle', $detalle->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <p>¿Está seguro de eliminar el producto {{ $detalle->producto->codigo }} - {{ $detalle->producto->nombre }}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>



                    
    </div>
</x-app-layout>
