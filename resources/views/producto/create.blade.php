<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!--para dividir en columnas-->
                <div class="flex divide-x-4 divide-double divide-sky-400">
                    <div class="p-4 text-gray-900 dark:text-gray-100">
                        <h2 class="text-base/7 font-semibold text-white">Datos de Producto</h2>
                        <p class="mt-1 text-sm/6 text-gray-400">Aqui se cargaran los Datos Importantes del Producto.
                        <br>
                    <div class="alert alert-danger">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            
                        @endif
                    </div></p>
                        
                    </div>

                    <div class="p-6 text-gray-900 dark:text-gray-100">


                        <div class="border-b border-white/10 pb-12">


                            <form action="{{route('productos')}}" method="POST">
                                @csrf
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="Codigo"
                                            class="block text-sm/6 font-medium text-white">Codigo</label>
                                        <div class="mt-2">
                                            <input id="codigo" type="text" name="codigo"
                                                autocomplete="given-name"
                                                class="uppercase block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600" 
     />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="Barra"
                                            class="block text-sm/6 font-medium text-white">Barra</label>
                                        <div class="mt-2">
                                            <input id="barra" type="text" name="barra"
                                                autocomplete="family-name"
                                                class="uppercase block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600" 
     />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="Descripcion"
                                            class="block text-sm/6 font-medium text-white">Nombre</label>
                                        <div class="mt-2">
                                            <input id="nombre" type="text" name="nombre"
                                                autocomplete="family-name"
                                                class="uppercase block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600" 
     />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="categoria"
                                            class="block text-sm/6 font-medium text-white">Categorias</label>
                                        <div class="mt-2 grid grid-cols-1">
                                            <select id="categoriaid" name="categoriaid" autocomplete="category-name"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600" >
                                                @foreach ($categorias as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <x-primary-button>{{ __('Agrega Producto') }}</x-primary-button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <h2 class="text-base/7 font-semibold text-white">Categorias</h2>
                    <p class="mt-1 text-sm/6 text-gray-400">Aqui agregas una Categoria</p>
                    <a href="{{route('categoria.crear')}}"><x-primary-button>{{ __('Agrega Categoria') }}</x-primary-button></a>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
