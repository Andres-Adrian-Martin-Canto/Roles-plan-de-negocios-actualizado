<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="mx-20 flex items-center justify-center">
            <h1 class="dark:text-gray-100 my-6 text-2xl">Imagen corporativa</h1>
        
        </div>
        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 flex items-center justify-center my-6">
            <form class="w-full" method="POST" enctype="multipart/form-data" action="{{ route($user_route.'plan_de_negocio.imagen_corporativa.update', [$plan_de_negocio, $plan_de_negocio->imagenes_corporativas]) }}">
                @method('PATCH')
                @csrf
                <div class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="nombre_corporativo">
                                Nombre de la empresa
                            </label>
                            <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" value="{{ $plan_de_negocio->imagenes_corporativas->nombre_corporativo }}" id="nombre_corporativo" name="nombre_corporativo" type="text" placeholder="Escriba el nombre corporativo" required>
                        </div>
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">    
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="logotipo">Logotipo</label>
                            <input id="logotipo" name="logotipo" type="file" placeholder="Escriba el nombre corporativo"
                                class="file:-mx-3 file:-my-[0.32rem]
                                file:border-0 file:border-solid
                                file:cursor-pointer
                                file:bg-neutral-100 file:px-3 file:py-[0.32rem]
                                file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem]
                                file:border-inherit
                                w-full
                                bg-gray-200
                                text-black
                                border
                                border-gray-200
                                rounded py-3
                                px-4
                                mb-3 mt-4">
                            <label class="tracking-wide dark:text-gray-200 text-md font-bold mb-2" for="logotipo"><p class="text-pink-600">(Para conservar la misma imagen deje en blanco)</p></label>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="eslogan">
                            Eslogan
                            </label>
                            <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" value="{{ $plan_de_negocio->imagenes_corporativas->eslogan }}" id="eslogan" name="eslogan" type="text" placeholder="Escriba el eslogan con el que se identificara la empresa" required>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="justificacion_nombre">
                            Justificación del nombre de la empresa
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="justificacion_nombre" name="justificacion_nombre" type="text" placeholder="Escriba el significado del nombre elegido" required>{{ $plan_de_negocio->imagenes_corporativas->justificacion_nombre }}</textarea>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="justificacion_logo">
                            JUstificación del logotipo
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="justificacion_logo" name="justificacion_logo" type="text" placeholder="Escriba el significado del nombre elegido" required>{{ $plan_de_negocio->imagenes_corporativas->justificacion_logo }}</textarea>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="justificacion_eslogan">
                            Justificación del eslogan
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="justificacion_logo" name="justificacion_eslogan" type="text" placeholder="Escriba el significado del nombre elegido" required>{{ $plan_de_negocio->imagenes_corporativas->justificacion_eslogan }}</textarea>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="">
                            <a href="{{ route($user_route.'plan_de_negocio.imagen_corporativa.index', [$plan_de_negocio]) }}" class="m-4 bg-red-900 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-red-800 rounded-xl">
                                Cancelar
                            </a>

                            <button class="m-4 dark:bg-green-800 text-white font-bold py-4 px-10 bg-green-600 hover:bg-green-500 border-gray-500 dark:hover:bg-green-700 rounded-xl">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>