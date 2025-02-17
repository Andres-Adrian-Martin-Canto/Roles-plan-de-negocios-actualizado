<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyección Anual</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/proyeccionsueldoanual.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    @include('layouts.navigation')

    <div class="container mx-auto p-2 max-w-full">
        <h1 class="text-4xl font-bold mb-6 text-center">Proyección Anual</h1>

        <div class="flex flex-col lg:flex-row justify-start gap-2">
            <!-- Barra lateral -->
            <div class="w-full lg:w-1/6 bg-white rounded-md shadow-sm dark:bg-gray-800 p-1">
                @include('descripciones.menu')
            </div>

            <!-- Tabla de Proyección Anual -->
            <div class="w-full lg:w-4/4">
                <div class="overflow-x-auto p-1">
                    <table class="table-auto w-full text-xs bg-white dark:bg-gray-800 border dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="px-2 py-1 border dark:border-gray-600">Puesto</th>
                                {{-- <th class="px-2 py-1 border dark:border-gray-600">Núm. Trabajadores</th> --}}
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 1</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 2</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 3</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 4</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 5</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 6</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 7</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 8</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 9</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 10</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 11</th>
                                <th class="px-2 py-1 border dark:border-gray-600">Mes 12</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arraydatosanuales as $iddescripciondepuesto => $itemsdescripciondepuesto)
                                @foreach ($itemsdescripciondepuesto as $nombrePertenece => $datosanuales)
                                    <tr>
                                        <td class="border" width="15%" id_pertenece="{{ $iddescripciondepuesto }}">
                                            {{ $nombrePertenece }}</td>

                                        @foreach ($datosanuales as $item)
                                            <td class="border" width="7%" id_actual={{ $item['id_anual'] }}>
                                                <input type="number"
                                                    class="w-full border text-black rounded-sm text-xs px-0 text-right"
                                                    value="{{ $item['monto'] }}">
                                            </td>
                                        @endforeach

                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr id="totales" class="bg-gray-200 dark:bg-gray-700">
                                <th class="px-2 py-1 border dark:border-gray-600">Total Sueldos: </th>
                                {{-- <th class="px-2 py-1 border dark:border-gray-600">Núm. Trabajadores</th> --}}
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                                <th class="px-2 py-1 border dark:border-gray-600"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <button ruta="{{$ruta}}" id="botonguardar" type="button"
                    class="bg-blue-500 text-white px-6 py-2 rounded">Guardar</button>
            </div>
        </div>
    </div>
</body>

</html>
