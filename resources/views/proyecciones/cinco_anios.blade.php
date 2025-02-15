<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyección A Cinco Años</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/proyeccionsueldocincoanios.js'])
</head>

<body class="bg-gray-600">
    @include('layouts.navigation')

    <div class="text-center text-white my-4 sm:my-6 ml-4 sm:ml-8 md:ml-16 lg:ml-32">
        <h1 class="text-3xl md:text-4xl font-bold mx-auto">Proyección A Cinco Años.</h1>
    </div>

    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Barra lateral -->
        <div class="w-full lg:w-1/6  rounded-lg shadow-md bg-gray-900 p-2">
            @include('descripciones.menu')
        </div>
        <!-- Tabla de Proyección Anual -->
        <div class="w-full lg:w-4/4">
            <div class="overflow-x-auto p-1">
                <table class="table-auto w-full text-xs bg-gray-800 border">
                    <thead>
                        <tr class="bg-slate-800">
                            <th class="px-2 py-1 border border-black text-left text-white">Puesto</th>
                            <th class="px-2 py-1 border border-black text-right text-white">Año 1</th>
                            <th class="px-2 py-1 border border-black text-right text-white">Año 2</th>
                            <th class="px-2 py-1 border border-black text-right text-white">Año 3</th>
                            <th class="px-2 py-1 border border-black text-right text-white">Año 4</th>
                            <th class="px-2 py-1 border border-black text-left text-white">Año 5</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arraydatoscincoanios as $iddescripciondepuesto => $itemsdescripciondepuesto)
                            @foreach ($itemsdescripciondepuesto as $nombrePertenece => $datosanuales)
                                <tr>
                                    <td class="px-2 py-1 border odd:bg-gray-600   text-white font-medium border-black "
                                        width="15%" id_pertenece="{{ $iddescripciondepuesto }}">
                                        {{ $nombrePertenece }}</td>
                                    @if (count($datosanuales) > 1)
                                        @foreach ($datosanuales as $item)
                                            <td class="border border-gray-600" width="7%"
                                                id_actual={{ $item['id_anual'] }}>
                                                <input type="number"
                                                    class="w-full border border-black text-black rounded-sm text-xs px-0 text-right"
                                                    value="{{ $item['monto'] }}">
                                            </td>
                                        @endforeach
                                    @else
                                        @foreach ($datosanuales as $item)
                                            @for ($i = 0; $i < 5; $i++)
                                                <td class="border border-gray-600 " width="7%"
                                                    id_actual={{ $item['id_anual'] }}>
                                                    <input type="number"
                                                        class="w-full border border-black text-black rounded-sm text-xs px-0 text-right"
                                                        value="{{ $item['monto'] }}">
                                                </td>
                                            @endfor
                                        @endforeach
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr id="totales" class="bg-gray-800 text-right">
                            <th class="px-2 py-1 border border-black text-white">Total Sueldos: </th>
                            <th class="px-2 py-1 border border-black text-white"></th>
                            <th class="px-2 py-1 border border-black text-white"></th>
                            <th class="px-2 py-1 border border-black text-white"></th>
                            <th class="px-2 py-1 border border-black text-white"></th>
                            <th class="px-2 py-1 border border-black text-white"></th>
                        <tr id="sumatotal" class="bg-gray-800">
                            <!-- Celdas vacías para dejar espacio -->
                            <th colspan="5" class="px-2 py-1 border border-black text-white text-right">
                                Total Sueldos:
                            </th>
                            <!-- Celda para el total -->
                            <th class="px-2 py-1 border border-black text-white text-right" id="total-general">
                                $0.00
                            </th>
                        </tr>
                        </tr>
                    </tfoot>
                </table>
                <div class="flex justify-center   px-10 py-2 items-center ml-4 sm:ml-[5%]">
                    <button ruta="{{ $ruta }}" id="botonguardar" type="button"
                        class=" text-white px-6 py-2 rounded hover:border-green-600  text-center text-xl bg-green-700 border-green-600 hover:bg-green-800">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
