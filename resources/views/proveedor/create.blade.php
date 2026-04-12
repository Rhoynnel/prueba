<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Proveedores') }}
        </h2>

    </x-slot>

    <div class="container mt-4">
        <div> 
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        </div>
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="h-100 p-2 bg-body-tertiary border rounded-3">

                    


                            <form action="{{route('proveedores')}}" method="POST">
                                @csrf
                                
                                    <div class="form-group" >
                                        <label for="Codigo"
                                            class="block text-sm/6 font-medium text-white">Cedula o Rif</label>
                                        <div class="mt-2">
                                            <input id="rif" type="text" name="rif"
                                                autocomplete="given-name"
                                                class="form-control" 
     />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Nombre"
                                            class="block text-sm/6 font-medium text-white">Nombre</label>
                                        <div class="mt-2">
                                            <input id="nombre" type="text" name="nombre"
                                                autocomplete="family-name"
                                                class="form-control" 
     />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Telefono"
                                            class="block text-sm/6 font-medium text-white">Telefono</label>
                                        <div class="mt-2">
                                            <input id="telefono" type="text" name="telefono"
                                                autocomplete="family-name"
                                                class="form-control" 
     />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Direccion"
                                            class="block text-sm/6 font-medium text-white">Direccion</label>
                                        <div class="mt-2">
                                            <input id="direccion" type="text" name="direccion"
                                                autocomplete="family-name"
                                                class="form-control" 
     />
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">{{ __('Agrega Proveedor') }}</button>
                                    </div>
                            </form>
            </div>
        </div>
        <div class="col-md-4">
            
        </div>
    </div>
    </div>

                       
</x-app-layout>
