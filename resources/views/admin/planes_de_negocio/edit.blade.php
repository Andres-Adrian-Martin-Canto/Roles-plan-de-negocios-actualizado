<x-app-layout>
    <div class="mx-20 flex items-center justify-center my-6">
        <form class="w-full" method="POST" enctype="multipart/form-data" action="{{ route('admin_plan_de_negocio.update', [$plan_de_negocio]) }}">
            @method('PATCH')    
            @csrf
            <div class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3">
                        <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="nombre">
                            Nombre del plan de negocio
                        </label>
                        <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="nombre" name="nombre" type="text" placeholder="Escriba el nombre del producto" value="{{ $plan_de_negocio->nombre }}">
                    </div>
                </div>

                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3">
                        <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="descripcion">
                        Descripción del plan de negocio
                        </label>
                        <textarea rows="3" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="descripcion" name="descripcion" type="text" placeholder="Escriba una descripción para el producto">{{ $plan_de_negocio->descripcion }}</textarea>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <div class="">
                        <a href="{{ route('dashboard') }}" class="m-4 bg-red-900 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-red-800 rounded-xl">
                            Cancelar
                        </a>

                        <button class="m-4 dark:bg-blue-800 bg-green-600 hove:bg-green-500 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-blue-700 rounded-xl">
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>