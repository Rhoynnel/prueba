<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('productos') }}">{{ __('Productos') }}</a> <a href="{{ route('categorias') }}">{{ __('Categorias') }}</a>
        </h2>
        

    </x-slot>
    

    <div class="py-12" x-data="productPage()">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-2">
                <x-primary-button @click="$dispatch('open-modal','add-product')">{{ __('Agrega Producto') }}</x-primary-button>
                <x-secondary-button @click="$dispatch('open-modal','import-products')">{{ __('Carga masiva') }}</x-secondary-button>
            </div>
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

    <!-- Product modal -->
    <x-modal name="add-product">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Agregar Nuevo Producto') }}</h2>
            <form action="{{ route('productos') }}" method="POST" class="mt-4">
                @csrf
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-input-label for="codigo" :value="__('Codigo')" />
                        <x-text-input id="codigo" name="codigo" class="block mt-1 w-full" autofocus />
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label for="barra" :value="__('Barra')" />
                        <x-text-input id="barra" name="barra" class="block mt-1 w-full" />
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" name="nombre" class="block mt-1 w-full" />
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label for="stock_actual" :value="__('Stock Actual')" />
                        <x-text-input id="stock_actual" name="stock_actual" class="block mt-1 w-full" />
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label for="categoriaid" :value="__('Categoria')" />
                        <div class="flex items-center gap-2">
                            <select id="categoriaid" name="categoriaid" class="block w-full rounded-md">
                                @foreach ($categorias as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="p-2 bg-blue-500 text-white rounded" @click="$dispatch('open-modal','add-category')">+</button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end mt-6">
                    <x-secondary-button @click="$dispatch('close-modal','add-product')" class="mr-4">
                        {{ __('Cancelar') }}
                    </x-secondary-button>
                    <x-primary-button>
                        {{ __('Agregar Producto') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Category modal -->
    <x-modal name="add-category">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Agregar Nueva Categoria') }}</h2>
            <form @submit.prevent="addCategory" class="mt-4">
                <div>
                    <x-input-label for="newcat" :value="__('Nombre categoria')" />
                    <x-text-input id="newcat" x-model="newCategory" class="block mt-1 w-full" />
                </div>
                <div class="flex items-center justify-end mt-6">
                    <x-secondary-button @click="$dispatch('close-modal','add-category')" class="mr-4">
                        {{ __('Cancelar') }}
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        {{ __('Guardar Categoria') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Import modal -->
    <x-modal name="import-products">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Carga Masiva de Productos y Categorías') }}</h2>
            <form action="{{ route('producto.import') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="mt-4">
                    <x-input-label for="excel" :value="__('Archivo (xlsx o csv)')" />
                    <input id="excel" type="file" name="file" accept=".xlsx,.csv" class="mt-2 block w-full" required />
                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                </div>
                <div class="flex items-center justify-end mt-6">
                    <x-secondary-button @click="$dispatch('close-modal','import-products')" class="mr-4">
                        {{ __('Cancelar') }}
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        {{ __('Importar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

</x-app-layout>

<script>
    function productPage() {
        return {
            newCategory: '',
            addCategory() {
                if (!this.newCategory) return;
                axios.post('{{ route('categoria.store') }}', { name: this.newCategory })
                    .then(response => {
                        // append option to select
                        const sel = document.getElementById('categoriaid');
                        const opt = document.createElement('option');
                        opt.value = response.data.id;
                        opt.textContent = response.data.name;
                        sel.appendChild(opt);
                        sel.value = response.data.id;
                        this.newCategory = '';
                        this.$dispatch('close-modal','add-category');
                    })
                    .catch(err => {
                        console.error(err);
                        alert('No se pudo guardar la categoría, revisa la consola para más detalles.');
                    });
            }
        }
    }
</script>
