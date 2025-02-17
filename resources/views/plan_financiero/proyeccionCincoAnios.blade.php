<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/proyeccionCincoAniosYanual.js'])
    <title>{{$titulo}}</title>
</head>

<body>





    {{-- ! FALTA EN LOS FOR AGREGAR IGUAL EL width Y SU VALOR CORRES PONDIENTE --}}
    {{-- ! PONER UN IF Y DEPENDIENDO DE LO QUE ENVIE EL CONTROLLER SE VA A MOSTRAR ACTIVADO O NO
        ! JAVASCRIPT SE ENCARGARA DE ACTIVARLO Y SI ESTA ACTIVADO PUES YA  --}}




    {{-- barra de navegacion header --}}
    @include('layouts.navigation')
    {{-- Boton de regreso --}}
    <div>
        <button class="bg-slate-300 text-black hover:bg-green-400 m-2 rounded-sm">
            <a href="{{ route('plan_de_negocio.estadisticas.index', $plan_de_negocio) }}" class="flex gap-3 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <span class="">Regresar</span>
            </a>
        </button>
    </div>
    {{-- Informacion de la vista --}}
    <div class="mb-5">
        <h1 class="text-center text-4xl font-bold font-sans ">Plan financiero</h1>
        <h2 class="text-center">{{$titulo}}</h2>
    </div>

    {{-- Contenedor  --}}
    <div class="container mx-auto card">
        {{-- Texto informativo --}}
        <h2 class="text-center text-2xl text-white py-4">{{$titulo}}</h2>
        {{-- Particion del texto informativo y la tabla --}}
        <hr class="my-2 h-0.5  border-t-0 w-full bg-neutral-100 dark:bg-white m-0 p-0" />
        {{-- Contenedor de la tabla --}}
        <div class=" px-2 py-3 mx-2  bg-white">
            <table class="w-full px-10 table-auto" id="miTabla" dato='{{ $plan_de_negocio->id }}'>
                {{-- TODO: Parte costos fijos --}}
                <thead>
                    <tr>
                        <td colspan="6" class="text-center bg-fuchsia-300 text-black">
                            Costos fijos
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr>
                        <th class="border text-right pr-2 border-gray-500 dark:bg-gray-800  text-white" width="15%"
                            colspan="2">año 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 5</th>
                    </tr>
                </thead>
                {{-- TODO: Cuerpo de los costos fijos --}}
                <tbody id="fijo">
                    {{-- Pregunto si existen los costos fijos --}}
                    @if (count($costosCincoAniosFijos) > 0)
                        {{-- Se agregan los costos fijos de cinco años --}}
                        @foreach ($costosCincoAniosFijos as $idPertenece => $itemsFijos)
                            @foreach ($itemsFijos as $nombrePertenece => $valoresFijos)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $idPertenece }}">{{ $nombrePertenece }}</td>
                                    @foreach ($valoresFijos as $item)
                                        <td class="border" width="7.5%" id_actual={{ $item[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $item[1] }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        {{-- De lo contrario agregan los costos anuales --}}
                    @else
                        @foreach ($arrayAnualFijo as $id => $itemFijo)
                            @foreach ($itemFijo as $nombre => $montoFijo)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $id }}">{{ $nombre }}</td>
                                    @for ($i = 0; $i < 5; $i++)
                                        <td class="border" width="7.5%" id_actual="0">
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{number_format( $montoFijo , 2) }}">
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades de los costos Fijos por año --}}
                <thead>
                    <tr id="costosFijos">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="7.5%">
                            Total de costos fijos:
                        </th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                    </tr>
                </thead>
                {{-- TODO: Parte de costos variables --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-center bg-orange-300 text-black">
                            Costos variables
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr>
                        <th class="border text-right pr-2 border-gray-500 dark:bg-gray-800  text-white" width="15%"
                            colspan="2">año 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 5</th>
                    </tr>
                </thead>
                {{-- TODO: Cuerpo de los costos variables --}}
                <tbody id="variable">
                    {{-- Pregunto si exiten costos variables --}}
                    @if (count($costosCincoAniosVariables) > 0)
                        {{-- Se agregan los costos VARIABLES de cinco años --}}
                        @foreach ($costosCincoAniosVariables as $idPertenece => $itemsVariables)
                            @foreach ($itemsVariables as $nombrePertenece => $valoresVariables)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $idPertenece }}">{{ $nombrePertenece }}</td>
                                    @foreach ($valoresVariables as $item)
                                        <td class="border" width="7.5%" id_actual={{ $item[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $item[1] }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        {{-- De lo contrario se agregan los de los anuales --}}
                    @else
                        @foreach ($arrayAnualVariable as $id => $itemVariable)
                            @foreach ($itemVariable as $nombre => $montoVariable)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $id }}">{{ $nombre }}</td>
                                    @for ($i = 0; $i < 5; $i++)
                                        <td class="border" width="7.5%" id_actual="0">
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $montoVariable }}">
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endforeach
                    @endif

                </tbody>
                {{-- TODO: Utilidades de los costos Fijos por año --}}
                <thead>
                    <tr id="costosVariable">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="7.5%">
                            Total de costos variables:
                        </th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                    </tr>
                </thead>
                {{-- TODO: Parte de ingresos --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-center bg-amber-300 text-black">
                            Ingresos
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr>
                        <th class="border text-right pr-2 border-gray-500 dark:bg-gray-800  text-white" width="15%"
                            colspan="2">año 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7.5%">año 5</th>
                    </tr>
                </thead>
                {{-- TODO: Cuerpo de ingresos. --}}
                <tbody id="ingreso">
                    {{-- Pregunto si hay ingresos --}}
                    @if (count($ingresosCincoAnios) > 0)
                        {{-- Se agregan los ingresos de cinco años --}}
                        @foreach ($ingresosCincoAnios as $idPertenece => $itemsIngresos)
                            @foreach ($itemsIngresos as $nombrePertenece => $valoresIngresos)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $idPertenece }}">{{ $nombrePertenece }}</td>
                                    @foreach ($valoresIngresos as $item)
                                        <td class="border" width="7.5%" id_actual={{ $item[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $item[1] }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        {{-- De lo contrario se agregaran los valores calculados anuales --}}
                    @else
                        @foreach ($arrayAnualIngresos as $id => $itemIngreso)
                            @foreach ($itemIngreso as $nombre => $montoIngreso)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $id }}">{{ $nombre }}</td>
                                    @for ($i = 0; $i < 5; $i++)
                                        <td class="border" width="7.5%" id_actual="0">
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $montoIngreso }}">
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades de los costos Fijos por año --}}
                <thead>
                    <tr id="ingresos">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="7.5%">
                            Total de ingresos:
                        </th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"></th>
                    </tr>
                </thead>
                {{-- TODO:  Utilidades totales --}}
                <thead>
                    <tr id="utilidades">
                        <th class="border text-center text-xs border-gray-500 dark:bg-red-300  text-black"
                            width="7.5%">
                            Total utilidades: </th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"></th>
                    </tr>
                </thead>
            </table>
        </div>
        {{-- TODO: Boton para guardar --}}
        <div class="flex justify-center py-3">
            @if ($estaActivado)
                {{-- TODO: Inserto la urlDinamica --}}
                <button id="miBoton" urlDinamica={{ $ruta }}
                    class="w-1/4  bg-green-500 text-white font-bold py-1  rounded">
                    Guardar cambios
                </button>
            @else
                {{-- TODO: Inserto la urlDinamica --}}
                <button id="miBoton" urlDinamica={{ $ruta }} disabled
                    class="w-1/4  bg-green-800 text-gray-400 font-bold py-1  rounded">
                    Guardar cambios
                </button>
            @endif
        </div>
    </div>
</body>

</html>
