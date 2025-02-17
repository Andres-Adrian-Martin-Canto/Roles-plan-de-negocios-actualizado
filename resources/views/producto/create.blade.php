<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    
    <div class="w-full h-screen overflow-auto">
        <div class="flex items-center justify-center">
            <h1 class="dark:text-gray-100 text-slate-700 font-bold py-6 text-2xl">Ingrese el producto/servicio nuevo</h1>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif
        <div class="mx-20 flex items-center justify-center my-6">
            <form class="w-full" method="POST" enctype="multipart/form-data" action="{{ route($user_route.'plan_de_negocio.producto.store', [$plan_de_negocio]) }}">
                @csrf
                <div class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="nombre">
                                Nombre del producto
                            </label>
                            <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="nombre" name="nombre" type="text" placeholder="Escriba el nombre del producto">
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="precio_de_costo">
                            Precio del producto
                            </label>
                            <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="precio_de_costo" name="precio_de_costo" type="text" placeholder="Escriba el precio real del producto">
                        </div>

                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="precio_de_venta">
                            Precio de venta
                            </label>
                            <input rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="precio_de_venta" name="precio_de_venta" type="text" placeholder="Escriba el precio de venta del producto"></textarea>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="descripcion">
                            Descripción
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="descripcion" name="descripcion" type="text" placeholder="Escriba una descripción para el producto"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="">
                            <a href="{{ route($user_route.'plan_de_negocio.producto.index', [$plan_de_negocio]) }}" class="m-4 bg-red-900 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-red-800 rounded-xl">
                                Cancelar
                            </a>

                            <button class="m-4 dark:bg-blue-800 bg-blue-500 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-blue-700 rounded-xl">
                                Crear
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

</x-app-layout>