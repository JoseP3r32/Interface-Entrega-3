    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Elementos del Usuario</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3eaf8; /* Fondo lavanda claro */
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #967bb6; /* Lavanda más oscuro */
        }
        .header h1 {
            margin: 0;
            color: #967bb6; /* Lavanda más oscuro */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #e1d7ed; /* Borde lavanda */
            padding: 10px 15px;
            text-align: center;
        }
        th {
            background-color: #d6c0e6; /* Cabecera lavanda */
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f7f2fa; /* Fila lavanda alterna */
        }
        .imagen {
            width: 70px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .no-image {
            font-style: italic;
            color: #999;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 0.8em;
            color: #666;
        }
    </style>
        </head>
        <body>
            <div class="header">
                <h1>{{ $user->name . ' - ' . $user->email }}</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elements as $element)
                        <tr>
                            <td>
                                @switch($element->type)
                                    @case('mood')
                                        Estado de Ánimo
                                        @break
                                    @case('emotion')
                                        Emoción
                                        @break
                                    @case('event')
                                        Evento
                                        @break
                                    @default
                                        {{ $element->type }}
                                @endswitch
                            </td>
                            <td>
                            @if ($element->image)
                                <img src="{{$element->image }}" class="imagen" alt="Element Image"/>
                                @else
                                <span>Imagen no disponible</span>
                            @endif
                            </td>
                            <td>{{ $element->name }}</td>
                            <td>{{ $element->description}}</td>
                            <td>{{ $element['date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="footer">
                Generado el {{ date('d-m-Y') }}
            </div>

</body>
</html>