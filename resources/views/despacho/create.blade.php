<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('despachos') }}">{{ __('Despachos') }}</a>
        </h2>
        

    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="alert alert-danger">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            
                        @endif
                    </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class=" border-separate border border-gray-400 w-full text-sm text-gray-500 dark:text-gray-400">
                        <thead>
                                <tr><th class="border border-gray-300">Rif o Cedula</th><td class="border border-gray-300" >{{ $cliente->cedula }}</td><th class="border border-gray-300">Nombre</th><td class="border border-gray-300">{{ $cliente->nombreCompleto }}</td></tr>
                                
                                <tr><th class="border border-gray-300">Telefono</th><td class="border border-gray-300">{{ $cliente->telefono }}</td><th class="border border-gray-300">Direccion</th><td class="border border-gray-300">{{ $cliente->direccion }}</td></tr>   
                        </thead>
                        <tbody>
                            <tr>
                                <th class="border border-gray-300">Tasa Vigente</th><td class="border border-gray-300">{{ $tasaVigente->tasa ?? 'No disponible' }} - con Fecha de: {{ $tasaVigente->fecha ?? 'No disponible' }}</td>
                            </tr>
                        </tbody>


                    </table>
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
