<x-app-layout>
    <x-slot name="header">
        <h2 >
            {{ __('Compras') }}
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

        <div class="flex justify-end mb-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NuevaCompra">Nueva Compra</button>
            <!---modal para buscar proveedor -->
            <div class="modal fade" id="NuevaCompra" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Buscar Proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('proveedor.buscar') }}" method="GET">
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input name="rif" type="text"  class="form-control" id="rifInput" required autofocus>
                                <label for="rifInput">RIF</label>
                                <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
           <table class="table table-hover">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                    <th>Nro Factura</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $item)
                    <tr>
                        <td>{{ $item->numeroCompra() }}</td>
                        <td>{{ $item->proveedor?->nombre }}</td>
                        <td>{{ $item->fecha }}</td>
                        <td>{{ $item->numero_factura }}</td>
                        <td>
                            @if ($item->status == 1)
                                Cargada
                            @else
                                Sin Cargar
                            @endif
                        </td>
                        <td>
                            @if ($item->status == 1)
                                <a href="{{ route('compra.pdf', $item->id) }}" class="btn btn-success">Ver Detalle</a>
                            @else
                                <form action="{{ route('proveedor.buscar') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="rif" value="{{$item->proveedor->rif}}" >
                                    <button type="submit" class="btn btn-primary">Cargar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
           </table>
           {{ $compras->links() }}
    </div>
</x-app-layout>
