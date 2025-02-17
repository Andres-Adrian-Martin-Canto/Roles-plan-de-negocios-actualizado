<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="mx-20 flex items-center justify-center">
            <h1 class="dark:text-gray-100 text-slate-700 font-bold my-6 text-2xl">Producto y/o servicio</h1>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 bg-white dark:bg-gray-900 p-6"> 
            <div class="flex justify-between">
                <div class="relative max-w-xs my-4">
                    <form action="{{ route($user_route.'plan_de_negocio.producto.index',[$plan_de_negocio]) }}" method="GET">
                        <label for="search" class="sr-only">
                            Search
                        </label>
                        <input type="text" name="search"
                            class="block w-full p-3 pl-10 text-sm border-gray-400 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                            placeholder="Search..." />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>
                </div>
                <div>
                    <a href="{{ route($user_route.'plan_de_negocio.producto.create', [$plan_de_negocio]) }}" class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-base font-medium text-white bg-blue-500 border border-gray-300 rounded-lg hover:bg-blue-400 hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Agregar producto
                    </a>
                    <a href="{{ route($user_route.'plan_de_negocio.producto.index', [$plan_de_negocio]) }}" class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-base font-medium text-white bg-blue-500 border border-gray-300 rounded-lg hover:bg-blue-400 hover:text-white dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Ver todos los productos
                    </a>
                </div>
            </div>

            <div class="flex my-2 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre del producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio de costo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio de venta
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descripción
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (sizeof($listaproductos)==0)
                            <tr class="row-span-4 border-b dark:bg-gray-800 dark:border-gray-700">
                                <th colspan = "5" scope="row" class="text-center bh-red px-6 py-8 text-lg text-gray-900 whitespace-nowrap dark:text-gray-400">
                                    <div class="">
                                    @if ($plan_de_negocio->productos==null || sizeof($plan_de_negocio->productos)==0)
                                        Aún no tienes servicios o productos añadidos
                                    @else
                                        Producto o servicio no encontrado      
                                    @endif
                                    </div>
                                </th>
                            </tr>
                        @else
                            @foreach ($listaproductos as $producto)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $producto->nombre }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $producto->precio_de_costo }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $producto->precio_de_venta }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $producto->descripcion }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="inline-flex">
                                            <a href="{{ route($user_route.'plan_de_negocio.producto.edit', [$plan_de_negocio, $producto]) }}" class="inline-flex items-center px-1.5 py-1.5 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                            </a>

                                            <form method="post" action="{{ route($user_route.'plan_de_negocio.producto.destroy', [$plan_de_negocio, $producto]) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                    onclick="return confirm('¿Seguro que quieres borrar este registro?');"
                                                    class="inline-flex
                                                        items-center 
                                                        px-1.5
                                                        py-1.5
                                                        bg-red-700
                                                        hover:bg-red-800
                                                        text-white
                                                        text-sm
                                                        font-medium
                                                        rounded-md ml-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div class="m-6">
                {{ $listaproductos->links() }}
            </div>
        </div>
    </div>

</x-app-layout>