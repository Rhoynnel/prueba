<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('productos') }}">{{ __('Productos') }}</a> <a href="{{ route('categorias') }}">{{ __('Categorias') }}</a>
        </h2>
        

    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('producto.crear') }}"><x-primary-button>{{ __('Agrega Producto') }}</x-primary-button></a>
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class=" border-separate border border-gray-400 w-full text-sm text-gray-500 dark:text-gray-400">
                        <thead>
                            <tr>
                                <th class="border border-gray-300">Codigo</th>
                                <th class="border border-gray-300">Nombre</th>
                                <th class="border border-gray-300">Categoria</th>
                                <th class="border border-gray-300">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $item)
                                <tr>
                                    <td>{{ $item->codigo }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>{{ $item->categoria->name }}</td>
                                    <td>{{ $item->stock_actual }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
