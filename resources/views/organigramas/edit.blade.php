<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Organigrama</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-50">

    <!-- Barra de navegación -->
    @include('layouts.navigation')

    <div class="container mx-auto mt-12 px-4">
        <!-- Título -->
        <div class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-semibold">Editar Organigrama</h1>
        </div>

        <!-- Contenido -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Barra lateral -->
            <aside class="lg:w-1/4  rounded-lg  p-6">
                @include('descripciones.menu')
            </aside>

            <!-- Formulario principal -->
            <main class="lg:w-3/4 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
                <form action="{{ route('plan_de_negocio.organigramas.update', ['plan_de_negocio' => $plan_de_negocio, 'organigrama' => $organigrama]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nombre del Organigrama -->
                    <div class="mb-6">
                        <label for="nombre" class="block text-sm font-medium mb-2">Nombre del Organigrama</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $organigrama->nombre) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-400 dark:focus:border-blue-400"
                            required>
                    </div>

                    <!-- Archivo del Organigrama -->
                    <div class="mb-6">
                        <label for="archivo" class="block text-sm font-medium mb-2">Archivo (opcional)</label>
                        <input type="file" id="archivo" name="archivo"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-400 dark:focus:border-blue-400">
                        <p class="mt-2 text-sm text-gray-500">Deja en blanco si no deseas cambiar el archivo.</p>
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow">
                            Actualizar Organigrama
                        </button>
                        <a href="{{ route('plan_de_negocio.organigramas.index', $plan_de_negocio) }}"
                            class="w-full sm:w-auto bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg shadow text-center">
                            Cancelar
                        </a>
                    </div>
                </form>
            </main>
        </div>
    </div>

</body>

</html>