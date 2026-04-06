<x-app-layout>
    <x-slot name="header">
        <h2 >
            {{ __('Despachos') }}
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NuevoDespacho">Nuevo Despacho</button>
            <!---modal para buscar cliente -->
            <div class="modal fade" id="NuevoDespacho" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Buscar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('cliente.buscar') }}" method="GET">
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input name="cedula" type="text"  class="form-control" id="cedulaInput" required autofocus>
                                <label for="cedulaInput">Cedula</label>
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
                        
                        <thead >
                             
                             <tr>
                                <th >Cedula</th>
                                <th >Nombre</th>
                                <th >Tasa</th>
                                <th >Nro de Despacho</th>
                                <th >Total en Dolares</th>
                                <th >Total en Bolivares</th>
                                <th >Estatus</th>
                                <th >Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($despachos as $item)
                                <tr >
                                    <td >{{ $item->cliente->cedula }}</td>
                                    <td >{{ $item->cliente->nombreCompleto }}</td>
                                    <td >{{ $item->tasa ? $item->tasa->tasa : 'N/A' }}</td>
                                    <td >{{ $item->numeroDespacho() }}</td>
                                    <td >{{ number_format($item->total_dolares, 2) }}</td>
                                    <td >{{ number_format($item->total_bs, 2) }}</td>
                                    <td >
                                        @if ($item->status == 1)
                                            Cargada
                                        @else
                                            Sin Cargar
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        @if ($item->status == 1)
                                        <a href="{{ route('despacho.pdf', $item->id) }}" class="btn btn-success">Ver Detalle</a>
                                        @else
                                        <form action="{{ route('cliente.buscar') }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="cedula" value="{{$item->cliente->cedula}}" >
                                            <button type="submit" class="btn btn-primary">Cargar</button>
                                        </form>
                                        @endif
                                        
                                    </td>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $despachos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
