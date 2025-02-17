<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-100">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Asesor') }}
            </h2>
            <a class="flex flex-nowrap md:rounded-md bg-slate-700 text-white dark:md:bg-gray-700 md:p-2" href="{{ route('grupos_de_trabajo.create')}}">
                <span class="visible md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>            
                <p class="hidden md:flex ">Nuevo grupo de trabajo</p>
            </a>
        </div>
    </x-slot>

    <div class="flex flex-wrap mx-auto justify-center px-auto dark:text-gray-100 m-4">
        <div class="w-full border-b-2 dark:border-gray-800 border-gray-300 mx-8">
            <p class="text-2xl font-bold text-gray-700 text-center p-4">Tus grupos de trabajo</p>
        </div>
        @if (sizeof($grupos) == 0)
            <div class="dark:transparent w-full h-100 flex justify-center">
                <div class="m-10 px-6 py-8 text-2xl text-gray-900 dark:text-gray-400">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>                       
                         
                    </div>
                    <p class="text-center text-gray-500 w-full">  
                        Agrega un nuevo grupo para añadir usuarios +
                    </p>
                </div>
            </div>
        @else
            @foreach ($grupos as $grupo)
                <a class="
                    w-full
                    bg-white
                    rounded-xl
                    overflow-hidden 
                    shadow-lg
                    mx-4
                    my-2
                    md:w-1/4
                    dark:bg-gray-800
                    hover:bg-gray-50
                    dark:hover:bg-gray-700"
                    href="{{ route('grupo.show', [$grupo]) }}"
                    >
                    <div class="">
                        <div class="flex items-center justify-between font-bold text-xl mb-2 dark:border-none dark:bg-transparent bg-pink-700 text-white px-6 py-3 dark:pb-2">
                            {{ $grupo->nombre_grupo }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#ebebeb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <p class="mx-6 text-base dark:border-t-2 dark:border-gray-600 pt-2">{{ $grupo->descripcion }}</p>
                        <div class="mx-6 my-2 text-base dark:border-t-4 dark:border-gray-600 bg-transparent-600 w-auto inline-block rounded-lg font-bold text-pink-800 border-2 border-pink-800 dark:text-gray-300 dark:border-gray-500 py-1 px-2">
                            <p>Integrantes: {{count(json_decode($grupo->integrantes)) }}</p>
                        </div>

                        <div class="flex justify-between mx-6 my-4 text-base text-right mt-2 border-t-2 border-gray-300 dark:border-none pt-2">
                            <form method="post" action="{{ route('grupo_destroy', [$grupo->id]) }}">
                                @method('delete')
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('¿Seguro que quieres borrar este plan de negocio?');"
                                    class="inline-flex
                                        items-center 
                                        px-1.5
                                        py-1.5
                                        dark:bg-gray-500
                                        bg-pink-500
                                        hover:bg-pink-600
                                        text-white
                                        text-sm
                                        font-medium
                                        rounded-md ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </form>
                            <p class="">{{ $grupo->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</x-app-layout>
