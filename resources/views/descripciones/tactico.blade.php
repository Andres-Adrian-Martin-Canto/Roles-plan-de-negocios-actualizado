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
                            <option value="tactico">Táctico</option>
                            <option value="estrategico">Estratégico</option>
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
                       
                        @foreach ($descripcionesEstrategicos as $unidad)
                        <option value="{{ $unidad->id}}">{{ $unidad->unidad_administrativa }}</option>
                    @endforeach
                    </select>
                </div>


            {{-- inicio --}}
            <div class="mb-4 flex">
                <label for="dropdownOperativos"
                    class="block w-1/6 border-gray-300 bg-gray-200 rounded-lg p-2 text-gray-950">Supervisa a:</label>
                <select id="dropdownOperativos"
                    class="block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="" disabled selected>Selecciona a los que supervisa</option>
                    <!-- Opciones dinámicamente agregadas por JavaScript -->
                </select>
            </div>
            
            <!-- Styled Table to Display Selected Options -->
            <div class="mb-4">
                <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                    <thead class="bg-gray-100 rounded-t-lg">
                        <tr>
                            <th class="p-2 text-left text-gray-950">Opciones Seleccionadas</th>
                            <th class="p-2 text-left text-gray-950">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="selectedOperativosTableBody" class="divide-y divide-gray-200 bg-white">
                        <!-- Selected options will be dynamically added here -->
                    </tbody>
                </table>
            </div>
            
            <!-- JavaScript to Handle Dropdown and Table -->
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const dropdown = document.getElementById('dropdownOperativos');
                    const tableBody = document.getElementById('selectedOperativosTableBody');
                    const selectedOptions = new Set();
            
                    // Fetch data to populate dropdown with Operativos
                    fetch('/api/supervisa-a?nivel=tactico') // Cambia 'nivel=tactico' para que coincida con tu API
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error al obtener los datos');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Limpiar el dropdown antes de agregar opciones
                            dropdown.innerHTML = '<option value="" disabled selected>Selecciona a los que supervisa</option>';
                            data.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.id; // ID del registro
                                option.textContent = item.unidad_administrativa; // Nombre o descripción
                                dropdown.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error al cargar los datos:', error);
                        });
            
                    dropdown.addEventListener('change', () => {
                        const value = dropdown.value;
                        const text = dropdown.options[dropdown.selectedIndex].text;
            
                        if (!selectedOptions.has(value)) {
                            selectedOptions.add(value);
            
                            // Crear una nueva fila en la tabla
                            const row = document.createElement('tr');
            
                            // Crear una celda para la opción seleccionada
                            const optionCell = document.createElement('td');
                            optionCell.className = 'p-2 text-gray-950';
                            optionCell.textContent = text;
            
                            // Crear una celda para el botón de eliminación
                            const actionCell = document.createElement('td');
                            actionCell.className = 'p-2';
            
                            const removeButton = document.createElement('button');
                            removeButton.textContent = 'Eliminar';
                            removeButton.className = 'px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700';
                            removeButton.addEventListener('click', () => {
                                selectedOptions.delete(value);
                                tableBody.removeChild(row);
                            });
            
                            actionCell.appendChild(removeButton);
            
                            // Agregar celdas a la fila
                            row.appendChild(optionCell);
                            row.appendChild(actionCell);
            
                            // Agregar la fila al cuerpo de la tabla
                            tableBody.appendChild(row);
                        }
            
                        // Restablecer la selección del dropdown
                        dropdown.selectedIndex = 0;
                    });
                });
            </script>
            
            
            {{-- fin --}}

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
