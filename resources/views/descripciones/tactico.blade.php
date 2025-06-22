<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Descripción de Puesto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/cerrarVentanaMensaje.js'])
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

    <!-- Contenedor principal -->
    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Contenido principal -->
        <!-- Barra lateral -->
        <div class="w-full lg:w-1/6 bg-gray-900 rounded-lg shadow-md  p-2">
            @include('descripciones.menu')
        </div>
        <div class="container mx-auto sm:px-6 lg:px-8">
            <main class="w-full  rounded-lg shadow-md bg-gray-900 p-2">
                <div class="text-center text-white my-4 ml-4 sm:ml-8 md:ml-16 lg:ml-32">
                    <h1 class="text-3xl md:text-4xl font-bold mx-auto">Descripción de Puesto.</h1>
                </div>
                <!-- Formulario -->
                <form action="{{ route('plan_de_negocio.descripciones.store', $plan_de_negocio) }}" method="POST">
                    @csrf

                    <div class="mb-4 flex flex-col sm:flex-row gap-4  justify-center">
                        <!-- Nivel Organigrama -->
                        <div class="flex  w-full sm:w-auto">
                            <label for="nivel"
                                class="border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none font-bold">Nivel
                                Organigrama</label>
                            <select
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto rounded-l-none"
                                name="nivel" id="nivel" required>
                                <option value="Tactico">Táctico</option>
                                <option value="Operativo">Operativo</option>
                                <option value="Estrategico">Estratégico</option>
                            </select>
                        </div>

                        <script>
                            document.getElementById('nivel').addEventListener('change', function() {
                                const selectedValue = this.value.toLowerCase();
                                const routes = {
                                    estrategico: "{{ route('plan_de_negocio.descripciones.create', $plan_de_negocio) }}",
                                    tactico: "{{ route('plan_de_negocio.tactico.index', $plan_de_negocio) }}",
                                    operativo: "{{ route('plan_de_negocio.operativo.index', $plan_de_negocio) }}"
                                };

                                // Verifica si hay una ruta para el valor seleccionado y redirige
                                if (routes[selectedValue]) {
                                    window.location.href = routes[selectedValue];
                                }
                            });
                        </script>


                        <div class="flex w-full sm:w-auto">
                            <label for="codigo"
                                class="border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none font-bold">
                                Código:
                            </label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto rounded-l-none"
                                name="codigo" id="codigo" value="{{ old('codigo') }}" required>
                        </div>

                        <!-- Mensaje de código duplicado -->
                        @if (session('codigoDuplicado'))
                            <div
                                class="text-red-700 bg-red-100 border border-red-400 p-2 rounded-lg  w-full sm:w-auto text-sm ">
                                <strong>¡Error!</strong> El código ingresado ya existe. Por favor, ingresa un código
                                diferente.
                            </div>
                        @endif
                    </div>

                    <!-- div 2 -->
                    <!-- Fila responsiva: Unidad Administrativa, Nombre de Puesto, Otros nombres del puesto -->
                    <div class="mb-4 flex flex-col sm:flex-row gap-4">

                        <!-- Unidad Administrativa -->
                        <div class="flex flex-col sm:flex-row w-full sm:w-1/3">
                            <label for="unidad_administrativa"
                                class="border-gray-300 bg-gray-200 p-2 text-gray-950 font-bold rounded-t sm:rounded-l-lg sm:rounded-tr-none">
                                Unidad Administrativa:
                            </label>
                            <textarea
                                class="border-gray-300 rounded-b sm:rounded-r-lg sm:rounded-bl-none shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full resize-y min-h-[2.5rem]"
                                name="jornada_laboral" id="jornada_laboral" required>{{ old('unidad_administrativa') }}</textarea>

                        </div>

                        <!-- Nombre de Puesto -->
                        <div class="flex flex-col sm:flex-row w-full sm:w-1/3">
                            <label for="nombre_puesto"
                                class="border-gray-300 bg-gray-200 p-2 text-gray-950 font-bold rounded-t sm:rounded-l-lg sm:rounded-tr-none">
                                Nombre de Puesto:
                            </label>
                            <textarea
                                class="border-gray-300 rounded-b sm:rounded-r-lg sm:rounded-bl-none shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full resize-y min-h-[2.5rem]"
                                name="jornada_laboral" id="jornada_laboral" required>{{ old('nombre_puesto') }}</textarea>

                        </div>

                        <!-- Otros nombres del puesto -->
                        <div class="flex flex-col sm:flex-row w-full sm:w-1/3">
                            <label for="jornada_laboral"
                                class="border-gray-300 bg-gray-200 p-2 text-gray-950 font-bold rounded-t sm:rounded-l-lg sm:rounded-tr-none">
                                Otros nombres del puesto:
                            </label>
                            <textarea
                                class="border-gray-300 rounded-b sm:rounded-r-lg sm:rounded-bl-none shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full resize-y min-h-[2.5rem]"
                                name="jornada_laboral" id="jornada_laboral" required>{{ old('otros_nombres_del_puesto') }}</textarea>
                        </div>

                    </div>
                    <!-- Fila: Número de Plaza, Jornada Laboral, Otra Jornada -->
                    <div class="mb-4 flex flex-col sm:flex-row gap-4">
                        <!-- Número de Plaza -->
                        <div class="flex flex-1">
                            <label for="numero_plaza"
                                class="flex items-center justify-center w-40 bg-gray-200 border border-gray-300 text-gray-950 font-bold rounded-l-lg p-2">
                                Número de Plaza:
                            </label>
                            <input type="number" name="numero_plaza" id="numero_plaza"
                                class="border border-gray-300 rounded-r-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full p-2"
                                value="{{ old('numero_plaza') }}" required>
                        </div>

                        <!-- Jornada Laboral -->
                        <div class="flex flex-1">
                            <label for="jornada_laboral"
                                class="flex items-center justify-center w-40 bg-gray-200 border border-gray-300 text-gray-950 font-bold rounded-l-lg p-2">
                                Jornada Laboral:
                            </label>
                            <select name="jornada_laboral" id="jornada_laboral"
                                class="border border-gray-300 rounded-r-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full p-2"
                                required>
                                <option value="">Selecciona una opción</option>
                                <option value="normal" {{ old('jornada_laboral') == 'normal' ? 'selected' : '' }}>
                                    Normal (7 días, 1 descanso)
                                </option>
                                <option value="inglesa" {{ old('jornada_laboral') == 'inglesa' ? 'selected' : '' }}>
                                    Inglesa (5 días, 2 descansos)
                                </option>
                                <option value="otros" {{ old('jornada_laboral') == 'otros' ? 'selected' : '' }}>
                                    Otros
                                </option>
                            </select>
                        </div>

                        <!-- Otra Jornada Laboral -->
                        <div class="flex flex-1">
                            <label for="semana_otro"
                                class="flex items-center justify-center w-40 bg-gray-200 border border-gray-300 text-gray-950 font-bold rounded-l-lg p-2">
                                Otra Jornada:
                            </label>
                            <input type="text" name="semana_otro" id="semana_otro"
                                class="border border-gray-300 rounded-r-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full p-2"
                                value="{{ old('semana_otro') }}">
                        </div>
                    </div>


                    <div class="mb-4 flex flex-col sm:flex-row gap-4">

                        <!-- Salario Mínimo -->
                        <div class="flex w-full sm:w-1/2">
                            <label for="salario_minimo"
                                class="border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none font-bold">
                                Salario Mínimo:
                            </label>
                            <input type="number" name="salario_minimo" id="salario_minimo"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto rounded-l-none"
                                value="{{ old('salario_minimo') }}" step="0.01" required>
                        </div>

                        <!-- Salario Máximo -->
                        <div class="flex w-full sm:w-1/2">
                            <label for="salario_maximo"
                                class="border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950 w-full sm:w-auto rounded-r-none font-bold">
                                Salario Máximo:
                            </label>
                            <input type="number" name="salario_maximo" id="salario_maximo"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto rounded-l-none"
                                value="{{ old('salario_maximo') }}" step="0.01" required>
                        </div>

                    </div>

                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="reporta_a"
                            class="block w-full sm:w-1/6 border-gray-300 bg-gray-200 p-2 font-bold text-gray-950  sm:text-left rounded-t sm:rounded-l-lg rounded-r-none">Reporta
                            a:</label>
                        <select name="reporta_a" id="reporta_a"
                            class="block w-full sm:flex-grow border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 rounded-b sm:rounded-r-lg ">

                            @foreach ($descripcionesEstrategicos as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->unidad_administrativa }}</option>
                            @endforeach
                        </select>
                    </div>


                    {{-- inicio --}}
                    <div class="mb-4 flex flex-col space-y-4" x-data="{
                        open: false,
                        selectedOptions: [],
                        toggleOption(value, text) {
                            if (this.selectedOptions.some(option => option.value === value)) {
                                this.selectedOptions = this.selectedOptions.filter(option => option.value !== value);
                            } else {
                                this.selectedOptions.push({ value, text });
                            }
                        },
                        isSelected(value) {
                            return this.selectedOptions.some(option => option.value === value);
                        }
                    }">
                        <div class=" flex flex-col sm:flex-row">
                            <label for="supervisa_a"
                                class="block w-full sm:w-1/4 border-gray-300 bg-gray-200 font-bold rounded-lg p-2 text-gray-950 text-center sm:text-left sm:rounded-r-none">
                                Supervisa a:
                            </label>
                            <div class="relative w-full sm:w-3/4">
                                <button @click="open = !open" type="button"
                                    class="w-full bg-gray-200 border border-gray-300 rounded-lg shadow-sm px-4 py-2 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:rounded-l-none rounded-t-lg ">
                                    <span
                                        x-text="selectedOptions.length > 0 ? selectedOptions.map(option => option.text).join(', ') : 'Seleccione...'">
                                    </span>
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-500">
                                        &#x25BC;
                                    </span>
                                </button>
                                <div x-show="open" @click.outside="open = false"
                                    class="absolute mt-1 w-full bg-white shadow-lg rounded-md border border-gray-300 z-10">
                                    <ul class="max-h-60 overflow-auto py-1 text-sm text-gray-700">
                                        @foreach ($operativos as $operativo)
                                            <li class="flex items-center px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                                @click="toggleOption('{{ $operativo->id }}', '{{ $operativo->unidad_administrativa }}')">
                                                <span class="mr-2">
                                                    <input type="checkbox"
                                                        :checked="isSelected('{{ $operativo->id }}')"
                                                        class="form-checkbox">
                                                </span>
                                                <span>{{ $operativo->unidad_administrativa }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Campo oculto para enviar los valores seleccionados como array -->
                        <template x-for="option in selectedOptions" :key="option.value">
                            <input type="hidden" name="supervisa_a[]" :value="option.value">
                        </template>

                        <!-- Tabla para mostrar los seleccionados con fondo -->
                        <div class="w-full mt-4">
                            <table
                                class="w-full border-collapse border border-gray-300 bg-gray-100 rounded-lg shadow-md">
                                <thead>
                                    <tr class="bg-gray-300">
                                        <th class="border border-gray-400 px-4 py-2 text-left">Unidad Administrativa
                                        </th>
                                        <th class="border border-gray-400 px-4 py-2 text-left">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="option in selectedOptions" :key="option.value">
                                        <tr class="bg-white hover:bg-gray-50">
                                            <td class="border border-gray-300 px-4 py-2" x-text="option.text"></td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <button type="button" class="text-red-500 hover:text-red-700"
                                                    @click="toggleOption(option.value, option.text)">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="selectedOptions.length === 0">
                                        <td colspan="2"
                                            class="border border-gray-300 px-4 py-2 text-gray-500 text-center">
                                            No hay opciones seleccionadas.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    {{-- fin --}}

                    {{-- final --}}

                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="comunicacion_interna"
                            class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Comunicación
                            Interna: </label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="comunicacion_interna" id="comunicacion_interna" rows="2" required>{{ old('comunicacion_interna') }} </textarea>
                    </div>

                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="comunicacion_externa"
                            class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Comunicación
                            Externa:</label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="comunicacion_externa" id="comunicacion_externa" rows="2" required>{{ old('comunicacion_externa') }}</textarea>
                    </div>
                    <!-- Objetivos del Puesto -->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="objetivos_puesto"
                            class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">
                            Objetivos del Puesto:</label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="objetivos_puesto" id="objetivos_puesto" rows="2" required>{{ old('objetivos_puesto') }}</textarea>
                    </div>
                    <!-- Descripción Genérica-->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="descripcion_generica"
                            class="block sm:w-1/6 border-gray-300 font-bold bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 text-gray-950">Descripción
                            genérica del puesto:</label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="descripcion_generica" id="descripcion_generica" rows="2" required>{{ old('descripcion_generica') }}</textarea>
                    </div>
                    <!-- Descripción Específica -->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="descripcion_especifica"
                            class="block sm:w-1/6 border-gray-300 font-bold bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 text-gray-950">
                            Descripción específica del puesto:
                        </label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="descripcion_especifica" id="descripcion_especifica" rows="2" required>{{ old('descripcion_especifica') }}</textarea>
                    </div>
                </form>
                <!-- codigo nuevo-->
                <form action="{{ route('plan_de_negocio.descripciones.store', $plan_de_negocio) }}" method="POST">
                    @csrf
                    <div class="text-center text-white my-4 sm:my-6 ml-4 sm:ml-8 md:ml-16 lg:ml-32">
                        <h1 class="text-3xl md:text-4xl font-bold mx-auto">Perfil de puestos.</h1>
                    </div>

                    <!-- Fila: Forma de pago,  -->
                    <div class="mb-4 flex flex-col sm:flex-row sm:gap-x-4 gap-y-4">
                        <!-- Forma de pago -->
                        <div class="flex flex-1">
                            <label for="forma_pago"
                                class="border border-gray-300 bg-gray-200 p-2 text-gray-950 font-bold rounded-l-lg w-40 flex items-center justify-center">
                                Forma de pago:
                            </label>
                            <select name="forma_pago" id="forma_pago"
                                class="border border-gray-300 rounded-r-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full">
                                <option value="">Selecciona una opción</option>
                                <option value="mensual" {{ old('forma_pago') == 'mensual' ? 'selected' : '' }}>Mensual
                                </option>
                                <option value="quincenal" {{ old('forma_pago') == 'quincenal' ? 'selected' : '' }}>
                                    Quincenal</option>
                                <option value="semanal" {{ old('forma_pago') == 'semanal' ? 'selected' : '' }}>Semanal
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Fila 1: Estado civil: y Edad: -->
                    <div class="mb-4 flex flex-col sm:flex-row gap-4">
                        <!-- Estado civil: -->
                        <div class="flex w-full sm:w-1/2">
                            <label for="nombre_empresa"
                                class="border-gray-300 bg-gray-200 p-2 text-gray-950 font-bold rounded-t sm:rounded-l-lg sm:rounded-tr-none">
                                Estado civil:
                            </label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full rounded-l-none"
                                name="nombre_empresa" id="nombre_empresa" value="{{ old('nombre_empresa') }}"
                                required>
                        </div>


                        <!-- Edad: -->
                        <div class="flex w-full sm:w-1/2">
                            <label for="edad"
                                class="border-gray-300 bg-gray-200 p-2 text-gray-950 font-bold rounded-t sm:rounded-l-lg sm:rounded-tr-none flex items-center justify-center text-center">
                                Edad:
                            </label>
                            <input type="text" name="edad" id="edad" value="{{ old('edad') }}"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full rounded-l-none"
                                required>
                        </div>
                    </div>

                    <!-- Fila 2:    Nacionalidad: y Sexo: -->
                    <div class="mb-4 flex flex-col sm:flex-row gap-4">
                        <!--    Nacionalidad:-->
                        <div class="flex w-full sm:w-1/2">
                            <label for="nombre_empresa"
                                class="border-gray-300 bg-gray-200 p-2 text-gray-950 font-bold rounded-t sm:rounded-l-lg sm:rounded-tr-none">
                                Nacionalidad:
                            </label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full rounded-l-none"
                                name="nombre_empresa" id="nombre_empresa" value="{{ old('nombre_empresa') }}"
                                required>
                        </div>

                        <!-- Sexo: -->
                        <div class="flex w-full sm:w-1/2">
                            <label for="nombre_puesto"
                                class="border-gray-300 bg-gray-200 p-2 text-gray-950 font-bold rounded-t sm:rounded-l-lg sm:rounded-tr-none">
                                Sexo:
                            </label>
                            <input type="text"
                                class="block flex-grow border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full rounded-l-none"
                                name="nombre_puesto" id="nombre_puesto" value="{{ old('nombre_puesto') }}" required>
                        </div>
                    </div>
                    <!-- Estatura (si aplica): -->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="objetivos_puesto"
                            class="block sm:w-1/6 border-gray-300 font-bold bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 text-gray-950">
                            Estatura. (si aplica):
                        </label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="objetivos_puesto" id="objetivos_puesto" rows="2" required>{{ old('objetivos_puesto') }}</textarea>
                    </div>

                    <!--Antecedentes: -->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="objetivos_puesto"
                            class="block sm:w-1/6 border-gray-300 font-bold bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 text-gray-950">
                            Antecedentes:
                        </label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="objetivos_puesto" id="objetivos_puesto" rows="2" required>{{ old('objetivos_puesto') }}</textarea>
                    </div>
                    <!-- Objetivos del Puesto -->
                    

                    <!--Experiencia: -->

                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="habilidades_mentales"
                            class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Experiencia:</label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="habilidades_mentales" id="habilidades_mentales" rows="2" required>{{ old('habilidades_mentales') }}</textarea>
                    </div>
                    <!-- Habilidad física: -->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="habilidades_fisicas"
                            class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Habilidades
                            Físicas:</label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm  focus:border-blue-500 focus:ring-blue-500 "
                            name="habilidades_fisicas" id="habilidades_fisicas" rows="2" required>{{ old('habilidades_fisicas') }}</textarea>
                    </div>
                    <!-- Habilidad mental: -->
                    <div class="mb-4 flex flex-col sm:flex-row">
                        <label for="habilidades_mentales"
                            class="block sm:w-1/6 border-gray-300  bg-gray-200 rounded-t-lg sm:rounded-l-lg sm:rounded-none p-2 font-bold text-gray-950">Habilidades
                            Mentales:</label>
                        <textarea
                            class="block w-full sm:w-5/6 border-gray-300 rounded-b-lg sm:rounded-r-lg sm:rounded-none shadow-sm focus:border-blue-500 focus:ring-blue-500 "
                            name="habilidades_mentales" id="habilidades_mentales" rows="2" required>{{ old('habilidades_mentales') }}</textarea>
                    </div>

                    <!-- Botón para guardar -->
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
