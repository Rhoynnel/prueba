<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Proveedores') }}</h2>
    </x-slot>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="flex justify-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregaProveedor">
                + Agregar Proveedor
            </button>
        </div>

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Rif/Cedula</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->rif }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->direccion }}</td>
                        <td >
                            
                                <a href="#" class="btn btn-sm btn-outline-secondary">Ver Compras</a>
                                
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditarProveedor{{$proveedor->id}}">
                                    Editar
                                </button>
                                
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#EliminarProveedor{{$proveedor->id}}">
                                    Eliminar
                                </button>
                            

                            <div class="modal fade" id="EditarProveedor{{$proveedor->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar: {{ $proveedor->nombre }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('proveedor.update', $proveedor) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body text-start">
                                                <div class="form-floating mb-3">
                                                    <input name="rif" type="text" class="form-control" id="editRif{{$proveedor->id}}" value="{{ old('rif', $proveedor->rif) }}" required>
                                                    <label for="editRif{{$proveedor->id}}">Rif/Cedula</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input name="nombre" type="text" class="form-control" id="editNom{{$proveedor->id}}" value="{{ old('nombre', $proveedor->nombre) }}" required>
                                                    <label for="editNom{{$proveedor->id}}">Nombre</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input name="telefono" type="text" class="form-control" id="editTel{{$proveedor->id}}" value="{{ old('telefono', $proveedor->telefono) }}" required>
                                                    <label for="editTel{{$proveedor->id}}">Teléfono</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input name="direccion" type="text" class="form-control" id="editDir{{$proveedor->id}}" value="{{ old('direccion', $proveedor->direccion) }}" required>
                                                    <label for="editDir{{$proveedor->id}}">Dirección</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-success">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="EliminarProveedor{{$proveedor->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">¿Eliminar?</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Confirma que desea eliminar a <strong>{{ $proveedor->nombre }}</strong>.
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('proveedor.destroy', $proveedor) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $proveedores->links() }}
    </div>

    <div class="modal fade" id="AgregaProveedor" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('proveedor.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name="rif" type="text" class="form-control" id="newRif" placeholder="Rif" required>
                            <label for="newRif">Rif/Cedula</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="nombre" type="text" class="form-control" id="newNombre" placeholder="Nombre" required>
                            <label for="newNombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="telefono" type="text" class="form-control" id="newTel" placeholder="Tel" required>
                            <label for="newTel">Teléfono</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="direccion" type="text" class="form-control" id="newDir" placeholder="Dir" required>
                            <label for="newDir">Dirección</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>