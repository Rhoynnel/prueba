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