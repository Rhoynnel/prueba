<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Proveedores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full border-collapse border border-gray-400 text-sm text-gray-500 dark:text-gray-400 rounded-none shadow">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border border-gray-300 text-left">RIF / Cédula</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Nombre</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Teléfono</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Dirección</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proveedores ?? [] as $item)
                                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                                    <td class="px-4 py-2 border">{{ $item->rif }}</td>
                                    <td class="px-4 py-2 border">{{ $item->nombre }}</td>
                                    <td class="px-4 py-2 border">{{ $item->telefono }}</td>
                                    <td class="px-4 py-2 border">{{ $item->direccion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if(isset($proveedores) && method_exists($proveedores, 'links'))
                        {{ $proveedores->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>