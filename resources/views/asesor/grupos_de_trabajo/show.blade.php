<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-100">
                <p class="text-2xl font-bold text-center p-4">{{ $grupo->nombre_grupo }}</p>
            <a class="flex flex-nowrap md:rounded-md bg-slate-700 text-white dark:md:bg-gray-700 md:p-2" href="{{ route('grupo.edit', [$grupo])}}">          
                <p class="hidden md:flex ">Editar</p>
            </a>
        </div>
    </x-slot>

    <div class="mx-auto justify-center px-auto dark:text-gray-100 px-20 py-6">
        <div class="w-full flex justify-center mb-4">
            <a class="flex flex-nowrap md:rounded-md dark:md:bg-gray-700 md:p-2 bg-blue-500 text-white" href="{{ route('grupo.index', [$grupo])}}">
                <span class="visible md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>            
                <p class="hidden md:flex ">Añadir integrante</p>
            </a>
        </div>

        <div class="flex my-2 relative overflow-x-auto shadow-md">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-base text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre del integrante
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $integrantes = $users @endphp
                    @if (sizeof($integrantes)==0)
                        <tr class="row-span-4 border-b dark:bg-gray-800 dark:border-gray-700">
                            <th colspan = "5" scope="row" class="text-center bh-red px-6 py-8 text-lg text-gray-900 whitespace-nowrap dark:text-gray-400">
                                <div class="">
                                    Aún no tienes integrantes en tu grupo
                                </div>
                            </th>
                        </tr>
                    @else
                        @foreach ($integrantes as $integrante)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $integrante->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $integrante->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="inline-flex">
                                        <a href="{{ route('planes.index', [$integrante->id]) }}" class="inline-flex items-center px-1.5 py-1.5 bg-blue-500 hover:bg-blue-400 dark:bg-blue-700 dark:hover:bg-blue-600 text-white text-sm font-medium rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
                                        </a>

                                        <form method="post" action="{{ route('grupo.destroy', [$grupo, $integrante->id]) }}">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('El usuario se eliminará permanentemente, ¿Desea continuar?');"
                                                class="inline-flex
                                                    items-center 
                                                    px-1.5
                                                    py-1.5
                                                    dark:bg-red-800
                                                    dark:hover:bg-red-700
                                                    text-white
                                                    text-sm
                                                    font-medium
                                                    bg-red-700
                                                    hover:bg-red-600
                                                    rounded-md ml-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


    </div>
</x-app-layout>
