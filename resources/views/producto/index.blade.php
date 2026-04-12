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
                                        <button type="button" 
                                                class="btn btn-primary btn-sm btn-editar" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ModalDinamico"
                                                data-id="{{ $item->id }}"
                                                data-codigo="{{ $item->codigo }}"
                                                data-barra="{{ $item->barra }}"
                                                data-nombre="{{ $item->nombre }}"
                                                data-categoria="{{ $item->categorias_id }}"
                                                data-stock="{{ $item->stock_actual }}"
                                                data-compra="{{ $item->precio_compra }}"
                                                data-venta="{{ $item->precio_venta }}">
                                            Editar
                                        </button>
                                        <button type="button" 
                                                class="btn btn-danger btn-sm btn-eliminar" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ModalDinamicoEliminar"
                                                data-id="{{ $item->id }}"
                                                data-nombre="{{ $item->nombre }}">
                                                
                                            Eliminar
                                        </button>

                                        
                               
                                

                                    </td>

                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {{ $productos->links() }}
    </div>

           

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
                            <input name="precio_compra" type="number" step="0.01" min="0.01" class="form-control" id="newPreciocompra" placeholder="Precio Compra" required>
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

        <!-- Modal Dinamico -->
        <div class="modal fade" id="ModalDinamico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditar" action="{{ route('producto.update', '0') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input name="codigo" type="text" class="form-control" id="edit_codigo" required>
                        <label>Código</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="barra" type="text" class="form-control" id="edit_barra">
                        <label>Barra</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="nombre" type="text" class="form-control" id="edit_nombre" required>
                        <label>Nombre</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <select name="categoriaid" id="edit_categoria" class="form-select" required>
                            <option value="" disabled>Seleccione una categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                        <label for="edit_categoria">Categoría</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="stock_actual" type="number" class="form-control" id="edit_stock" required>
                        <label>Stock</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="precio_compra" type="number" step="0.01" min="0.01" class="form-control" id="edit_compra" required>
                        <label>Precio Compra</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="precio_venta" type="number" step="0.01" min="0.01" class="form-control" id="edit_venta" required>
                        <label>Precio Venta</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEditar = document.getElementById('ModalDinamico');
        
        modalEditar.addEventListener('show.bs.modal', function (event) {
            // El botón que activó el modal
            const button = event.relatedTarget;
            
            // Extraer la información de los atributos data-*
            const id = button.getAttribute('data-id');
            const codigo = button.getAttribute('data-codigo');
            const barra = button.getAttribute('data-barra');
            const nombre = button.getAttribute('data-nombre');
            const stock = button.getAttribute('data-stock');
            const categoriaIdActual = button.getAttribute('data-categoria');
            const compra = button.getAttribute('data-compra');
            const venta = button.getAttribute('data-venta');
            const selectCategoria = modalEditar.querySelector('#edit_categoria');
            selectCategoria.value = categoriaIdActual;

            // Llenar los campos del formulario
            modalEditar.querySelector('#edit_id').value = id;
            modalEditar.querySelector('#edit_codigo').value = codigo;
            modalEditar.querySelector('#edit_barra').value = barra;
            modalEditar.querySelector('#edit_nombre').value = nombre;
            modalEditar.querySelector('#edit_stock').value = stock;
            modalEditar.querySelector('#edit_compra').value = compra;
            modalEditar.querySelector('#edit_venta').value = venta;
        });
    });
</script>

<!--modal de eliminar--->
<div class="modal fade" id="ModalDinamicoEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEliminar" action="{{ route('producto.destroy', '0') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="edit_id">
            <div class="modal-body">
                <p>¿Está seguro de que desea eliminar el producto "<span id="nombreProducto"></span>"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEliminar = document.getElementById('ModalDinamicoEliminar');
        
        modalEliminar.addEventListener('show.bs.modal', function (event) {
            // El botón que activó el modal
            const button = event.relatedTarget;
            
            // Extraer la información de los atributos data-*
            const id = button.getAttribute('data-id');
            const nombre = button.getAttribute('data-nombre');
            const formEliminar = modalEliminar.querySelector('#formEliminar');
            formEliminar.action = '{{ route('producto.destroy', ':id') }}'.replace(':id', id);

            
            // Llenar los campos del formulario
            modalEliminar.querySelector('#edit_id').value = id;
            modalEliminar.querySelector('#nombreProducto').textContent = nombre;
        });
    });
</script>


    

</x-app-layout>


