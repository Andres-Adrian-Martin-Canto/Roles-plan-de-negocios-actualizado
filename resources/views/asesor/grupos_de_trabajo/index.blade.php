<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-100">
            <div class="w-full border-b-2 dark:border-gray-800 border-gray-300 mx-8">
                <p class="text-2xl font-bold text-center p-4">{{ $grupo->nombre_grupo }}</p>
            </div>
        </div>
    </x-slot>

    <div class="justify-center dark:text-gray-100 bg-white dark:bg-gray-800 mx-40 my-20 p-8">
        
        <diV class="flex justify-center">
            <div class="w-1/2">
                <form action="{{ route('grupo.index', [$grupo]) }}" method="GET">
                    <div class="relative mb-4 flex w-full flex-wrap items-stretch">                       
                        <input type="search"
                            name="search"
                            class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-white bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-gray-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-gray-500 dark:focus:border-primary"
                            placeholder="Buscar por correo..."
                            aria-label="Search"
                            aria-describedby="button-addon1" />

                        <!--Search button-->
                        <button
                            class="relative z-[2] flex items-center rounded-r bg-blue-500 dark:bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                            type="submit"
                            id="button-addon1"
                            data-te-ripple-init
                            data-te-ripple-color="light">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                class="h-5 w-5">
                                    <path
                                        fill-rule="evenodd"
                                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                        clip-rule="evenodd" />
                            </svg>
                        </button>

                    </div>
                </form>
            </div>
        </div>

        <div class="flex my-2 relative overflow-x-auto">
            @if (!isset($usuarios))
                <div class="dark:transparent w-full flex justify-center">
                    <div class="text-center bh-red px-6 text-lg text-gray-900 whitespace-nowrap dark:text-gray-400">
                        <p class="text-2xl">
                            Busca un usuario por su correo y añadelo!
                        </p>
                        <div class="flex justify-center mt-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                        </div> 
                    </div>
                </div>
            @else
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
                        @foreach ($usuarios as $usuario)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $usuario->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $usuario->email }}
                                </td>
                                <td class="px-6 py-4">
                                    @if(!in_array($usuario->id, $array_usuarios))
                                        <div class="inline-flex">
                                            <form method="post" action="{{ route('grupo.update', [$grupo, $usuario->id]) }}">
                                                @method('PATCH')
                                                @csrf
                                                <button type="submit"
                                                    onclick="return confirm('El usuario agregará a tu grupo, ¿Desea continuar?');"
                                                    class="inline-flex
                                                        items-center 
                                                        px-1.5
                                                        py-1.5
                                                        dark:bg-blue-800
                                                        dark:hover:bg-blue-700
                                                        text-white
                                                        text-sm
                                                        font-medium
                                                        bg-blue-600
                                                        hover:bg-blue-500
                                                        rounded-md ml-2">
                                                        <p class="mr-1">Añadir</p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                    <div class="inline-flex">
                                        <button disabled
                                            class="inline-flex
                                            items-center 
                                            px-1.5
                                            py-1.5
                                            dark:bg-gray-600
                                            dark:hover:bg-gray-700
                                            text-white
                                            text-sm
                                            font-medium
                                            bg-gray-500
                                            hover:bg-gray-500
                                            rounded-md ml-2">
                                            <p class="mr-1">Ya añadido</p>
                                        </button>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


    </div>
</x-app-layout>
