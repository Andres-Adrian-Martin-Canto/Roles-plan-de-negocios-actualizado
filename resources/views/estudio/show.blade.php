<x-app-layout class="flex flex-nowrap">

    <x-second-sidebar :plan_de_negocio="$plan_de_negocio" :estudio="$estudio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="mx-20 flex items-center justify-center">
            <h1 class="dark:text-gray-100 my-6 text-2xl">Detalles del estudio</h1>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 flex flex-wrap mb-8 space-y-6 grid justify-items-center">
            <form class="w-full" method="POST" action="{{ route($user_route.'plan_de_negocio.estudio.update', [$plan_de_negocio, $estudio]) }}">
                @method('PATCH')
                @csrf
                <div class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="nombre">
                            Nombre
                            </label>
                            <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="nombre" name="nombre" type="text" placeholder="Escriba el nombre del estudio" value="{{ $estudio->nombre }}">
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="objetivo">
                            Objetivo
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="objetivo" name="objetivo" type="text" placeholder="Escriba los objetivos específicos">{{ $estudio->objetivo }}</textarea>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="objetivos_especificos">
                            Objetivos específicos
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="objetivos_especificos" name="objetivos_especificos" type="text" placeholder="Escriba los objetivos específicos">{{ $estudio->objetivos_especificos }}</textarea>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="especificacion">
                            Especificación
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="especificacion" name="especificacion" type="text" placeholder="Escriba la especificación del estudio">{{ $estudio->especificacion }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-center items-center">
                        <div class=""> 
                            <button class="bg-green-600 m-4 dark:bg-blue-800 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-blue-700 rounded-xl">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>