<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>

    <div class="w-full h-screen overflow-auto">
        <div>
            <div class="mx-20 flex items-center justify-center">
                <h1 class="dark:text-gray-100 mt-6 font-bold text-slate-700 text-2xl">Estudios de mercado</h1>
            </div>
            
            @php $user_route = ''; @endphp

            @if ( auth()->user()->rol == 'admin')
                @php $user_route = 'admin_'; @endphp
            @elseif ( auth()->user()->rol == 'asesor')
                @php $user_route = 'asesor_'; @endphp
            @endif

            <div class="flex justify-center">
                <a class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-md font-medium text-white bg-slate-600 border border-gray-300 rounded-lg hover:bg-slate-500 hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                    href="{{ route($user_route.'plan_de_negocio.estudio.create', [$plan_de_negocio])}}">
                    <span class="visible md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </span>            
                    <p class="hidden md:flex text-lg">Nuevo estudio de mercado</p>
                </a>
            </div>
        </div>
    
        <div class="flex flex-wrap mx-auto justify-center px-auto dark:text-gray-100 m-4">
            @if (sizeof($plan_de_negocio->estudios) == 0)
                <div class="dark:transparent w-full h-100 flex justify-center">
                    <div class="m-10 px-6 py-8 text-2xl text-gray-900 dark:text-gray-400">
                        <div class="flex justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6"/><path d="M14 3v5h5M18 21v-6M15 18h6"/></svg>
                        </div>
                        <p class="text-center dark:text-gray-300 text-gray-400 font-bold w-full">  
                            Agrega un nuevo estudio de mercado +
                        </p>
                    </div>
                </div>
            @else
                @foreach ($plan_de_negocio->estudios as $estudio)
                    <a class="
                        w-full
                        bg-white
                        rounded-lg
                        overflow-hidden 
                        shadow-lg
                        mx-4
                        my-2
                        md:w-1/4
                        dark:bg-gray-800
                        hover:bg-gray-50
                        dark:hover:bg-gray-700"
                        href="{{ route($user_route.'plan_de_negocio.estudio.show', [$plan_de_negocio, $estudio]) }}"
                        >
                        <div class="">
                            <div class="flex items-center justify-between font-bold text-xl mb-2 dark:border-none dark:bg-transparent bg-cyan-700 text-white px-6 py-3 dark:pb-2">
                                {{ $estudio->nombre }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/></svg>
                            </div>
                            <p class="mx-6 text-base dark:border-t-2 dark:border-gray-600 pt-2">{{ $estudio->objetivo }}</p>
                            
                            <div class="flex justify-between mx-6 my-4 text-base text-right mt-6 border-t-2 border-gray-300 dark:border-none pt-2">
                                <form method="post" action="{{ route($user_route.'plan_de_negocio.estudio.destroy', [$plan_de_negocio, $estudio]) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"
                                        onclick="return confirm('¿Seguro que quieres borrar este estudio de mercado?');"
                                        class="inline-flex
                                            items-center 
                                            px-1.5
                                            py-1.5
                                            bg-cyan-600
                                            hover:bg-cyan-700
                                            text-white
                                            text-sm
                                            font-medium
                                            rounded-md ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </form>
                                <p class="">{{ $plan_de_negocio->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
