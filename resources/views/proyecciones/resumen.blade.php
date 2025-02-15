<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Proyección de Sueldos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/cerrarVentanaMensaje.js'])
</head>
<body class="bg-gray-600">
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
    <div class="text-center text-white my-4 sm:my-6 ml-4 sm:ml-8 md:ml-16 lg:ml-32">
        <h1 class="text-3xl md:text-4xl font-bold mx-auto">Resumen de Sueldos.</h1>
    </div>
    <div class="flex flex-col lg:flex-row justify-center items-start gap-6 xl:px-10 p-4">
        <!-- Barra lateral -->
        <div class="w-full lg:w-1/6  rounded-lg shadow-md bg-gray-900 p-2">
            @include('descripciones.menu')
        </div>
        <div class="container mx-auto my-4 px-4 sm:px-6 lg:px-8">
            <!-- Contenedor de la Tabla y Botones -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Columna 1: Tabla de Totales -->
                <div class="col-span-1">
                    <div class="overflow-x-auto">
                        <table class="w-full bg-gray-800 shadow rounded mb-4 border border-black">
                            <thead>
                                <tr class="border border-black bg-gray-900">
                                    <th class="px-4 py-2 text-left border border-black text-white font-medium">
                                        Descripción
                                    </th>
                                    <th class="px-4 py-2 text-right border border-black text-white font-medium">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b transition bg-gray-600">
                                    <td class="border px-4 py-2 border-black text-white font-medium">Total de Sueldos
                                        Mensuales:</td>
                                    <td class="border px-4 py-2 text-right border-black text-white font-medium ">
                                        ${{ number_format($totalmensual , 2) }}</td>
                                </tr>
                                <tr class="border-b bg-gray-500 transition text-white font-medium">
                                    <td class="border px-4 py-2 border-black">Total de Sueldos Anuales:</td>
                                    <td class="border px-4 py-2 text-right border-black text-white font-medium">
                                        ${{ number_format($totalanual, 2) }}</td>
                                </tr>
                                <tr class="border-b transition bg-gray-600">
                                    <td class="border px-4 py-2 border-black text-white font-medium">Total de Sueldos en
                                        5 Años:</td>
                                    <td class="border px-4 py-2 text-right border-black text-white font-medium">
                                        ${{ number_format($totalcincoanios, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <script>
                    // Función para obtener los sueldos desde el servidor
                    async function obtenerSueldosTotales() {
                        try {
                            const response = await fetch('/api/sueldos');
                            const data = await response.json();
            
                            // Sumar los sueldos mensuales
                            const totalSueldoMensual = data.sueldos_mensuales.reduce((acumulado, sueldo) => acumulado + parseFloat(sueldo), 0);
                            
                            // Sumar los sueldos anuales
                            const totalSueldoCincoAnos = data.sueldos_anuales.reduce((acumulado, sueldo) => acumulado + parseFloat(sueldo), 0);
            
                            // Mostrar los totales en las vistas
                            document.getElementById('totalSueldoMensual').innerText = totalSueldoMensual.toFixed(2);
                            document.getElementById('totalSueldoCincoAnos').innerText = totalSueldoCincoAnos.toFixed(2);
                        } catch (error) {
                            console.error('Error al obtener los sueldos:', error);
                            document.getElementById('totalSueldoMensual').innerText = 'Error al cargar el total';
                            document.getElementById('totalSueldoCincoAnos').innerText = 'Error al cargar el total';
                        }
                    }
            
                    // Llamar a la función cuando la página esté lista
                    window.onload = obtenerSueldosTotales;
                </script> --}}
                <!-- Columna 2: Botón Proyección Anual -->
                <div class="col-span-1 flex justify-center items-center">
                    <a href="{{ route('plan_de_negocio.proyeccionsueldoanual.index', $plan_de_negocio) }}"
                        class=" text-white px-8 py-12 rounded-lg transition border  hover:border-blue-600 w-full text-center text-xl bg-blue-700 border-blue-600 hover:bg-blue-800">
                        Proyección Anual
                    </a>
                </div>
                <!-- Columna 3: Botón Proyección 5 Años -->
                <div class="col-span-1 flex justify-center items-center">
                    <a href="{{ route('plan_de_negocio.proyeccionsueldocincoanios.index', $plan_de_negocio) }}"
                        class=" text-white px-8 py-12 rounded-lg  transition border  hover:border-green-600 w-full text-center text-xl bg-green-700 border-green-600 hover:bg-green-800">
                        Proyección 5 Años
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>