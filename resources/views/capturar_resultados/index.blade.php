<x-app-layout class="flex flex-nowrap">

    <x-second-sidebar :plan_de_negocio="$plan_de_negocio" :estudio="$estudio"></x-sidebar>

    <div class="w-full h-screen overflow-auto">
        <div>
            <div class="mx-20 flex items-center justify-center">
                <h1 class="dark:text-gray-100 mt-6 text-2xl">Capturar resultados</h1>
            </div>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 flex flex-wrap mb-8 space-y-6 grid justify-items-center">
            <div class="py-6 w-full">
                <div class="dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
                    <div class="py-2 px-10 dark:bg-gray-800 bg-white w-full">
                        <div class="mb-6">
                            @if (sizeof($estudio->conceptos) == 0)
                                <div class="dark:transparent w-full h-100 flex justify-center">
                                    <div class="m-10 px-6 py-4 text-2xl text-gray-900 dark:text-gray-400">
                                        <div class="flex justify-center mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                        </div>
                                        <p class="text-center dark:text-gray-300 text-gray-400 font-bold w-full">  
                                            Sin conceptos a los cuales agregar un resultado, agregalos en el area de conceptos
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @foreach ($estudio->conceptos as $concepto)
                                <form action="{{ route($user_route.'plan_de_negocio.estudio.capturar_resultado.update',[$plan_de_negocio, $estudio, $concepto]) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div x-data="{view: true, edit: false}" class="flex flex-col md:flex-row items-center my-8">
                                        <div class="basis-2/4 mr-4">
                                            <label for="{{ $concepto->concepto }}" class="dark:text-gray-200 text-lg uppercase">{{ $concepto->concepto }}</label>
                                        </div>
                                        <textarea name="conclusion" placeholder="Agregar conclusión" rows="4" id="{{ $concepto->concepto }}" x-bind:disabled="view"
                                            class="block p-2.5 w-full text-md text-gray-900 bg-gray-50 rounded border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{
                                                $concepto->conclusion == "" ? "": $concepto->conclusion
                                            }}</textarea>
                                        <div class="mx-4" x-show="view">
                                            <a @click=" view= false, edit= true"  class="text-white text-base bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 py-2.5 text-center ml-10 mr-2 md:mr-0">Editar</a>
                                        </div>
                                        <div class="mx-4" x-show="edit">
                                            <button class="mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-base px-4 py-2.5 my-1 text-center">Guardar</button>
                                            <a @click=" view= true, edit= false"  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-base px-4 py-2.5 my-1 text-center">Cancelar</a>
                                        </div>
                                    </div>
                                    <hr class="my-8 h-px border-gray-300 dark:border-gray-600 border">
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>