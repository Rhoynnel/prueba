<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Categorias') }} 
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <a href="{{route('categoria.crear')}}" class="btn btn-primary mb-3">{{ __('Agrega Categoria') }}</a>
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>