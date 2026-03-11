<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('tasas') }}">{{ __('Tasas') }}</a>
        </h2>
    </x-slot>

    <div class="py-12" x-data>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- trigger event to open modal -->
            <x-primary-button @click="$dispatch('open-modal', 'add-tasa')">{{ __('Agrega Tasa') }}</x-primary-button>
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full border-collapse border border-gray-400 text-sm text-gray-500 dark:text-gray-400 rounded-none shadow">
                        
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border border-gray-300 text-left">Fecha</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Tasa</th>
                                <th class="px-4 py-2 border border-gray-300 text-center">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasas as $item)
                                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                                    <td class="px-4 py-2 border">{{ $item->fecha }}</td>
                                    <td class="px-4 py-2 border">{{ $item->tasa }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <form action="{{ route('tasa.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta tasa?')">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit" title="Eliminar tasa">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </x-danger-button>
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

        <!-- Modal -->
        <x-modal name="add-tasa">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Agregar Nueva Tasa') }}
                </h2>

                <form action="{{ route('tasa.store') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mt-4">
                        <x-input-label for="tasa" :value="__('Tasa')" />
                        <x-text-input id="tasa" class="block mt-1 w-full" type="number" step="0.01" name="tasa" placeholder="Escribe la tasa..." required />
                        <x-input-error :messages="$errors->get('tasa')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-secondary-button @click="$dispatch('close-modal', 'add-tasa')" class="mr-4">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Agregar Tasa') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
</x-app-layout>