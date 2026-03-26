<x-app-layout>
    <x-slot name="header">
        <h2 >
           {{ __('Productos') }}
        </h2>
        

    </x-slot>
    

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="flex justify-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregaProducto">
                + Nuevo Producto
            </button>
            
            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#CargaMasiva">
                Carga Masiva
            </button>

        </div>
        
            <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Precio Venta</th>
                    <th>Precio Compra</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
                            
                        
                            @foreach ($productos as $item)
                                <tr>
                                    <td >{{ $item->codigo }}</td>
                                    <td >{{ $item->nombre }}</td>
                                    <td >{{ $item->categoria->name }}</td>
                                    <td >{{ $item->stock_actual }}</td>
                                    <td >{{ $item->precio_venta }}</td>
                                    <td >{{ $item->precio_compra }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditarProducto{{$item->id}}">
                                    Editar
                                </button>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#EliminarProducto{{$item->id}}">
                                    Eliminar
                                </button>

        <div class="modal fade" id="EditarProducto{{$item->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edita Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('producto.update', $item) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$item->id}}" id="newId{{$item->id}}" required/>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name="codigo" type="text" class="form-control" value="{{ old('codigo', $item->codigo) }}" id="newCodigo{{$item->id}}" placeholder="Codigo" required>
                            <label for="newCodigo">Codigo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="barra" type="text" class="form-control" value="{{ old('barra', $item->barra) }}"id="newbarra{{$item->id}}" placeholder="Barra">
                            <label for="newBarra">Barra</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input name="nombre" type="text" class="form-control" value="{{ old('nombre', $item->nombre) }}"id="newNombre{{$item->id}}" placeholder="Nombre" required>
                            <label for="newNombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="categoriaid" id="categoriaid" class="form-select" required>
                                <option value="{{ $item->categoria->id }}">{{$item->categoria->name }}</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="stock_actual" type="number" class="form-control" value="{{ old('stock_actual', $item->stock_actual) }}"id="newStock{{$item->id}}" placeholder="Stock" required>
                            <label for="newStock">Stock</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="precio_compra" type="number" step="0.01" min="0.01" class="form-control" value="{{ old('precio_compra', $item->precio_compra) }}"id="newPreciocompa{{$item->id}}" placeholder="Precio Compra" required>
                            <label for="newPrecioCompra">Precio Compra</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="precio_venta" type="number" step="0.01" min="0.01" class="form-control" value="{{ old('precio_venta', $item->precio_venta) }}"id="newPrecioVenta{{$item->id}}" placeholder="Precio Venta" required>
                            <label for="newPrecioVenta">Precio Venta</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

                            <div class="modal fade" id="EliminarProducto{{$item->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">¿Eliminar?</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Confirma que desea eliminar a <strong>{{ $item->nombre }}</strong>.
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('producto.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $productos->links() }}

           

    <!-- Product modal -->
    <div class="modal fade" id="AgregaProducto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('producto.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name="codigo" type="text" class="form-control" id="newCodigo" placeholder="Codigo" required>
                            <label for="newCodigo">Codigo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="barra" type="text" class="form-control" id="newbarra" placeholder="Barra">
                            <label for="newBarra">Barra</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input name="nombre" type="text" class="form-control" id="newNombre" placeholder="Nombre" required>
                            <label for="newNombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="categoriaid" id="categoriaid" class="form-select" required>
                                <option value="">{{ __('Categoria') }}</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="stock_actual" type="number" class="form-control" id="newStock" placeholder="Stock" required>
                            <label for="newStock">Stock</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="precio" type="number" step="0.01" min="0.01" class="form-control" id="newPreciocompa" placeholder="Precio Compra" required>
                            <label for="newPrecioCompra">Precio Compra</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="precio_venta" type="number" step="0.01" min="0.01" class="form-control" id="newPrecioVenta" placeholder="Precio Venta" required>
                            <label for="newPrecioVenta">Precio Venta</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
 
    <!-- editar producto modal -->
    


    

    <!-- Import modal -->
    <div class="modal fade" id="CargaMasiva" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{ __('Carga Masiva de Productos y Categorías') }}</h3>
                </div>
            <form action="{{ route('producto.import') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="form-floating mb-3">
                    
                    <input id="excel" type="file" name="file" accept=".xlsx,.csv" class="form-control" required />
                    <label for="excel">{{__('Archivo (xlsx o csv)')}}</label>
                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                </div>
                <div class="flex items-center justify-end mt-6">
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>
</div>

    

</x-app-layout>


