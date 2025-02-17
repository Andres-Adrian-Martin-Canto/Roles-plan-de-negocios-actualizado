<x-app-layout class="flex flex-nowrap">

    <x-second-sidebar :plan_de_negocio="$plan_de_negocio" :estudio="$estudio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="mx-20 flex items-center justify-center">
            <h1 class="dark:text-gray-100 my-6 text-2xl">Estas creando una pregunta</h1>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 dark:bg-gray-900 bg-white flex flex-wrap mb-8 space-y-6 grid justify-items-center">
            <form class="w-full" method="POST" action="{{ route($user_route.'plan_de_negocio.estudio.encuesta.pregunta.store', [$plan_de_negocio, $estudio, $encuestum]) }}">
                @csrf
                <div class="dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="pregunta">
                            Pregunta
                            </label>
                            <input class="w-full bg-gray-200 text-black border border-gray-100 rounded py-3 px-4 mb-3 mt-4" id="pregunta" name="pregunta" type="text" placeholder="Escriba el título de la encuesta" value="">
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
                                <div class="mb-6">
                                    <label for="respuesta1" class="uppercase tracking-wide dark:text-white text-md font-bold mb-4">
                                        Respuesta 1:
                                    </label>
                                    <input type="text" id="respuesta1" name="respuestas[][respuesta]"
                                        value="{{ old('respuestas.0.respuesta') }}"
                                        class="mt-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm
                                        rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    @error('respuestas.0.respuesta')
                                        <small>Tienes que ingresar una respuesta</small>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="respuesta2" class="uppercase tracking-wide dark:text-white text-md font-bold mb-4">
                                        Respuesta 2:
                                    </label>
                                    <input type="text" id="respuesta2" name="respuestas[][respuesta]"
                                        value="{{ old('respuestas.1.respuesta') }}"
                                        class="mt-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm
                                        rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    @error('respuestas.1.respuesta')
                                        <small>Tienes que ingresar una respuesta</small>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="respuesta3" class="uppercase tracking-wide dark:text-white text-md font-bold mb-4">
                                        Respuesta 3:
                                    </label>
                                    <input type="text" id="respuesta3" name="respuestas[][respuesta]"
                                        value="{{ old('respuestas.2.respuesta') }}"
                                        class="mt-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm
                                        rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    @error('respuestas.2.respuesta')
                                        <small>Tienes que ingresar una respuesta</small>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="respuesta4" class="uppercase tracking-wide dark:text-white text-md font-bold mb-4">
                                        Respuesta 4:
                                    </label>
                                    <input type="text" id="respuesta4" name="respuestas[][respuesta]"
                                        value="{{ old('respuestas.3.respuesta') }}"
                                        class="mt-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm
                                        rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    @error('respuestas.3.respuesta')
                                        <small>Tienes que ingresar una respuesta</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center items-center">
                        <div class="">
                            <a href="{{ route($user_route.'plan_de_negocio.estudio.encuesta.index', [$plan_de_negocio, $estudio]) }}" class="m-4 bg-red-900 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-red-800 rounded-xl">
                                Cancelar
                            </a>

                            <button class="m-4 dark:bg-blue-800 text-white bg-blue-600 hover:bg-blue-500 font-bold py-4 px-10 border-gray-500 dark:hover:bg-blue-700 rounded-xl">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>