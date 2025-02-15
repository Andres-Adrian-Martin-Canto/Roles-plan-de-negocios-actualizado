<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organigrama.</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/cerrarVentanaMensaje.js'])
</head>

<body class="bg-gray-600">
    <!-- Barra de Navegación -->
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
        <h1 class="text-3xl md:text-4xl font-bold mx-auto">Organigrama.</h1>
    </div>
    <!-- Contenedor Principal -->
    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Barra Lateral -->
        <div class="w-full lg:w-1/6  rounded-lg shadow-md bg-gray-900 p-2">
            @include('descripciones.menu')
        </div>

        <!-- Contenido Principal -->
        <div class="container mx-auto sm:px-6 lg:px-8">
            <main class="w-full rounded-lg shadow-md bg-gray-900 p-2">
                <!-- Cuadro con Mensaje -->
                <div class="flex items-center justify-center mb-8">
                    <div
                        class="w-full max-w-screen-md h-auto flex flex-col items-center justify-center border-2 border-dashed border-black bg-gray-700 rounded-lg p-6">
                        <p class="text-white text-center px-4 mb-4 font-bold">
                            Para crear el Organigrama se enviará a una página externa.
                        </p>
                        <a href="https://edit.org/edit" target="_blank"
                            class="px-4 py-2 bg-orange-700 text-white font-bold rounded hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Enviar a la página
                        </a>

                    </div>
                </div>


                <!-- Botón para Subir Organigrama -->
                <div class="mb-4 text-center">
                    <p class="text-lg font-bold text-white mb-2">
                        Solo se aceptan archivos PDF.
                    </p>

                </div>

                <div class="mb-4 flex justify-center">
                    <button
                        class="px-4 py-2 bg-green-600  font-bold text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400"
                        data-bs-toggle="modal" data-bs-target="#uploadModal">
                        Subir Organigrama
                    </button>
                </div>
                <!-- Tabla de Organigramas -->
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-800 text-left">
                            <tr>
                                <th class="px-4 py-2 text-left text-white border border-black">
                                    Nombre del Organigrama
                                </th>
                                <th class="px-4 py-2 text-center text-white border border-black">
                                    Descargar
                                </th>
                                <th class="px-4 py-2 text-center text-white border border-black">
                                    Editar
                                </th>
                                <th class="px-4 py-2 text-center text-white border border-black">
                                    Eliminar
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organigramas as $organigrama)
                                <tr class=" odd:bg-gray-600 even:bg-gray-500  text-white">
                                    <td class="px-4 py-2  font-semibold  text-white border border-black">
                                        {{ $organigrama->nombre }}
                                    </td>
                                    <td class="px-4 py-2 text-center border border-black">
                                        <a href="{{ route('organigramas.download', $organigrama) }}"
                                            class="px-3 py-1 bg-blue-600 text-white  font-bold rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                            Descargar
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-center border border-black">
                                        <a href="{{ route('plan_de_negocio.organigramas.edit', [$plan_de_negocio, $organigrama]) }}"
                                            class="px-3 py-1 bg-yellow-600  font-bold text-white rounded hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                            Editar
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-center border border-black">
                                        <form
                                            action="{{ route('plan_de_negocio.organigramas.destroy', [$plan_de_negocio, $organigrama]) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600  font-bold text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </main>
        </div>

        <!-- Modal para Subir Organigrama -->
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden" id="uploadModal">
            <div class="bg-gray-800 p-6 rounded shadow-lg max-w-md w-full">
                <h5 class="text-xl font-semibold mb-4 text-white">Subir Organigrama</h5>
                <form action="{{ route('plan_de_negocio.organigramas.store', [$plan_de_negocio]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-white mb-2">Nombre del
                            Organigrama</label>
                        <input type="text"
                            class="w-full border border-black  p-2 rounded  bg-gray-700 text-gray-200"
                            id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-4">
                        <label for="archivo" class="block text-white mb-2">Archivo</label>
                        <input type="file"
                            class="w-full border border-black  p-2 rounded bg-gray-700 text-gray-200"
                            id="archivo" name="archivo" required>
                    </div>
                    <div class="flex justify-between">
                        <button type="button"
                            class="px-4 py-2 bg-gray-500 text-white font-bold hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300"
                            onclick="document.getElementById('uploadModal').classList.add('hidden')">Cancelar</button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-700 text-white font-bold hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-blue-400">Subir</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Script para abrir y cerrar el modal -->
        <script>
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('uploadModal').classList.remove('hidden');
                });
            });
        </script>
</body>

</html>
