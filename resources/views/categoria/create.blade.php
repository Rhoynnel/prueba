<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  leading-tight">
            {{ __('Categorias') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!--para dividir en columnas-->
                <div class="flex divide-x-4 divide-double divide-sky-400">
                    <div class="p-4 ">
                        <h2 class="text-base/7 font-semibold text-white">Datos de Categoria</h2>
                        <p class="mt-1 text-sm/6 ">Aqui se cargaran las Categorias</p>
                    </div>

                    <div class="p-6 ">


                        <div class="border-b border-white/10 pb-12">


                            <form action="{{route('categorias')}}" method="POST">
                                @csrf
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <div class="sm:col-span-4">
                                        <label for="Descripcion"
                                            class="block text-sm/6 font-medium text-black">Descripcion</label>
                                        <div class="mt-2">
                                            <input id="name" type="text" name="name"
                                                class="uppercase block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:text-white dark:ring-gray-600" 
                                                placeholder="Escribe la categoría..." />
                                        </div>
                                    </div>
                                    <br>
                                    <x-primary-button>{{ __('Agrega Categoria') }}</x-primary-button>
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
