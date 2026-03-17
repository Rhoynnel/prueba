<x-app-layout>
    
    <div class="container">
    <x-slot name="header">
        <h2>
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div>
        <div>
            @if(session('success'))
                <div>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div>
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex justify-end mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModalPersonalizado">
  +
</button>
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
                            <a href="{{ route('usuario.edit', $user) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('usuario.destroy', $user) }}" class="btn btn-danger">Eliminar</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    
</table>
{{ $users->links() }}

        </div>
    </div>

<!----------------inicio modal------------------>
    <div class="modal fade" id="miModalPersonalizado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Título del Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Aquí puedes colocar tu formulario, tablas o cualquier contenido.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

</x-app-layout>
