    <x-app-layout>
        <div class="py-12" style="background-image: url('{{ asset('images/fondoelementos.png') }}'); background-size: cover; background-position: center;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-end mb-4">
                    <a href="{{ route('generate.pdf') }}" title="Generar PDF">
                        <img src="{{ asset('images/pdfbutton.png') }}" alt="Generar PDF" class="w-15 h-12">
                    </a>
                    
                </div>
                <!-- Tabla para Elementos -->
                <h1 style="font-weight: bold; font-size: 30px; text-transform: uppercase; color: gray">Listado de Elementos</h1>
                <div class="overflow-hidden rounded-lg shadow-lg">
                    <table class="min-w-full leading-normal" style="opacity: 0.8">
                        <thead style="background-color:  #a7c8fb ">
                            <tr>
                                <th class="px-5 py-3  border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Tipo</th>
                                <th class="px-5 py-3  border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Nombre</th>
                                <th class="px-5 py-3  border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Descripcion</th>
                                <th class="px-5 py-3  border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Fecha/Hora</th>
                                <th class="px-5 py-3  border-gray-200 text-gray-800 text-left text-sm uppercase font-normal">Imagen</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($isEmpty)
                                <tr>
                                    <td colspan="6" class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="alert alert-warning">
                                            No hay elementos asignados.
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($sortedElements as $element)
                                    <tr class="hover:bg-gray-100">
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                @switch($element->type)
                                                    @case('mood')
                                                        <p class="text-gray-900 whitespace-no-wrap">Estado de Ánimo</p>
                                                        @break
                                                    @case('emotion')
                                                        <p class="text-gray-900 whitespace-no-wrap">Emoción</p>
                                                        @break
                                                    @case('event')
                                                        <p class="text-gray-900 whitespace-no-wrap">Eventos</p>
                                                        @break
                                                    @default
                                                        <p class="text-gray-900 whitespace-no-wrap">{{ $element->type }}</p>
                                                @endswitch
                                            </td>

                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $element['name'] }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $element['description'] }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $element['date'] }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if(isset($element['image']) && $element['image'])
                                                <img src="{{ asset($element->image) }}" alt="{{ $element['name'] }}" class="w-12 h-12 rounded-full">
                                            
                                            @else
                                                <img src="{{ asset('images/default.png') }}" alt="Default Image" class="w-12 h-12 rounded-full">
                                            @endif
                                        </td>
                                        

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-app-layout>