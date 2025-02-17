<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/menuIzquierdo', 'resources/js/ingresos'])
    <title>Ingresos</title>
</head>
<body>
    @include('layouts.navigation')
    {{-- Cabeza de la pagina --}}
    <div class="flex items-center flex-col text-black my-2 sm:my-4">
        <h1 class="text-4xl antialiased font-sans ">Plan Financiero</h1>
        <h2>Ingresos</h2>
    </div>

    {{-- Mensaje de que ingrese primero costo fijos, variables y ingresos. --}}
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

    <div class="flex justify-center items-start 2xl:px-10 flex-wrap gap-10 w-full h-full ">
        {{-- Es el menu del lador izquierdo --}}
        <div class="relative rounded-lg border-none card w-1/6 h-full bg-white 2xl:p-10 p-6 mt-9 dark:bg-gray-800">
            @include('plan_financiero.menuIzquierdo')
        </div>

        {{-- Lado derecho --}}
        <div class="card w-3/4 mt-3">
            <h2 class="text-center text-2xl dark:text-white my-5">Progreso de Ingresos</h2>
            <hr class="my-2 h-0.5 border-t-0 w-full bg-neutral-100 dark:bg-white m-0 p-0" />
            <div class="px-2 pb-2 mx-2 mb-2 bg-white">
                <h2 class="text-center py-4  2xl:text-2xl text-lg font-normal">Ingresa los Ingresos</h2>
                <table class="w-full table-auto" id="miTabla" dato='{{ $plan_de_negocio->id }}'>
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border w-24">Nombre</th>
                            <th class="border w-16">Valor unitario</th>
                            <th class="border w-16">Monto unitario</th>
                            <th class="border w-16">Conservador</th>
                            <th class="border w-16">Optimista</th>
                            <th class="border w-16">Pesimista</th>
                            <th class="border w-10">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingresos as $ingresos)
                            <tr>
                                <td class="border px-4 py-2"> <input type="text"
                                        class="w-full border rounded-sm px-2 py-1"
                                        value="{{ $ingresos->nombre }}">
                                </td>
                                <td class="border px-4 py-2"><input type="text"
                                        class="w-full border rounded-sm px-2 py-1 text-right"
                                        value="{{ $ingresos->valor_unitario }}">
                                </td>
                                <td class="border px-4 py-2"><input type="text"
                                        class="w-full border rounded-sm px-2 py-1 text-right"
                                        value="{{ $ingresos->monto_unitario }}">
                                </td>
                                <td class="border px-4 py-2"><input type="text"
                                        class="w-full border rounded-sm px-2 py-1 text-right"
                                        value="{{ $ingresos->escenario_conservador }}" disabled>
                                </td>
                                <td class="border px-4 py-2"><input type="text"
                                        class="w-full border rounded-sm px-2 py-1 text-right"
                                        value="{{ $ingresos->escenario_optimista }}">
                                </td>

                                <td class="border px-4 py-2"><input type="text"
                                        class="w-full border rounded-sm px-2 py-1 text-right"
                                        value="{{ $ingresos->escenario_pesimista }}">
                                </td>
                                <td><button
                                        class=" bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="border px-4 py-2"><input class="w-full border rounded-sm px-2 py-1" type=text>
                            </td>
                            <td class="border px-4 py-2"><input class="w-full border rounded-sm px-2 py-1 text-right"
                                    type="text"></td>
                            <td class="border px-4 py-2"><input class="w-full border rounded-sm px-2 py-1 text-right"
                                    type="text"></td>
                            <td class="border px-4 py-2"><input class="w-full border rounded-sm px-2 py-1 text-right"
                                    type="text" disabled></td>
                            <td class="border px-4 py-2"><input class="w-full border rounded-sm px-2 py-1 text-right"
                                    type="text"></td>
                            <td class="border px-4 py-2"><input class="w-full border rounded-sm px-2 py-1 text-right"
                                    type="text"></td>

                        </tr>
                    </tbody>
                    <tfoot class="">
                        <tr>
                            <td id="costosFijos" colspan="4"
                                class="text-right pr-2 border border-gray-500 dark:bg-gray-800  text-white">
                                Total costos variables: $0
                            </td>
                            <td id="optimista"
                                class="text-right lg:text-center pr-2 border border-gray-500 dark:bg-gray-800  text-white">
                                Total optimista: $0
                            </td>

                            <td id="pesimista" colspan="2"
                                class="text-right lg:text-center pr-2 border border-gray-500 dark:bg-gray-800  text-white">
                                Total pesimista: $0
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="flex  justify-center">
                <button id="miBoton" informacion="{{$datosAnuales}}" disabled
                    class="w-1/2  bg-green-800 text-gray-400 font-bold py-1 mb-5 rounded">
                    Guardar cambios
                </button>
            </div>
        </div>
    </div>
</body>
</html>
