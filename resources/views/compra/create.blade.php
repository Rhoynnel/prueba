<x-app-layout>
    <x-slot name="header">
        <h2>
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
        <div class="row">
        <div class="col-md-12">
            <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                    <table
                        class="table table-hover">
                        <thead>
                                <tr><th>Rif o Cedula</th><td>{{ $proveedores->rif }}</td><th>Nombre</th><td>{{ $proveedores->nombre }}</td></tr>
                                <tr><th>Telefono</th><td>{{ $proveedores->telefono }}</td><th>Direccion</th><td>{{ $proveedores->direccion }}</td></tr>   
                        </thead>
                    </table>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="h-100 p-2 bg-body-tertiary border rounded-3">
                    <form method="POST" action="{{ route('compra.store') }}">
                        @csrf
                        <input type="hidden" name="proveedores_id" value="{{ $proveedores->id }}">
                        <div class="mt-4">
                            <label for="fecha">Fecha de Compra</label>
                            <input id="fecha" class="form-control" type="date" name="fecha" value="{{ old('fecha') }} " required autofocus  />
                            <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                        
                            <label for="N-Factura">Nro de Factura</label>
                            <input id="numero_factura" class="form-control" type="text" name="numero_factura" value="{{ old('numero_factura') }}" autofocus />
                            <x-input-error :messages="$errors->get('numero_factura')" class="mt-2" />

                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('Registrar Compra') }}
                            </button>
                        </div>
                    </form>
            </div>
        </div>
        <div class="col-md-4"></div>
        </div>
    </div>
</x-app-layout>
