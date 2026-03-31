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
                    <div  class="fa fa-align-left" ></i>
                       Tasa Vigente bs. {{ $tasaVigente->tasa ?? 'No disponible' }} - con Fecha de: {{ $tasaVigente->fecha ?? 'No disponible' }}
                    </div>
                    
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <table class="table table-hover">
                        <thead>
                                <tr>
                                    <th >Rif o Cedula</th>
                                    <th >Nombre</th>
                                    <th >Telefono</th>
                                    <th >Direccion</th>
                                </tr>   
                        </thead>
                        <tbody>
                            <tr>
                                <td >{{ $cliente->cedula }}</td>
                                <td >{{ $cliente->nombreCompleto }}</td>
                                <td >{{ $cliente->telefono }}</td>
                                <td >{{ $cliente->direccion }}</td>

                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <form method="POST" action="{{ route('despacho.store') }}">
                        @csrf
                        <input type="hidden" name="clientes_id" value="{{ $cliente->id }}">
                        <input type="hidden" name="tasa_id" value="{{ $tasaVigente->id ?? '' }}">

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Registrar Despacho') }}
                            </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
