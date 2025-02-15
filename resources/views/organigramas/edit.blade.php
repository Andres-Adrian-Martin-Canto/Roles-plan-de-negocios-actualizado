<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Organigrama</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/cerrarVentanaMensaje.js'])
</head>

<body class="bg-gray-600">
    <!-- Barra de navegación -->
    @include('layouts.navigation')
    @if (session('mensaje'))
    <div class="relative z-10" id="toast-warning" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
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
                                    <p class="text-sm text-gray-500">{{session('mensaje')}}</p>
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
    <div class="text-center text-white my-4 sm:my-6 ml-4 sm:ml-8 md:ml-16 lg:ml-32">
        <h1 class="text-3xl md:text-4xl font-bold mx-auto">Editar Organigram.</h1>
    </div>

    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Barra Lateral -->
        <div class="w-full lg:w-1/6  rounded-lg shadow-md bg-gray-900 p-2">
            @include('descripciones.menu')
        </div>
        <!-- Contenido Principal -->
        <div class="container mx-auto sm:px-6 lg:px-8">
            <main class="w-full rounded-lg shadow-md bg-gray-900 p-2">
                <form
                    action="{{ route('plan_de_negocio.organigramas.update', ['plan_de_negocio' => $plan_de_negocio, 'organigrama' => $organigrama]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nombre del Organigrama -->
                    <div class="mb-6">
                        <label for="nombre" class="block text-sm  text-white font-bold mb-2">Nombre del
                            Organigrama</label>
                        <input type="text" id="nombre" name="nombre"
                            value="{{ old('nombre', $organigrama->nombre) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <!-- Archivo del Organigrama -->
                    <div class="mb-6">
                        <label for="archivo" class="block text-sm  text-white font-bold mb-2">Archivo
                            (opcional)</label>
                        <input type="file" id="archivo" name="archivo"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white placeholder-gray-400">
                        <p class="mt-2 text-sm  text-white font-bold ">Deja en blanco si no deseas cambiar el archivo.
                        </p>
                    </div>
                    <!-- Botones -->
                    <div class="flex justify-center flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700  text-white font-bold  py-2 px-4 rounded-lg shadow">
                            Actualizar Organigrama
                        </button>
                        <a href="{{ route('plan_de_negocio.organigramas.index', $plan_de_negocio) }}"
                            class="w-full sm:w-auto bg-gray-600 hover:bg-gray-700  text-white font-bold py-2 px-4 rounded-lg shadow text-center">
                            Cancelar
                        </a>
                    </div>
                </form>
            </main>
        </div>
    </div>

</body>

</html>
