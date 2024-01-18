<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Listado de Eventos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Listado de Eventos</h3>
                        <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Nuevo Evento</a>
                    </div>
                    @if ($events->isEmpty())
                        <p>No hay eventos disponibles.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Descripción
                                    </th>
                                </tr>
                            </thead>
                            
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($events as $event)
                                            <tr>
                                                <td class="px-6 py-4">{{ $event->name }}</td>
                                                <td class="px-6 py-4">{{ $event->description }}</td>                                            
                                                
                                                <td class="px-6 py-4">
                                                    <form action="{{ route('event.delete') }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" onclick="confirmDelete({{ $event->id }})" class="hover:bg-gray-200">
                                                            <img src="{{ asset('images/basura.png') }}" alt="Eliminar Evento" class="w-14 h-14 mx-2">
                                                        </button>
                                                        <input type="hidden" name="idevent" value="{{ $event->id }}"/>
                                                    </form>
                                                    
                                                    <form action="{{ route('events.edit', $event->id) }}" method="GET" class="inline">
                                                        <button type="submit" class="text-blue-500 hover:bg-gray-200">
                                                            <img src="{{ asset('images/editaricono.png') }}" alt="Editar Evento" class="w-14 h-14 mx-2">
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
