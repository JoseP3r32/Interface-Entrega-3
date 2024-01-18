<x-app-layout style="background-image: url('{{ asset('images/background.png') }}'); display: flex; align-items: center; justify-content: space-between; padding-right: 2rem;">
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Página de Administrador
        </h2>
        <div class="py-2">
            <button id="elementButton" class="bg-lime-800 text-gray-200 hover:bg-lime-200 px-4 py-2 rounded focus:outline-none focus:shadow-outline text-white">
                Elementos
            </button>

            <div id="elementSubMenu" class="hidden bg-lime-800 border rounded-md mt-2">
                <a href="{{ route('listar.moods') }}" class="block px-4 py-2   text-gray-500 hover:bg-lime-200 dark:bg-gray-800">
                    Estados de ánimo
                </a>
                <a href="{{ route('listar.emotions') }}" class="block px-4 py-2 text-gray-500 hover:bg-lime-200 dark:bg-gray-800">
                    Emociones
                </a>
                <a href="{{ route('listar.events') }}" class="block px-4 py-2 text-gray-500 hover:bg-lime-200 dark:bg-gray-800">
                    Eventos
                </a>
            </div>
        </div>
    </x-slot>
    
    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-200 dark:bg-gray-700">Nombre</th>
                                <th class="px-6 py-3 bg-gray-200 dark:bg-gray-700">Email</th>
                                <th class="px-6 py-3 bg-gray-200 dark:bg-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users->whereNotNull('email_verified_at')->where('type', 'u') as $user)
                                <tr>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4 space-x-2 flex items-center justify-center">
                                        @if ($user->actived == 1)
                                            <form method="POST" action="{{ route('deactivate.user', ['userId' => $user->id]) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-blue-500 hover:bg-gray-200">
                                                    <img src="{{ asset('images/activar.png') }}" alt="Activar Usuario" class="w-14 h-14 mx-2">
                                                </button>
                                                <input type="hidden" name="iduser" value="{{ $user->id }}"/>
                                            </form>
                                        @elseif($user->actived == 0)
                                            <form method="POST" action="{{ route('activate.user', ['userId' => $user->id]) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-500 hover:bg-gray-200">
                                                    <img src="{{ asset('images/off.png') }}" alt="Desactivar Usuario" class="w-14 h-14 mx-2">
                                                </button>
                                                <input type="hidden" name="iduser" value="{{ $user->id }}"/>
                                            </form>
                                        @endif

                                        <form action="/eliminar" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="hover:bg-gray-200">
                                                <img src="{{ asset('images/basura.png') }}" alt="Eliminar Usuario" class="w-14 h-14 mx-2">
                                            </button>
                                            <input type="hidden" name="iduser" value="{{ $user->id }}"/>
                                        </form>

                                        <form action="{{ route('usuarios.editar', $user->id) }}" method="GET" class="inline">
                                            <button type="submit" class="text-blue-500 hover:bg-gray-200">
                                                <img src="{{ asset('images/editaricono.png') }}" alt="Editar Usuario" class="w-14 h-14 mx-2">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#elementButton").click(function () {
                $("#elementSubMenu").toggle();
            });
        });
    </script>
</x-app-layout>
