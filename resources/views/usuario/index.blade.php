<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <div class="flex justify-end mb-2">
                <a href="{{ route('usuario.crear') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('Agregar Usuario') }}</a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full border-collapse border border-gray-400 text-sm text-gray-500 dark:text-gray-400 rounded-none shadow">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border border-gray-300 text-left">Nombre</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Correo</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Creado</th>
                                <th class="px-4 py-2 border border-gray-300 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                                    <td class="px-4 py-2 border">{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('usuario.edit', $user) }}" class="text-indigo-600 hover:underline mr-2">Editar</a>
                                        <form action="{{ route('usuario.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>