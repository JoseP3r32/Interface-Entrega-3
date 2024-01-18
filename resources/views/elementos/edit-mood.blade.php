    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Editar Estado de Animo
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('moods.update', $mood->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nombre del Estado de Animo
                                </label>
                                <input type="text" name="name" id="name" class="form-input mt-1 block w-full" value="{{ old('name', $mood->name) }}" required>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Descripción
                                </label>
                                <textarea name="description" id="description" class="form-input mt-1 block w-full" required></textarea>
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Imagen
                                </label>
                                <input type="file" name="image" id="image" class="form-input mt-1 block w-full">

                                <input type="hidden" name="id" value="{{ $mood->id }}">
                            </div>
                        
                            <div class="mt-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Editar Estado de Animo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

