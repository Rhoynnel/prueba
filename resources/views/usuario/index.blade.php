<x-app-layout>
    <div class="container">
        <x-slot name="header">
            <h2>{{ __('Usuarios') }}</h2>
        </x-slot>

        <div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="flex justify-end mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregaUsuario">+</button>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Creado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditarUsuario{{$user->id}}">
                                    Editar
                                </button>

                                <form action="{{ route('usuario.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')">Eliminar</button>
                                </form>

                                <div class="modal fade" id="EditarUsuario{{$user->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Usuario: {{ $user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('usuario.update', $user) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input name="name" type="text" class="form-control" id="editName{{$user->id}}" value="{{ old('name', $user->name) }}" required>
                                                        <label for="editName{{$user->id}}">Nombre</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input name="email" type="email" class="form-control" id="editEmail{{$user->id}}" value="{{ old('email', $user->email) }}" required>
                                                        <label for="editEmail{{$user->id}}">Correo</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input name="password" type="password" class="form-control" id="editPass{{$user->id}}">
                                                        <label for="editPass{{$user->id}}">Contraseña (dejar en blanco para no cambiar)</label>
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
                                </td>
                        </tr>
                    @endforeach
                     {{ $users->links() }}
                </tbody>
            </table>
           
        </div>
    </div>

    <div class="modal fade" id="AgregaUsuario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('usuario.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name="name" type="text" class="form-control" id="newName" required>
                            <label for="newName">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control" id="newEmail" required>
                            <label for="newEmail">Correo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="password" type="password" class="form-control" id="newPass" required>
                            <label for="newPass">Contraseña</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="password_confirmation" type="password" class="form-control" id="newPassConfirm" required>
                            <label for="newPassConfirm">Confirmar Contraseña</label>
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