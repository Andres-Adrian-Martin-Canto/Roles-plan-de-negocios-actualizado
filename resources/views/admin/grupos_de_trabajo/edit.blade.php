<x-app-layout class="flex flex-nowrap">
    
    <div class="w-full">
        <div class="flex items-center justify-center">
            <h1 class="dark:text-gray-100 py-6 text-2xl">Actualizando grupo de trabajo</h1>
        </div>

        <div class="mx-20 flex items-center justify-center my-6">
            <form class="w-full" method="POST" enctype="multipart/form-data" action="{{ route('grupo_detalles_admin', [$grupo]) }}">
                @csrf
                @method('PATCH')
                <div class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="nombre_grupo">
                                Nombre del grupo
                            </label>
                            <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="nombre_grupo" name="nombre_grupo" type="text" placeholder="Escriba el nombre del producto" value="{{ $grupo->nombre_grupo }}">
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="descripcion">
                            Descripción
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="descripcion" name="descripcion" type="text" placeholder="Escriba una descripción para el producto">{{ $grupo->descripcion }}</textarea>
                        </div>
                    </div>

                    <div class="hidden">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="integrantes">
                            Integrantes
                            </label>
                            <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="integrantes" name="integrantes" type="text" placeholder="">[]</textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-center items-center">
                        <div class="">
                            <a href="{{ route('grupo_show_admin', [$grupo]) }}" class="m-4 bg-red-900 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-red-800 rounded-xl">
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