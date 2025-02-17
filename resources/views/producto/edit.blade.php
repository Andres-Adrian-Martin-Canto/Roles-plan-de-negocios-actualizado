<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full">
        <div class="flex items-center justify-center">
            <h1 class="dark:text-gray-100 text-slate-700 font-bold py-6 text-2xl mr-5">
                Actualiza los datos del producto/servicio
            </h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 flex items-center justify-center my-6">
            <form class="w-full" method="POST" enctype="multipart/form-data" action="{{ route($user_route.'plan_de_negocio.producto.update', [$plan_de_negocio, $producto]) }}">
                @method('PATCH')
                @csrf
                <div class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="nombre">
                                Nombre del producto
                            </label>
                            <input value="{{ $producto->nombre }}" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="nombre" name="nombre" type="text" placeholder="Escriba el nombre del producto">
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="precio_de_costo">
                            Precio del producto
                            </label>
                            <input value="{{ $producto->precio_de_costo }}" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="precio_de_costo" name="precio_de_costo" type="text" placeholder="Escriba el precio real del producto">
                        </div>

                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="precio_de_venta">
                            Precio de venta
                            </label>
                            <input value="{{ $producto->precio_de_venta }}" rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="precio_de_venta" name="precio_de_venta" type="text" placeholder="Escriba el precio de venta del producto"></textarea>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="descripcion">
                            Descripción
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="descripcion" name="descripcion" type="text" placeholder="Escriba una descripción para el producto">{{ $producto->descripcion}}</textarea>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="">
                            <a href="{{ route($user_route.'plan_de_negocio.producto.index', [$plan_de_negocio]) }}" class="m-4 bg-red-900 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-red-800 rounded-xl">
                                Cancelar
                            </a>

                            <button class="m-4 dark:bg-blue-800 bg-green-600 hover:bg-green-500 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-blue-700 rounded-xl">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

</x-app-layout>