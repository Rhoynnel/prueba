<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Tasas') }}</h2>
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
        <div class="row align-items-md-stretch">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">



                    <div class="flex justify-end mb-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#AgregaTasa">+</button>
                    </div>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasas as $tasa)
                            <tr>
                                <td>{{ $tasa->fecha }}</td>
                                <td>{{ $tasa->tasa }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#ConfirmaEliminacionTasa{{$tasa->id}}">
                                        -
                                    </button>

                                    <div class="modal fade" id="ConfirmaEliminacionTasa{{$tasa->id}}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminación de Tasa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('tasa.destroy', $tasa->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        <p>¿Está seguro que desea eliminar la tasa del día <strong>{{
                                                                $tasa->fecha }}</strong>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
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

                    {{ $tasas->links() }}

                    <div class="modal fade" id="AgregaTasa" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar Tasa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('tasa.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input name="tasa" type="number" step="0.01" min="0.01" class="form-control"
                                                id="montoInput" required autofocus>
                                            <label for="montoInput">Monto</label>
                                            <x-input-error :messages="$errors->get('tasa')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</x-app-layout>