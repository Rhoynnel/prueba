<x-app-layout>
    <x-slot name="header">
        <h2 >
            {{ __('Centro de Consultas') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row align-items-md-stretch">
            <div class="col-md-3">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <div>
                        Productos
                    </div>
             </div>
            </div>

            <div class="col-md-3">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <div>
                        <p>Aqui puedes buscar un cliente por cedula o nombre</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NuevoDespacho">Buscar Cliente</button>
                            <!---modal para buscar cliente -->
                            <div class="modal fade" id="NuevoDespacho" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Buscar Cliente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="#" method="GET">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <input name="cedula" type="text"  class="form-control" id="cedulaInput" required autofocus>
                                                <label for="cedulaInput">Cedula o Nombre</label>
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
                </div>
            </div>

            <div class="col-md-3">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <div>
                        <p>Aqui puedes buscar un proveedor por RIF o Nombre</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NuevaCompra">Buscar Proveedor</button>
                            <!---modal para buscar proveedor -->
                            <div class="modal fade" id="NuevaCompra" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Buscar Proveedor</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="#" method="GET">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <input name="rif" type="text"  class="form-control" id="rifInput" required autofocus>
                                                <label for="rifInput">RIF o Nombre</label>
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
                </div>
            </div>

            <div class="col-md-3">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <div>
                        <p>Aqui puedes buscar lo Despachado en periodos de tiempo</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#BuscarDespacho">Buscar Despacho</button>
                            <!---modal para buscar despacho -->
                            <div class="modal fade" id="BuscarDespacho" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Buscar Despacho</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('consulta.despacho') }}" method="GET">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <input name="desde" type="date"  class="form-control" id="rifInput" required autofocus>
                                                <label for="rifInput">Desde</label>
                                                <x-input-error :messages="$errors->get('desde')" class="mt-2" />
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="hasta" type="date"  class="form-control" id="rifInput" required autofocus>
                                                <label for="rifInput">Hasta</label>
                                                <x-input-error :messages="$errors->get('hasta')" class="mt-2" />
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>