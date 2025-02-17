<!DOCTYPE html>
<html lang = "es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/menuIzquierdo', 'resources/js/cerrarVentanaMensaje'])
    <title>Proyecciones</title>
</head>

<body class="">
    {{-- TODO: Navar de navegacion --}}
    @include('layouts.navigation')

    {{-- TODO:  Mensaje de problema al entrar a una ventana de cinco años --}}
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

    {{-- TODO:  Cabeza de la pagina --}}
    <div class="text-center text-black my-2 sm:my-4">
        <h1 class="text-4xl antialiased font-sans ">Plan Financiero</h1>
        <h2>Ingresos</h2>
    </div>

    {{-- TODO: Contenedor del menu, estadisticas y navegacion de years and month --}}
    <div class="flex justify-center items-stretch 2xl:px-10  gap-2 xl:mx-2">
        {{-- TODO: Menu para navegar --}}
        <div class="relative rounded-lg border-none card  h-full bg-white 2xl:p-10 p-6  dark:bg-gray-800">
            @include('plan_financiero.menuIzquierdo')
        </div>

        {{-- TODO: contenedor estadisticas  --}}
        <div class="flex-col  text-white  space-y-8">
            {{-- TODO: Los gastos --}}
            <div class="card grid gap-2.5 grid-cols-2 p-3">
                <div>
                    <p class="pl-2">Costos Fijos Mensuales Totales (CFMT):</p>
                </div>
                <div class="bg-blue-400">
                    <p class=" text-center">
                        ${{ $costos_fijos }}
                    </p>
                </div>
                <div>
                    <p class="pl-2 text-sm">Costos Variables Mesuales Totales (CVMT):</p>
                </div>
                <div class="bg-blue-400">
                    <p class="text-center">${{ $costos_variable }}</p>
                </div>
                <div>
                    <p class="pl-2">Costos Totales (CT):</p>
                </div>
                <div class="bg-blue-400">
                    <p class="text-center">${{ sprintf("%.2f",$costos_fijos + $costos_variable, 2) }}</p>
                </div>
            </div>

            {{-- TODO: Ingresos mensuales --}}
            <div class="card grid gap-y-2.5 grid-cols-2 p-3">
                <div>
                    <p class="pl-2">Ingresos Mensuales Totales (IMT):</p>
                </div>
                <div class="bg-blue-400">
                    <p class=" text-center">${{ $ingresos }}</p>
                </div>
            </div>

            {{-- TODO: Ganancias mensuales y anuales --}}
            <div class="card grid gap-2.5 grid-cols-2 p-3">
                <div>
                    <p class="pl-2">Utilidades Totales Mensuales (UTM):</p>
                </div>
                <div class="bg-blue-400">
                    <p class=" text-center">${{sprintf("%.2f", $ingresos - ($costos_fijos + $costos_variable) , 2)}}</p>
                </div>
                <div>
                    <p class="pl-2">Utilidades Totales Anual (UTM12):</p>
                </div>
                <div class="bg-blue-400">
                    <p class=" text-center">${{sprintf("%.2f", ($ingresos - ($costos_fijos + $costos_variable)) * 12 ,2)}}</p>
                </div>
            </div>
        </div>

        {{-- TODO: Contenedor botones de navegacion --}}
        <div class="grid grid-cols-2 gap-2">
            <a href="{{ route('plan_de_negocio.proyeccionConservador.index', $plan_de_negocio) }}"
                class="flex items-center justify-center rounded-lg font-bold bg-gray-400 hover:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-black ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
                </svg>
                <p class="text-base p-2">Proyección anual Conservador</p>
            </a>
            <a href="{{ route('plan_de_negocio.proyeccionOptimista.index', $plan_de_negocio) }}"
                class="flex items-center justify-center rounded-lg font-bold bg-gray-400 hover:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-black ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
                </svg>
                <p class="text-base p-2">Proyección anual Optimista</p>
            </a>
            <a
                href="{{ route('plan_de_negocio.proyeccionPesimista.index', $plan_de_negocio) }}"class="flex items-center justify-center rounded-lg font-bold bg-gray-400 hover:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-black ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
                </svg>
                <p class="text-base p-2">Proyección anual Pesimista</p>
            </a>
            {{--TODO:  Proyeccion Pesimista cinco anios --}}
            <a
                href="{{ route('plan_de_negocio.proyeccionPesimistaCincoAnios.index', $plan_de_negocio) }}"class="flex items-center justify-center rounded-lg font-bold bg-gray-400 hover:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-black ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
                </svg>
                <p class="text-base p-2">Proyección cinco años Pesimista</p>
            </a>
            {{--TODO:  Proyeccion conservador cinco anios --}}
            <a
                href="{{ route('plan_de_negocio.proyeccionConservadorCincoAnios.index', $plan_de_negocio) }}"class="flex items-center justify-center rounded-lg font-bold bg-gray-400 hover:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-black ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
                </svg>
                <p class="text-base p-2">Proyección cinco años conservador</p>
            </a>
            {{--TODO:  Proyeccion optimista cinco anios --}}
            <a
                href="{{ route('plan_de_negocio.proyeccionOptimistaCincoAnios.index', $plan_de_negocio) }}"class="flex items-center justify-center rounded-lg font-bold bg-gray-400 hover:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-black ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
                </svg>
                <p class="text-base p-2">Proyección cinco años optimista</p>
            </a>
        </div>
    </div>
</body>

</html>
