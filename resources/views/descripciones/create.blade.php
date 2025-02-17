<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Descripción de Puesto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Barra de navegación -->
    @include('layouts.navigation')

    <!-- Encabezado -->
    <div class="text-center text-black my-2 sm:my-4">
        <h1 class="text-4xl antialiased font-sans">Crear Descripción de Puesto</h1>
    </div>

    <!-- Contenedor principal -->
    <div class="flex justify-center items-stretch  my-2 sm:my-4 2xl:px-10 gap-20 xl:mx-2 ">
        <!-- Contenido principal -->
        <!-- Barra lateral -->
        <div class="relative rounded-lg border-none card h-full bg-white 2xl:p-5 p-6 dark:bg-gray-800">
            @include('descripciones.menu')
        </div>

        <main class=" rounded-lg border-none card h-full bg-white 2xl:p-5 dark:bg-gray-800 flex-1 p-8">
            <!-- Formulario -->
            <form action="{{ route('plan_de_negocio.descripciones.store', $plan_de_negocio) }}" method="POST">
                @csrf

                <div class="mb-4 flex gap-4">
                    <div class="flex">
                        <label for="nivel"
                            class="block border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Nivel
                            Organigrama</label>
                        <select
                            class="block border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="nivel" id="nivel" required>
                            <option value="estrategico">Estratégico</option>
                            <option value="tactico">Táctico</option>
                            <option value="operativo">Operativo</option>
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


                    <div class="flex">
                        <label for="codigo"
                            class="block border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Código:</label>
                        <input type="text"
                            class="block border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="codigo" id="codigo" value="{{ old('codigo') }}">

                        @if (session('codigoDuplicado'))
                            <div class="mt-2 text-yellow-600 bg-yellow-100 border border-yellow-400 p-2 rounded">
                                {{ session('codigoDuplicado') }}
                            </div>
                        @endif

                    </div>
                </div>
                <div class="mb-4 flex">
                    <label for="unidad_administrativa"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Unidad
                        Administrativa:</label>
                    <input type="text"
                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="unidad_administrativa" id="unidad_administrativa" required>
                </div>

                <div class="mb-4 flex">
                    <label for="nombre_puesto"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Nombre de
                        Puesto:</label>
                    <input type="text"
                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="nombre_puesto" id="nombre_puesto" required>
                </div>

                <div class="mb-4 flex">
                    <label for="descripcion_generica"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Descripción
                        Genérica:</label>
                    <textarea class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="descripcion_generica" id="descripcion_generica" rows="3" required></textarea>
                </div>

                <div class="mb-4 flex">
                    <label for="descripcion_especifica"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Descripción
                        Específica:</label>
                    <textarea class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="descripcion_especifica" id="descripcion_especifica" rows="3" required></textarea>
                </div>

                <div class="mb-4 flex">
                    <label for="objetivos_puesto"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Objetivos del
                        Puesto:</label>
                    <textarea class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="objetivos_puesto" id="objetivos_puesto" rows="3" required></textarea>
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="flex items-center w-1/2">
                        <label for="salario_minimo"
                            class="block w-1/3 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Salario
                            Mínimo:</label>
                        <input type="number"
                            class="block w-2/3 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="salario_minimo" id="salario_minimo" step="0.01" required>
                    </div>
                    <div class="flex items-center w-1/2">
                        <label for="salario_maximo"
                            class="block w-1/3 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Salario
                            Máximo:</label>
                        <input type="number"
                            class="block w-2/3 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="salario_maximo" id="salario_maximo" step="0.01" required>
                    </div>
                </div>


                <div class="mb-4 flex">
                    <label for="jornada_laboral"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Jornada
                        Laboral:</label>
                    <select
                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="jornada_laboral" id="jornada_laboral" required>
                        <option value="Normal">Normal</option>
                        <option value="Inglesa">Inglesa</option>
                    </select>
                </div>

                <div class="mb-4 flex">
                    <label for="numero_plaza"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Número de
                        Plaza:</label>
                    <input type="number"
                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="numero_plaza" id="numero_plaza" required>
                </div>

                {{-- <div class="mb-4 flex">
                    <label for="reporta_a" class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Reporta a:</label>
                    <input type="text" class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" name="reporta_a" id="reporta_a">
                </div> --}}

                <div class="mb-4 flex">
                    <label for="reporta_a"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Reporta a:</label>
                    <select name="reporta_a" id="reporta_a"
                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        {{-- @foreach ($unidadesAdministrativas as $unidad)
                            <option value="{{ $unidad }}">{{ $unidad }}</option>
                        @endforeach --}}
                    </select>
                </div>


                {{-- ejemplo  --}}
      
                <div class="mb-6">
                    <button @click="activeDiv = 'div1'" class="px-4 py-2 bg-blue-500 text-white rounded-md">Botón 1</button>
                    <button @click="activeDiv = 'div2'" class="px-4 py-2 bg-blue-500 text-white rounded-md">Botón 2</button>
                    <button @click="activeDiv = 'div3'" class="px-4 py-2 bg-blue-500 text-white rounded-md">Botón 3</button>
                </div>
            
                <!-- Divs -->
                <div x-data="{ activeDiv: 'div1', tags: { div1: [], div2: [], div3: [] }, search: '', selectedTags: [] }">
                    <!-- Div 1 -->
                    <div x-show="activeDiv === 'div1'" class="relative w-full">
                        <div class="dropdown-header flex items-center border border-gray-300 rounded-md p-3 bg-white">
                            <input type="text" x-model="search" placeholder="Buscar..." class="w-full p-2 text-sm border-none outline-none focus:ring-2 focus:ring-blue-300" />
                        </div>
                        <div id="selectedTags1" class="flex flex-wrap gap-2 mt-2">
                            <template x-for="tag in tags.div1" :key="tag">
                                <span class="bg-blue-200 text-blue-800 rounded-full px-3 py-1 text-xs flex items-center gap-1">
                                    <span x-text="tag"></span>
                                    <span @click="tags.div1 = tags.div1.filter(t => t !== tag)" class="cursor-pointer text-blue-600">×</span>
                                </span>
                            </template>
                        </div>
                        <div class="dropdown-list absolute w-full max-h-48 overflow-y-auto bg-white border border-gray-300 rounded-md shadow-lg mt-1 z-10">
                            <template x-for="option in ['Opción 1', 'Opción 2'].filter(option => option.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <div @click="tags.div1.push(option); search = ''" class="dropdown-option flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                                    <span x-text="option"></span>
                                </div>
                            </template>
                        </div>
                    </div>
            
                    <!-- Div 2 -->
                    <div x-show="activeDiv === 'div2'" class="relative w-full">
                        <div class="dropdown-header flex items-center border border-gray-300 rounded-md p-3 bg-white">
                            <input type="text" x-model="search" placeholder="Buscar..." class="w-full p-2 text-sm border-none outline-none focus:ring-2 focus:ring-blue-300" />
                        </div>
                        <div id="selectedTags2" class="flex flex-wrap gap-2 mt-2">
                            <template x-for="tag in tags.div2" :key="tag">
                                <span class="bg-blue-200 text-blue-800 rounded-full px-3 py-1 text-xs flex items-center gap-1">
                                    <span x-text="tag"></span>
                                    <span @click="tags.div2 = tags.div2.filter(t => t !== tag)" class="cursor-pointer text-blue-600">×</span>
                                </span>
                            </template>
                        </div>
                        <div class="dropdown-list absolute w-full max-h-48 overflow-y-auto bg-white border border-gray-300 rounded-md shadow-lg mt-1 z-10">
                            <template x-for="option in ['Opción 3', 'Opción 4'].filter(option => option.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <div @click="tags.div2.push(option); search = ''" class="dropdown-option flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                                    <span x-text="option"></span>
                                </div>
                            </template>
                        </div>
                    </div>
            
                    <!-- Div 3 -->
                    <div x-show="activeDiv === 'div3'" class="relative w-full">
                        <div class="dropdown-header flex items-center border border-gray-300 rounded-md p-3 bg-white">
                            <input type="text" x-model="search" placeholder="Buscar..." class="w-full p-2 text-sm border-none outline-none focus:ring-2 focus:ring-blue-300" />
                        </div>
                        <div id="selectedTags3" class="flex flex-wrap gap-2 mt-2">
                            <template x-for="tag in tags.div3" :key="tag">
                                <span class="bg-blue-200 text-blue-800 rounded-full px-3 py-1 text-xs flex items-center gap-1">
                                    <span x-text="tag"></span>
                                    <span @click="tags.div3 = tags.div3.filter(t => t !== tag)" class="cursor-pointer text-blue-600">×</span>
                                </span>
                            </template>
                        </div>
                        <div class="dropdown-list absolute w-full max-h-48 overflow-y-auto bg-white border border-gray-300 rounded-md shadow-lg mt-1 z-10">
                            <template x-for="option in ['Opción 5', 'Opción 6'].filter(option => option.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                <div @click="tags.div3.push(option); search = ''" class="dropdown-option flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                                    <span x-text="option"></span>
                                </div>
                            </template>
                        </div>
                    </div>
            
                    <!-- Input oculto para enviar las tags -->
                    <input type="hidden" name="tags[]" :value="Object.values(tags).flat().join(',')" />
                </div>


                {{-- final --}}

                <div class="mb-4 flex">
                    <label for="comunicacion_interna"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Comunicación
                        Interna:</label>
                    <textarea class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="comunicacion_interna" id="comunicacion_interna" rows="2"></textarea>
                </div>

                <div class="mb-4 flex">
                    <label for="comunicacion_externa"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Comunicación
                        Externa:</label>
                    <textarea class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="comunicacion_externa" id="comunicacion_externa" rows="2"></textarea>
                </div>


                <div class="mb-4 flex gap-4">
                    <div class="flex">
                        <label for="estado_civil"
                            class="block border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Estado
                            Civil:</label>
                        <input type="text"
                            class="block border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="estado_civil" id="estado_civil">
                    </div>
                    <div class="flex">
                        <label for="edad"
                            class=" border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Edad:</label>
                        <input type="number"
                            class="block  border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="edad" id="edad">
                    </div>
                    <div class="flex">
                        <label for="genero"
                            class=" border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Género:</label>
                        <select
                            class="block  border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            name="genero" id="genero">
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4 flex">
                    <label for="requisitos_generales"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Requisitos
                        Generales:</label>
                    <textarea class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="requisitos_generales" id="requisitos_generales" rows="3"></textarea>
                </div>

                <div class="mb-4 flex">
                    <label for="habilidades_fisicas"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Habilidades
                        Físicas:</label>
                    <textarea class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="habilidades_fisicas" id="habilidades_fisicas" rows="3"></textarea>
                </div>

                <div class="mb-4 flex">
                    <label for="habilidades_mentales"
                        class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Habilidades
                        Mentales:</label>
                    <textarea class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        name="habilidades_mentales" id="habilidades_mentales" rows="3"></textarea>
                </div>

                <!-- Botón para guardar -->
                <div class="mt-6">
                    <button type="submit"
                        class="bg-green-900 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-950">Guardar</button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
