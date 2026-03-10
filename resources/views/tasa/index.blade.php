<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('tasas') }}">{{ __('Tasas') }}</a>
        </h2>
        

    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('tasa.crear') }}"><x-primary-button>{{ __('Agrega Tasa') }}</x-primary-button></a>
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="mx-auto max-w-3xl border-separate border border-gray-400 text-sm text-gray-500 dark:text-gray-400">
                        <thead>
                            <tr>
                                <th class="border border-gray-300">Fecha</th>
                                <th class="border border-gray-300">Tasa</th>
                                <th class="border border-gray-300">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasas as $item)
                                <tr>
                                    <td>{{ $item->fecha }}</td>
                                    <td>{{ $item->tasa }}</td>
                                    <td>
                                        <form action="{{ route('tasa.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta tasa?')">{{ __('Eliminar') }}</x-danger-button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $tasas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>