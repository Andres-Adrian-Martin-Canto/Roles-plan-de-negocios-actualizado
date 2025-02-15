<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Descripción de Puesto</title>
    @vite(['resources/css/app.css', 'resources/js/editarDescripcionPuesto.js', 'resources/js/cerrarVentanaMensaje.js'])
</head>

<body class="bg-gray-600">
    <!-- Barra de navegación -->
    @include('layouts.navigation')
    @if (session('mensaje'))
        <div class="relative z-10" id="toast-warning" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                                        Advertencia</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">{{ session('mensaje') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" id="cerrarMensaje"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Encabezado -->
    <div class="text-center text-white my-4 sm:my-6 ml-4 sm:ml-8 md:ml-16 lg:ml-32">
        <h1 class="text-3xl md:text-4xl font-bold mx-auto">Editar Descripción de Puesto</h1>
    </div>
    <!-- Contenedor principal -->
    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Barra lateral -->
        <div class="w-full lg:w-1/6 bg-gray-900 rounded-lg shadow-md  p-2">
            @include('descripciones.menu')
        </div>
        <div class="container mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <main class="w-full rounded-lg shadow-md bg-gray-900 p-2">
                <!-- Formulario -->
                <form action="{{ route('plan_de_negocio.descripciones.update', [$plan_de_negocio, $descripcion]) }}"
                    method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- TODO: Selector para ver cual se debe mostrar --}}
                    <!-- div 1 -->
                    <div class="mb-4 flex flex-col sm:flex-row gap-4  justify-center">
                        <div class="flex  w-full sm:w-auto">
                            <label for="nivel"
                                class="border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none font-bold">Nivel
                                Organigrama</label>
                            <select id="nivel" name="nivel"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto rounded-l-none"
                                required>
                                <option value="Estrategico"
                                    {{ $descripcion->nivel == 'Estrategico' ? 'selected' : '' }}>
                                    Estratégico</option>
                                <option value="Tactico" {{ $descripcion->nivel == 'Tactico' ? 'selected' : '' }}>Táctico
                                </option>
                                <option value="Operativo" {{ $descripcion->nivel == 'Operativo' ? 'selected' : '' }}>
                                    Operativo
                                </option>
                            </select>
                        </div>

                        <div class="flex w-full sm:w-auto">
                            <label for="codigo"
                                class="border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none font-bold">Código</label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto rounded-l-none"
                                name="codigo" id="codigo" value="{{ $descripcion->codigo }}">
                        </div>
                    </div>

                    <!-- div 2 -->
                    <div class="mb-4 flex flex-col sm:flex-row gap-4 ">
                        <!-- Unidad Administrativa -->
                        <div class="flex w-full sm:w-1/2">
                            <label for="unidad_administrativa"
                                class="border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none font-bold">
                                Unidad Administrativa:
                            </label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto rounded-l-none"
                                name="unidad_administrativa" id="unidad_administrativa"
                                value="{{ $descripcion->unidad_administrativa }}" required>
                        </div>
                        <!-- Nombre de Puesto -->
                        <div class="flex w-full sm:w-1/2">
                            <label for="nombre_puesto"
                                class="border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none font-bold">
                                Nombre de Puesto:
                            </label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto rounded-l-none"
                                name="nombre_puesto" id="nombre_puesto" value="{{ $descripcion->nombre_puesto }}"
                                required>
                        </div>
                    </div>
                    <!-- Descripción Genérica-->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="descripcion_generica"
                            class="block sm:w-1/6 border-gray-300 font-bold bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 text-gray-950">Descripción
                            Genérica:</label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="descripcion_generica" id="descripcion_generica" rows="3" required>{{ $descripcion->descripcion_generica }}</textarea>
                    </div>
                    <!-- Descripción Específica -->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="descripcion_especifica"
                            class="block sm:w-1/6 border-gray-300 font-bold bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 text-gray-950">
                            Descripción Específica:
                        </label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="descripcion_especifica" id="descripcion_especifica" rows="3" required>{{ $descripcion->descripcion_especifica }}</textarea>
                    </div>

                    <!-- Objetivos del Puesto -->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="objetivos_puesto"
                            class="block sm:w-1/6 border-gray-300 font-bold bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 text-gray-950">
                            Objetivos del Puesto:
                        </label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="objetivos_puesto" id="objetivos_puesto" rows="3" required>{{ $descripcion->objetivos_puesto }}</textarea>
                    </div>
                    <!-- div 3 -->
                    <div class="mb-4 flex flex-wrap gap-2 justify-center">
                        <!-- Salario Mínimo -->
                        <div class="flex w-full sm:w-1/4">
                            <label for="salario_minimo"
                                class="block border-gray-300 font-bold bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none">
                                Salario Mínimo:
                            </label>
                            <input type="number"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 rounded-l-none"
                                name="salario_minimo" id="salario_minimo" value="{{ $descripcion->salario_minimo }}"
                                step="0.01" required>
                        </div>
                        <!-- Salario Máximo -->
                        <div class="flex w-full sm:w-1/3">
                            <label for="salario_maximo"
                                class="block border-gray-300 font-bold bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none">
                                Salario Máximo:
                            </label>
                            <input type="number"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 rounded-l-none"
                                name="salario_maximo" id="salario_maximo" value="{{ $descripcion->salario_maximo }}"
                                step="0.01" required>
                        </div>
                        <!-- Número de Plaza -->
                        <div class="flex w-full sm:w-1/3">
                            <label for="numero_plaza"
                                class="block border-gray-300 font-bold bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none">
                                Número de Plaza:
                            </label>
                            <input type="number"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 rounded-l-none"
                                name="numero_plaza" id="numero_plaza" value="{{ $descripcion->numero_plaza }}"
                                required>
                        </div>
                    </div>

                    <div class="mb-4 flex flex-col sm:flex-row">
                        <!-- Etiqueta -->
                        <label for="jornada_laboral"
                            class="block w-full sm:w-1/6 border-gray-300 font-bold bg-gray-200 p-2 text-gray-950  sm:text-left rounded-t sm:rounded-l-lg rounded-r-none">
                            Jornada Laboral:
                        </label>
                        <!-- Select -->
                        <input type="text"
                            class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 rounded-l-none"
                            name="jornada_laboral" id="jornada_laboral" value="{{ $descripcion->jornada_laboral }}"
                            required>
                    </div>

                    {{-- TODO: Selectores para reportar --}}
                    <div class="mb-4 flex flex-col sm:flex-row" id="reporta">
                        <label for="reporta_a"
                            class="block w-full sm:w-1/6 border-gray-300 bg-gray-200 p-2 font-bold text-gray-950  sm:text-left rounded-t sm:rounded-l-lg rounded-r-none">Reporta
                            a</label>

                        {{-- TODO: Selector para estrategico --}}
                        <select
                            class="block w-full sm:flex-grow border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 rounded-b sm:rounded-r-lg "
                            id="reporta_a2" name="reporta_a">
                            <option value=""></option>
                        </select>

                        {{-- TODO: Selector para tactico --}}
                        <select class="w-full border-gray-300 rounded-md shadow-sm" id="reporta_a1" name="reporta_a">
                            <option value="" disabled selected>Seleccione una opción</option>
                            @foreach ($estrategicos as $estrategico)
                                <option value="{{ $estrategico->id }}"
                                    {{ $descripcion->reporta_a === $estrategico->id ? 'selected' : '' }}>
                                    {{ $estrategico->unidad_administrativa }}
                                </option>
                            @endforeach
                        </select>

                        {{-- TODO: Selector para operativo --}}
                        <select class="w-full text-gray-950 border-gray-300 rounded-md shadow-sm" id="reporta_adad"
                            name="reporta_a">
                            <option value="" disabled selected>Seleccione una opción</option>
                            @foreach ($tactico as $tacticos)
                                <option value="{{ $tacticos->id }}"
                                    {{ $descripcion->reporta_a === $tacticos->id ? 'selected' : '' }}>
                                    {{ $tacticos->unidad_administrativa }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- TODO: FIN DE LOS SELECTORES REPORTAR --}}



                    {{-- TODO: Selector de supervisa a  --}}
                    <div class="mb-4 flex flex-col space-y-4" id="divSupervisa">

                        {{-- TODO: Div donde esta el checkbox --}}
                        <div class=" flex flex-col sm:flex-row">

                            {{-- TODO: Mensaje de supervisa_a --}}
                            <label for="supervisa_a"
                                class="block w-full sm:w-1/4  border-gray-300 bg-gray-200 font-bold rounded-lg p-2 text-gray-950 text-center sm:text-left sm:rounded-r-none">
                                Supervisa a:
                            </label>

                            {{-- TODO: div para los estrategicos --}}
                            <div class="relative w-full sm:w-3/4 " id="supervisaSelectorEstrategico">
                                <!-- Botón -->
                                <button id="toggleButton" type="button"
                                    class="w-full bg-gray-100  border-gray-300 rounded-lg shadow-md px-5 py-3 text-left  text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out min-h-[50px]">
                                    {{-- TODO: Aqui deben aparecer los nombre de los seleccionados. --}}
                                    <span id="nombresSeleccionadosEstrategicos">
                                        @php
                                            $selectedOptions = [];
                                            foreach ($tactico as $tactico1) {
                                                if (
                                                    in_array(
                                                        $tactico1->id,
                                                        json_decode($descripcion->supervisa_a, true),
                                                    )
                                                ) {
                                                    $selectedOptions[] = $tactico1->unidad_administrativa;
                                                }
                                            }
                                            echo implode(', ', $selectedOptions);
                                        @endphp
                                    </span>

                                    <span
                                        class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-500">&#x25BC;</span>
                                </button>

                                <!-- Lista de Opciones -->
                                <div id="optionsContainer"
                                    class="absolute  mt-1 w-full bg-white shadow-lg rounded-md border border-gray-300 z-10 hidden">
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($tactico as $tactico1)
                                            <li class="flex items-center px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                                onclick="toggleOption('{{ $tactico1->id }}', '{{ addslashes($tactico1->unidad_administrativa) }}')">
                                                <input type="checkbox" id="option-{{ $tactico1->id }}"
                                                    value="{{ $tactico1->id }}" class="mr-2"
                                                    {{ in_array($tactico1->id, json_decode($descripcion->supervisa_a, true)) ? 'checked' : '' }}
                                                    onclick="handleCheckboxClick(event, '{{ $tactico1->id }}' , '{{ addslashes($tactico1->unidad_administrativa) }}', this)">
                                                {{ $tactico1->unidad_administrativa }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>


                            {{-- TODO: div para los tacticos --}}
                            <div class="relative w-full sm:w-3/4" id="supervisaSelectorTactico">
                                <!-- Botón -->
                                <button id="toggleButtonTacticos" type="button"
                                    class="w-full bg-gray-100  border-gray-300 rounded-lg shadow-md px-5 py-3 text-left text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out min-h-[50px]">
                                    {{-- TODO: Aqui deben aparecer los nombre de los seleccionados. --}}
                                    <span id="nombresSeleccionadosTacticos">
                                        @php
                                            $selectedOptions = [];
                                            foreach ($operativo as $operativo1) {
                                                if (
                                                    in_array(
                                                        $operativo1->id,
                                                        json_decode($descripcion->supervisa_a, true),
                                                    )
                                                ) {
                                                    $selectedOptions[] = $operativo1->unidad_administrativa;
                                                }
                                            }
                                            echo implode(', ', $selectedOptions);
                                        @endphp
                                    </span>

                                    <span
                                        class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-500">&#x25BC;</span>
                                </button>

                                <!-- Lista de Opciones -->
                                <div id="optionsContainerTacticos"
                                    class="absolute mt-1 w-full bg-white shadow-lg rounded-md border border-gray-300 z-10 hidden">
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($operativo as $operativo1)
                                            <li class="flex items-center px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                                onclick="toggleOption('{{ $operativo1->id }}', '{{ addslashes($operativo1->unidad_administrativa) }}')">
                                                <input type="checkbox" id="option-{{ $operativo1->id }}"
                                                    value="{{ $operativo1->unidad_administrativa }}" class="mr-2"
                                                    {{ in_array($operativo1->id, json_decode($descripcion->supervisa_a, true)) ? 'checked' : '' }}
                                                    onclick="handleCheckboxClick(event, '{{ $operativo1->id }}' , '{{ addslashes($operativo1->unidad_administrativa) }}', this)">
                                                {{ $operativo1->unidad_administrativa }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>


                            {{-- TODO: div para los operativos --}}
                            <div class="relative w-full sm:w-3/4" id="supervisaSelectorOperativo">
                                {{-- Botón --}}
                                <button id="" type="button"
                                    class="w-full bg-gray-100  border-gray-300 rounded-lg shadow-md px-5 py-3 text-left text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out min-h-[50px]">
                                    {{-- TODO: Aqui deben aparecer los nombre de los seleccionados. --}}
                                    <span id="nombresSeleccionadoOperativos">

                                    </span>

                                    <span
                                        class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-500">&#x25BC;</span>
                                </button>

                                {{-- Lista de Opciones  --}}
                                <div id="OptionContainerOperativos"
                                    class="absolute mt-1 w-full bg-white shadow-lg rounded-md border border-gray-300 z-10 hidden">
                                    <ul class="divide-y divide-gray-200">
                                    </ul>
                                </div>
                            </div>
                        </div>


                        {{-- TODO: Campo oculto para enviar los valores seleccionados como array --}}
                        <div id="datosEnviados">
                            @foreach ($tactico as $tactico1)
                                @if (in_array($tactico1->id, json_decode($descripcion->supervisa_a, true)))
                                    <input type="hidden" name="supervisa_a[]" value="{{ $tactico1->id }}">
                                @endif
                            @endforeach

                            {{-- TODO: For each para operativos --}}
                            @foreach ($operativo as $operativo1)
                                @if (in_array($operativo1->id, json_decode($descripcion->supervisa_a, true)))
                                    <input type="hidden" name="supervisa_a[]" value="{{ $operativo1->id }}">
                                @endif
                            @endforeach
                        </div>


                        {{-- TODO: Tabla para mostrar los seleccionados de Estrategicos --}}
                        <div class="w-full mt-4 overflow-x-auto" id="tablaEstrategicos">
                            <table
                                class="w-full border-collapse border border-gray-300 bg-gray-100 rounded-lg shadow-md">
                                <thead>
                                    <tr class="bg-gray-300">
                                        <th class="border border-gray-400 px-4 py-2 text-left">Unidad
                                            Administrativa
                                        </th>
                                        <th class="border border-gray-400 px-4 py-2 text-left">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $selectedOptions = json_decode($descripcion->supervisa_a, true);
                                    @endphp
                                    @if (!empty($selectedOptions))
                                        @foreach ($tactico as $tactico1)
                                            @if (in_array($tactico1->id, $selectedOptions))
                                                <tr class="bg-white hover:bg-gray-50">
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        {{ $tactico1->unidad_administrativa }}</td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <button type="button" class="text-red-500 hover:text-red-700"
                                                            id="button{{ $tactico1->id }}"
                                                            onclick="removeOption('{{ $tactico1->id }}' , '{{ addslashes($tactico1->unidad_administrativa) }}')">
                                                            Eliminar
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2"
                                                class="border border-gray-300 px-4 py-2  text-gray-500 text-center">
                                                No hay datos
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>


                        {{-- TODO: Tabla para mostrar los seleccionados de TACTICOS --}}
                        <div class="w-full mt-4 overflow-x-auto" id="tablaTacticos">
                            <table
                                class="w-full border-collapse border border-gray-300 bg-gray-100 rounded-lg shadow-md">
                                <thead>
                                    <tr class="bg-gray-300">
                                        <th class="border border-gray-400 px-4 py-2 text-left">Unidad
                                            Administrativa
                                        </th>
                                        <th class="border border-gray-400 px-4 py-2 text-left">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $selectedOptions = json_decode($descripcion->supervisa_a, true);
                                    @endphp
                                    @foreach ($operativo as $operativo1)
                                        @if (in_array($operativo1->id, $selectedOptions))
                                            <tr class="bg-white hover:bg-gray-50">
                                                <td class="border border-gray-300 px-4 py-2">
                                                    {{ $operativo1->unidad_administrativa }}</td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <button type="button" class="text-red-500 hover:text-red-700"
                                                        id="button{{ $operativo1->id }}"
                                                        onclick="removeOption('{{ $operativo1->id }}' , '{{ addslashes($operativo1->unidad_administrativa) }}')">
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{-- TODO: Tabla para mostrar los seleccionados de TACTICOS --}}
                        <div class="w-full mt-4 overflow-x-auto" id="tablaOperativos">
                            <table
                                class="w-full border-collapse border border-gray-300 bg-gray-100 rounded-lg shadow-md">
                                <thead>
                                    <tr class="bg-gray-300">
                                        <th class="border border-gray-400 px-4 py-2 text-left">Unidad
                                            Administrativa
                                        </th>
                                        <th class="border border-gray-400 px-4 py-2 text-left">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>


                    </div>

                    {{-- TODO: FIN DE LOS SELECTORES SUPERVISA A --}}

                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="comunicacion_interna"
                            class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Comunicación
                            Interna: </label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="comunicacion_interna" id="comunicacion_interna" rows="2" required>{{ $descripcion->comunicacion_interna }}</textarea>
                    </div>

                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="comunicacion_externa"
                            class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Comunicación
                            Externa:</label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="comunicacion_externa" id="comunicacion_externa" rows="2" required>{{ $descripcion->comunicacion_externa }}</textarea>
                    </div>

                    {{-- DIV 4 --}}
                    <div class="mb-4 flex flex-wrap gap-2 justify-center">
                        <div class="flex w-full sm:w-1/4">
                            <label for="estado_civil"
                                class="block border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950  sm:w-auto font-bold rounded-r-none">Estado
                                Civil:</label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500  rounded-l-none"
                                name="estado_civil" value="{{ $descripcion->estado_civil }}" id="estado_civil"
                                required>
                        </div>
                        {{-- edad --}}
                        <div class="flex w-full sm:w-1/3">
                            <label for="edad"
                                class="block border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950  sm:w-auto  font-bold rounded-r-none">Edad:</label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 rounded-l-none"
                                name="edad" id="edad" value="{{ $descripcion->edad }}" required>
                        </div>
                        {{-- genero --}}
                        <div class="flex w-full sm:w-1/3">
                            <label for="genero"
                                class="block border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950  sm:w-auto font-bold rounded-r-none">Género:</label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 rounded-l-none"
                                name="genero" id="genero" value="{{ $descripcion->genero }}" required>
                        </div>
                    </div>
                        <div class="mb-4 flex flex-col sm:flex-row">
                            <label for="requisitos_generales"
                                class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Requisitos
                                Generales:</label>
                            <textarea
                                class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm  focus:border-blue-500 focus:ring-blue-500 "
                                name="requisitos_generales" id="requisitos_generales" rows="3" required>{{ $descripcion->requisitos_generales }}</textarea>
                        </div>

                        <div class="mb-4 flex flex-col sm:flex-row">
                            <label for="habilidades_fisicas"
                                class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Habilidades
                                Físicas:</label>
                            <textarea
                                class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm  focus:border-blue-500 focus:ring-blue-500 "
                                name="habilidades_fisicas" id="habilidades_fisicas" rows="3" required>{{ $descripcion->habilidades_fisicas }}</textarea>
                        </div>

                        <div class="mb-4 flex flex-col sm:flex-row">
                            <label for="habilidades_mentales"
                                class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Habilidades
                                Mentales:</label>
                            <textarea
                                class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                                name="habilidades_mentales" id="habilidades_mentales" rows="3" required>{{ $descripcion->habilidades_mentales }}</textarea>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-green-700 px-3 py-2 rounded-md text-sm font-bold hover:bg-green-500 transition text-white">
                                Guardar
                            </button>
                        </div>
                </form>
            </main>
        </div>
</body>

</html>
