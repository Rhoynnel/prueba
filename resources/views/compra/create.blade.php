<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('compras') }}">{{ __('Compras') }}</a>
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
                                <tr><th class="border border-gray-300">Rif o Cedula</th><td class="border border-gray-300" >{{ $proveedores->rif }}</td><th class="border border-gray-300">Nombre</th><td class="border border-gray-300">{{ $proveedores->nombre }}</td></tr>
                                
                                <tr><th class="border border-gray-300">Telefono</th><td class="border border-gray-300">{{ $proveedores->telefono }}</td><th class="border border-gray-300">Direccion</th><td class="border border-gray-300">{{ $proveedores->direccion }}</td></tr>   
                        </thead>
                    </table>
                    <form method="POST" action="{{ route('compra.store') }}">
                        @csrf
                        <input type="hidden" name="proveedores_id" value="{{ $proveedores->id }}">
                        <div class="mt-4">
                            <x-input-label for="fecha" :value="__('Fecha de Compra')" />
                            <x-text-input id="fecha" class="block mt-1 w-full" type="date" name="fecha" value="{{ old('fecha') }} " required autofocus  />
                            <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                        
                            <x-input-label for="N-Factura" :value="__('Nro de Factura')" />
                            <x-text-input id="numero_factura" class="uppercase block mt-1 w-full" type="text" name="numero_factura" value="{{ old('numero_factura') }}" autofocus />
                            <x-input-error :messages="$errors->get('numero_factura')" class="mt-2" />

                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Registrar Compra') }}
                            </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
