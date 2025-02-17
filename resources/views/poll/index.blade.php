<x-app-layout class="flex flex-nowrap">

    <x-second-sidebar :plan_de_negocio="$plan_de_negocio" :estudio="$estudio"></x-sidebar>

    <div class="w-full h-screen overflow-auto">
        <div>
            <div class="mx-20 flex items-center justify-center">
                <h1 class="dark:text-gray-100 mt-6 text-2xl">Encuestas del estudio de mercado</h1>
            </div>

            @php $user_route = ''; @endphp

            @if ( auth()->user()->rol == 'admin')
                @php $user_route = 'admin_'; @endphp
            @elseif ( auth()->user()->rol == 'asesor')
                @php $user_route = 'asesor_'; @endphp
            @endif

            <div class="flex justify-center">
                <a class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-md font-medium text-white bg-slate-600 hover:bg-slate-500 border border-gray-300 rounded-lg hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                    href="{{ route($user_route.'plan_de_negocio.estudio.encuesta.create', [$plan_de_negocio, $estudio]) }}">
                    <span class="visible md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </span>            
                    <p class="hidden md:flex ">Nueva encuesta</p>
                </a>
            </div>
        </div>

        <div class="mx-20 flex flex-wrap mb-8 space-y-6 grid">
            <div class="pb-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class=" rounded-xl overflow-hidden my-8">
                        <div class="">
                            <div class="mb-6">
                            @if (sizeof($estudio->encuestas) == 0) 
                                <div class="dark:transparent w-full h-100 flex justify-center">
                                    <div class="m-10 px-6 py-4 text-2xl text-gray-900 dark:text-gray-400">
                                        <div class="flex justify-center mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 3v5h5M12 18v-6M9 15h6"/></svg>
                                        </div>
                                        <p class="text-center dark:text-gray-300 text-gray-400 font-bold w-full">  
                                            Agrega un nuevos conceptos al estudio +
                                        </p>
                                    </div>
                                </div>
                            @endif

                                @foreach ($estudio->encuestas as $encuesta)
                                    <div class="mb-3 max-w-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
                                        <h6 class="bg-slate-600 mb-4 p-4 pb-2 border-b-4 dark:border-gray-700 font-bold tracking-tight text-gray-200 text-xl">{{ $encuesta->titulo }}</h6>
                                        <p class="mb-3 font-normal dark:text-gray-200 text-gray-700 px-4 text-lg">{{ $encuesta->descripcion }}</p>
                                        <div class="flex justify-center space-x-4 mb-6 pb-6">
                                            <a href="{{ route($user_route.'plan_de_negocio.estudio.encuesta.show', [$plan_de_negocio, $estudio, $encuesta]) }}" class="inline-flex items-center py-2 px-3 text-md font-bold text-center text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                Ver mas
                                                <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </a>
                                            <form class="eliminar" action="{{ route($user_route.'plan_de_negocio.estudio.encuesta.destroy',[$plan_de_negocio, $estudio, $encuesta])  }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('¿Seguro que quieres borrar esta encuesta?')" href="{{ route('plan_de_negocio.estudio.encuesta.destroy', [$plan_de_negocio, $estudio, $encuesta]) }}" class="inline-flex items-center py-2 px-3 text-md font-bold text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                    Eliminar
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d8d8d8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>