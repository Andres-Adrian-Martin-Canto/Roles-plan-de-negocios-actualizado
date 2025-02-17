<x-app-layout class="flex flex-nowrap">

    <x-second-sidebar :plan_de_negocio="$plan_de_negocio" :estudio="$estudio"></x-sidebar>

    <div class="w-full h-screen overflow-auto">
        <div>
            <div class="mx-20 flex items-center justify-center">
                <h1 class="dark:text-gray-100 mt-6 text-2xl">{{ $encuestum->titulo }}</h1>
            </div>

            @php $user_route = ''; @endphp

            @if ( auth()->user()->rol == 'admin')
                @php $user_route = 'admin_'; @endphp
            @elseif ( auth()->user()->rol == 'asesor')
                @php $user_route = 'asesor_'; @endphp
            @endif

            <div class="flex justify-center">
                <a class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-md font-medium text-white bg-slate-600 border border-gray-300 rounded-lg hover:bg-slate-500 hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                    href="{{ route($user_route.'plan_de_negocio.estudio.encuesta.pregunta.create', [$plan_de_negocio, $estudio, $encuestum]) }}">
                    <span class="visible md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </span>            
                    <p class="hidden md:flex ">Crear una pregunta</p>
                </a>
                @php ($slug = $encuestum->titulo)
                <a class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-md font-medium text-white bg-slate-600 hover:bg-slate-500 border border-gray-300 rounded-lg hover:white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                    href="{{ route($user_route.'plan_de_negocio.estudio.encuesta.formulario.show', [$plan_de_negocio, $estudio, $encuestum, $slug]) }}">
                    <p class="hidden md:flex ">Contestar encuesta</p>
                </a>
            </div>
        </div>

        <div class="mx-20 flex flex-wrap mb-8 space-y-6 dark:bg-gray-800 bg-white grid">
            <div class="p-6 mt-2 pt-8" id="contenedor">
                @if (sizeof($encuestum->preguntas) == 0)
                    <div class="dark:transparent w-full h-100 flex justify-center">
                        <div class="m-10 px-6 py-4 text-2xl text-gray-900 dark:text-gray-400">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </div>
                            <p class="text-center dark:text-gray-300 text-gray-400 font-bold w-full">  
                                Agrega una nueva pregunta a la encuesta +
                            </p>
                        </div>
                    </div>    
                @else
                    @foreach ($encuestum->preguntas as $preguntum )
                        <div class="mb-6">
                            <div class="flex flex-col md:flex-row justify-between">
                                <div>
                                    <h1 class="text-gray-800 dark:text-gray-300 mb-4 mr-2 font-semibold text-xl">{{ $preguntum->pregunta }}</h1>
                                </div>
                                <div class="flex flex-row mb-6">
                                    <div>
                                        <a href="{{ route($user_route.'plan_de_negocio.estudio.encuesta.pregunta.edit',[$plan_de_negocio, $estudio, $encuestum, $preguntum]) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium mr-2 p-1.5 rounded">Editar</a>
                                    </div>
                                    <div>
                                        <form class="eliminar" action="{{ route($user_route.'plan_de_negocio.estudio.encuesta.pregunta.destroy',[$plan_de_negocio, $estudio, $encuestum, $preguntum]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('¿Seguro que quieres borrar esta pregunta?');" type="submit" id="btn_eliminar" class="flex bg-red-600 hover:bg-red-700 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">
                                                <p class="text-white p-0.5 text-sm">Eliminar</p>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex">
                                @foreach ($preguntum->respuestas as $respuesta )
                                    <li class="w-full dark:bg-gray-300 rounded border-b border-gray-500 text-center sm:border-b-0 sm:border-r py-2">
                                        {{ $respuesta->respuesta }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>