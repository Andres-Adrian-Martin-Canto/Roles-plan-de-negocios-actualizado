<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción de Puesto</title>
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

    <!-- Encabezado -->
    <div class="text-center text-white my-4 sm:my-6 ml-4 sm:ml-8 md:ml-16 lg:ml-32">
        <h1 class="text-3xl md:text-4xl font-bold mx-auto">Descripción de Puesto.</h1>
        <h2 class="text-lg text-white mx-auto">Gestión de las unidades administrativas.</h2>
    </div>

    <!-- Contenedor principal -->
    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Barra lateral -->
        <div class="w-full lg:w-1/6 bg-gray-900 rounded-lg shadow-md  p-2">
            @include('descripciones.menu')
        </div>

        <!-- Contenido principal -->
        <div class="container mx-auto sm:px-6 lg:px-8">
            <main class="w-full  rounded-lg shadow-md bg-gray-900 p-2">
                <div
                    class="bg-gray-800 p-4 rounded-md shadow-md mb-4 flex justify-between items-center text-white border border-black">
                    <h3 class="text-lg font-bold">Lista de Descripciones de Puesto.</h3>
                    <a href="{{ route('plan_de_negocio.descripciones.create', $plan_de_negocio) }}"
                        class="bg-green-700 px-3 py-2 rounded-md text-sm font-bold hover:bg-green-500 transition text-white">
                        Crear Descripción de Puesto
                    </a>

                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead class="bg-slate-800 text-left">
                            <tr>
                                <th class="px-4 py-2 border border-black  text-white">
                                    Nivel Organigrama.</th>
                                <th class="px-4 py-2 border border-black  text-white">
                                    Código.</th>
                                <th class="px-4 py-2 border border-black  text-white">
                                    Unidad Administrativa.
                                </th>
                                <th class="px-4 py-2 border border-black  text-white">
                                    Nombre de Puesto.</th>
                                <th class="px-4 py-2 border border-black text-white"
                                    style="text-align: center; vertical-align: middle;">
                                    Editar.
                                </th>
                                <th class="px-4 py-2 border border-black  text-white"
                                    style="text-align: center; vertical-align: middle;">
                                    Eliminar.
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse($descripciones as $descripcion)
                                <tr class="odd:bg-gray-600 even:bg-gray-500 text-white ">
                                    <td class="px-4 py-2 border border-black font-semibold">
                                        {{ $descripcion->nivel }}
                                    </td>
                                    <td class="px-4 py-2 border border-black font-semibold">
                                        {{ $descripcion->codigo }}
                                    </td>
                                    <td class="px-4 py-2 border border-black  font-semibold">
                                        {{ $descripcion->unidad_administrativa }}
                                    </td>
                                    <td class="px-4 py-2 border border-black  font-semibold">
                                        {{ $descripcion->nombre_puesto }}
                                    </td>
                                    <td class="px-4 py-2 border border-black "
                                        style="text-align: center; vertical-align: middle;">
                                        <a href="{{ route('plan_de_negocio.descripciones.edit', [$plan_de_negocio, $descripcion->id]) }}"
                                            class="bg-orange-700 text-white  px-3 py-1 rounded-md text-sm font-bold hover:bg-orange-500 transition">
                                            Editar
                                        </a>

                                    </td>
                                    <td class="px-4 py-2 border border-black"
                                        style="text-align: center; vertical-align: middle;">
                                        <form
                                            action="{{ route('plan_de_negocio.descripciones.destroy', [$plan_de_negocio, $descripcion->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-700 text-white  px-3 py-1 rounded-md text-sm font-bold hover:bg-red-500 transition">
                                                Eliminar
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-white py-4">No hay descripciones
                                        disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
