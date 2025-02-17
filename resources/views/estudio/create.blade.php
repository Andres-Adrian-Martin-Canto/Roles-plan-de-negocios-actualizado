<x-app-layout>
    @php $user_route = ''; @endphp

    @if ( auth()->user()->rol == 'admin')
        @php $user_route = 'admin_'; @endphp
    @elseif ( auth()->user()->rol == 'asesor')
        @php $user_route = 'asesor_'; @endphp
    @endif

    <div class="mx-20 flex items-center justify-center my-6">
        <form class="w-full" method="POST" enctype="multipart/form-data" action="{{ route($user_route.'plan_de_negocio.estudio.store', [$plan_de_negocio]) }}">
            @csrf
            <div class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3">
                        <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="nombre">
                            Nombre del estudio de mercado
                        </label>
                        <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="nombre" name="nombre" type="text" placeholder="Escriba el nombre del producto">
                    </div>
                </div>

                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="objetivo">
                        Objetivo general del estudio
                        </label>
                        <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="objetivo" name="objetivo" type="text" placeholder="Escriba una descripción para el producto"></textarea>
                    </div>

                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="objetivos_especificos">
                            Objetivos específicos
                        </label>
                        <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="objetivos_especificos" name="objetivos_especificos" type="text" placeholder="Escriba una descripción para el producto"></textarea>
                    </div>
                </div>

                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3">
                        <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="especificacion">
                        Especificación del mercado
                        </label>
                        <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="especificacion" name="especificacion" type="text" placeholder="Escriba una descripción para el producto"></textarea>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <div class="">
                        <a href="{{ route($user_route.'plan_de_negocio.estudio.index', [$plan_de_negocio]) }}" class="m-4 bg-red-900 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-red-800 rounded-xl">
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
</x-app-layout>