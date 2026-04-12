<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Clientes') }}</h2>
    </x-slot>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="flex justify-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregaCliente">
                + Agregar Cliente
            </button>
        </div>
         <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->cedula }}</td>
                        <td>{{ $cliente->nombreCompleto }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td >
                            
                                
                                
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditarCliente{{$cliente->id}}">
                                    Editar
                                </button>
                                
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#EliminarCliente{{$cliente->id}}">
                                    Eliminar
                                </button>

                                <!-------modal para editar cliente-------->

<div class="modal fade" id="EditarCliente{{$cliente->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Edita Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cliente.update', $cliente) }}" method="POST">

                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId{{$cliente->id}}" value="{{ $cliente->id }}" required>

                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name="cedula" type="text" value="{{ old('cedula', $cliente->cedula) }}" class="form-control" id="newCedula" placeholder="Cedula" required>
                            <label for="newCedula">Rif/Cedula</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="nombreCompleto" type="text" value="{{ old('nombreCompleto', $cliente->nombreCompleto) }}" class="form-control" id="newNombre" placeholder="Nombre" required>
                            <label for="newNombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="telefono" type="text" value="{{ old('telefono', $cliente->telefono) }}" class="form-control" id="newTel" placeholder="Tel" required>
                            <label for="newTel">Teléfono</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="direccion" type="text" value="{{ old('direccion', $cliente->direccion) }}" class="form-control" id="newDir" placeholder="Dir" required>
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

    <!---modal para eliminar cliente----->
<div class="modal fade" id="EliminarCliente{{$cliente->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">¿Eliminar?</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Confirma que desea eliminar a <strong>{{ $cliente->nombreCompleto }}</strong>.
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('cliente.destroy', $cliente) }}" method="POST">
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
                          {{ $clientes->links() }}
            </tbody>
        </table>
      
        </div>
        <div class="modal fade" id="AgregaCliente" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cliente.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="origen" id="origen" value="Cliente" required>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name="cedula" type="text" class="form-control" id="newCedula" placeholder="Cedula" required>
                            <label for="newCedula">Rif/Cedula</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="nombreCompleto" type="text" class="form-control" id="newNombre" placeholder="Nombre" required>
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
                  