<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Categorias') }} 
        </h2>
    </x-slot>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                        <div class="flex justify-end mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregaCategoria">
                                + Agregar Categoria
                            </button>
                        </div>

                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarCategoria{{ $item->id }}">
                                            Eliminar
                                        </button>
                                        <div class="modal fade" id="EliminarCategoria{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Eliminar Categoria</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('categoria.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body text-start">
                                                            <p>¿Estas seguro de eliminar la categoria {{ $item->name }}?</p>
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
                    {{ $categorias->links() }}
                    </div>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="AgregaCategoria" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar Categoria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('categoria.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body text-start">
                                        <div class="form-floating mb-3">
                                            <input name="name" type="text" class="form-control" id="name" required>
                                            <label for="name">Nombre</label>
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
</x-app-layout>