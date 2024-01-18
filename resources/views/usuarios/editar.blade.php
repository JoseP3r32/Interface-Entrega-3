<x-app-layout>
    <x-slot name="header">
        <div class="bg-cover bg-center h-40" style="background-image: url('{{ asset('images/background.png') }}');">
            <h2 class="text-white text-2xl font-semibold tracking-wide p-8">Editar Usuario</h2>
        </div>
    </x-slot>

    <div class="container mx-auto my-8 p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg" style="background-image: url('{{ asset('images/background.png') }}');">
        <form method="post" action="{{ route('usuarios.actualizar', $usuario->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-600 dark:text-gray-400 text-sm font-medium mb-2">Nombre:</label>
                <input type="text" name="name" value="{{ $usuario->name }}" class="form-input w-full border-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-900 dark:text-white">
            </div>

            {{-- Agrega más campos de formulario según sea necesario para tu modelo de usuario --}}
            
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</x-app-layout>
