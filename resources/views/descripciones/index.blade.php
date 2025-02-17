<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción de Puesto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <!-- Barra de navegación -->
    @include('layouts.navigation')
    
    <!-- Encabezado -->
    <div class="text-center text-black dark:text-white my-4 sm:my-6">
        <h1 class="text-4xl font-semibold antialiased">Descripción de Puesto</h1>
        <h2 class="text-lg text-black dark:text-white">Gestión de las unidades administrativas</h2>
    </div>
    
    <!-- Contenedor principal -->
    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Barra lateral -->
        <div class="w-full lg:w-1/4 bg-white rounded-lg shadow-md dark:bg-gray-800 p-4">
            @include("descripciones.menu")
        </div>

        <!-- Contenido principal -->
        <main class="w-full lg:w-3/4 bg-white rounded-lg shadow-md dark:bg-gray-800 p-4">
            <div class="bg-gray-800 text-white p-4 rounded-md shadow-md mb-4 flex justify-between items-center">
                <h4 class="text-lg font-semibold">Lista de Descripciones de Puesto</h4>
                <a href="{{ route('plan_de_negocio.descripciones.create', $plan_de_negocio) }}" 
                   class="bg-green-900 text-white px-3 py-2 rounded-md text-sm hover:bg-green-600 transition">
                   Crear Descripción de Puesto
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-blue-200 dark:bg-blue-800 text-left">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">Nivel Organigrama</th>
                            <th class="px-4 py-2 border border-gray-300">Código</th>
                            <th class="px-4 py-2 border border-gray-300">Unidad Administrativa</th>
                            <th class="px-4 py-2 border border-gray-300">Nombre de Puesto</th>
                            <th class="px-4 py-2 border border-gray-300">Editar</th>
                            <th class="px-4 py-2 border border-gray-300">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($arraydatos as $dato)
                        <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-700 dark:even:bg-gray-700">
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{$dato[1]}}</td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{$dato[2]}}</td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{$dato[3]}}</td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{$dato[4]}}</td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                <a href="{{$dato[5]}}" 
                                   class="bg-orange-500 text-white px-3 py-1 rounded-md text-sm hover:bg-orange-600 transition">
                                   Editar
                                </a>
                            </td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                <form action="{{ route('plan_de_negocio.descripciones.destroy', [$plan_de_negocio, $dato[0]]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
                                            Eliminar
                                    </button>
                                </form>
                            </td>
                           </tr>
                        @endforeach --}}
                        @forelse($descripciones as $descripcion)
                        <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-700 dark:even:bg-gray-700">
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $descripcion->nivel }}</td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $descripcion->codigo }}</td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $descripcion->unidad_administrativa }}</td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $descripcion->nombre_puesto }}</td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                <a href="{{ route('plan_de_negocio.descripciones.edit', [$plan_de_negocio, $descripcion->id]) }}" 
                                   class="bg-orange-500 text-white px-3 py-1 rounded-md text-sm hover:bg-orange-600 transition">
                                   Editar
                                </a>
                            </td>
                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                <form action="{{ route('plan_de_negocio.descripciones.destroy', [$plan_de_negocio, $descripcion->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
                                            Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">No hay descripciones disponibles.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>
