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

                    <table class="table table-hover">
                        
                        <thead >
                             
                             <tr>
                                <th >Cedula</th>
                                <th >Nombre</th>
                                <th >Tasa</th>
                                <th >Nro de Despacho</th>
                                <th >Total en Dolares</th>
                                <th >Total en Bolivares</th>
                                <th >Fecha</th>
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
                                    <td >{{ $item->created_at->format('d/m/Y') }}</td>
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

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
