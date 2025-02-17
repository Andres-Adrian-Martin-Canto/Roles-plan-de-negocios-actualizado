<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-100">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('PLANES DE NEGOCIO') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto justify-center dark:text-gray-100 px-20 py-8">
        <div class="mb-6 w-full bg-white dark:bg-gray-800 rounded-xl p-4">
            <!--Search text-->
            <div class="flex justify-end mb-2">

                <div class="w-full">
                    <form action="{{ route('admin_plan_de_negocio.index',[$planes]) }}" method="GET">
                        <div class="relative mb-4 flex w-full flex-wrap items-stretch">

                            <div class="w-1/3">
                                <div>
                                    <a href="{{ route('admin_plan_de_negocio.index') }}" class="bg-blue-500 hover:bg-blue-400 text-white mb-3 inline-flex items-center px-4 py-2 mr-3 text-base font-medium text-gray-300 border border-gray-300 rounded-lg dark:hover:bg-gray-200 hover:text-gray-white dark:bg-gray-700 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                                    Ver todos
                                    </a>
                                </div>
                            </div>

                            <!--Buscar por...-->
                            <div class="mr-2">
                                <div class="relative inline-flex self-center">
                                    <svg class="text-white bg-gray-600 absolute top-0 right-0 mx-2 my-3 pointer-events-none p-2 rounded" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26px" height="26px" viewBox="0 0 38 22" version="1.1">
                                        <g id="ZahnhelferDE—Design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="ZahnhelferDE–Icon&amp;Asset-Download" transform="translate(-539.000000, -199.000000)" fill="#ffffff" fill-rule="nonzero">
                                                <g id="Icon-/-ArrowRight-Copy-2" transform="translate(538.000000, 183.521208)">
                                                    <polygon id="Path-Copy" transform="translate(20.000000, 18.384776) rotate(135.000000) translate(-20.000000, -18.384776) " points="33 5.38477631 33 31.3847763 29 31.3847763 28.999 9.38379168 7 9.38477631 7 5.38477631"/>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <select name="tipo" class="text-base font-bold rounded border-2 border-gray-700 text-gray-600 h-auto w-auto py-3 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                        <option value="nombre">Por nombre del negocio</option>
                                        <option value="name">Por nombre del autor</option>
                                    </select>
                                </div>
                            </div>
                            
                            <input type="search"
                                name="search"
                                class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l-xl border border-solid border-neutral-400 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary dark:focus:text-neutral-200 focus:text-neutral-800 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-400 dark:focus:border-primary"
                                placeholder="Buscar..."
                                aria-label="Search"
                                aria-describedby="button-addon1" />

                            <!--Search button-->
                            <button
                                class="relative z-[2] flex bg-blue-500 items-center rounded-r bg-primary dark:bg-gray-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
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


             <!--Search date-->
             <div class="mb-4">
                <div class="flex justify-end">
                    <form action="{{ route('admin_plan_de_negocio.index',[$planes]) }}" method="GET">
                        <div class="flex space-x-8">
                            <button class="bg-blue-500 rounded-xl relative z-[2] flex items-center rounded-r bg-primary dark:bg-gray-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                                    type="submit" id="button-addon1" data-te-ripple-init data-te-ripple-color="light">
                                Buscar por fecha
                            </button>
                            <div>
                                <label class="pr-2">Primera fecha: </label>
                                <input type="date" class="rounded-md form-control dark:text-gray-600" name="fdate">
                            </div>
                            <div>
                                <label class="pr-2">Segunda fecha:</label>
                                <input type="date" class="rounded-md form-control dark:text-gray-600" name="sdate">
                            </div>
                        </div>
                    </form>
                </diV>
            </div>

        </div>
        <div class="my-2 relative overflow-x-auto shadow-md">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-base text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre del plan de negocio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descripción
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de creación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Autor
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (sizeof($planes)==0)
                        <tr class="row-span-4 border-b dark:bg-gray-800 dark:border-gray-700">
                            <th colspan = "5" scope="row" class="text-center bh-red px-6 py-8 text-lg text-gray-900 whitespace-nowrap dark:text-gray-400">
                                <div class="">

                                </div>
                            </th>
                        </tr>
                    @else
                        @foreach ($planes as $plan)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $plan->nombre }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $plan->descripcion }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $plan->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $plan->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="inline-flex">
                                        <a href="{{ route('admin_plan_de_negocio.edit', [$plan->id]) }}" class="inline-flex items-center px-1.5 py-1.5 bg-sky-600 hover:bg-sky-500 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-sm font-medium rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                        </a>

                                        <a href="{{ route('admin_plan_de_negocio.generalidades.index', [$plan->id]) }}" class="ml-2 inline-flex items-center px-1.5 py-1.5 bg-cyan-500 hover:bg-cyan-400 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-sm font-medium rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h13M12 5l7 7-7 7"/></svg>
                                        </a>

                                        <form method="post" action="{{ route('admin_plan_de_negocio.destroy', [$plan->id]) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('El plan de negocio se eliminará igual para el usuario ¿Continuar?');"
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
        
        <div class="m-6 grid justify-items-center">
            <div class="w-1/4">
                {{ $planes->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
