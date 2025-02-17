<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Proyección de Sueldos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/proyecciondesueldo.js'])

</head>

<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    @include('layouts.navigation')
    <div class="text-center text-black dark:text-white my-4 sm:my-6">
        <h1 class="text-4xl font-semibold antialiased">Proyección de Sueldos</h1>
    </div>
    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Barra lateral -->
        <div class="w-full lg:w-1/4 bg-white rounded-lg shadow-md dark:bg-gray-800 p-4">
            @include('descripciones.menu')
        </div>
        <div class="container mx-auto my-4 px-4 sm:px-6 lg:px-8">
            <!-- Formulario de Proyecciones -->
            {{-- <form action="{{ route('proyecciones.store') }}" method="POST">
            @csrf --}}
            <div class="overflow-x-auto">
                <table
                    class="min-w-full bg-white dark:bg-gray-800 shadow rounded mb-4 border border-black dark:border-gray-600">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 border border-black dark:border-gray-600">
                            <th class="px-4 py-2 text-left border border-black dark:border-gray-600">Puesto</th>
                            <th class="px-4 py-2 text-left border border-black dark:border-gray-600">Número de
                                Trabajadores
                            </th>
                            <th class="px-4 py-2 text-left border border-black dark:border-gray-600">Salario</th>
                            <th class="px-4 py-2 text-left border border-black dark:border-gray-600">Total</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($arraydatos as $value)
                            <tr idactual="{{ $value[4] }}" class="border border-black dark:border-gray-600">
                                <td valorid="{{ $value[0] }}"
                                    class="border px-4 py-2 border-black dark:border-gray-600">{{ $value[1] }}
                                </td>
                                <td class="border px-4 py-2 border-black dark:border-gray-600">{{ $value[2] }}
                                </td>
                                <td class="border px-4 py-2 border-black dark:border-gray-600"><input type="number"
                                        value="{{ $value[3] }}">
                                </td>
                                <td class="border px-4 py-2 border-black dark:border-gray-600">
                                    {{ sprintf('%.2f', $value[2] * $value[3]) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td id="totaldesueldos" class="text-right" colspan="4">Total de Sueldos:
                                {{ number_format($totaldelossueldos, 2, '.', '') }}

                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- Botón Guardar -->
            <div class="text-center">
                <button informacion="{{ $haydatosanules }}" ruta="{{ $ruta }}" id="botonguardar" type="button"
                    class="bg-blue-500 text-white px-6 py-2 rounded">Guardar</button>
            </div>

            {{-- </form> --}}
        </div>
</body>

</html>
