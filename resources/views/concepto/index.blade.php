<x-app-layout class="flex flex-nowrap">

    <x-second-sidebar :plan_de_negocio="$plan_de_negocio" :estudio="$estudio"></x-sidebar>

    <div class="w-full h-screen overflow-auto">
        <div>
            <div class="mx-20 flex items-center justify-center">
                <h1 class="dark:text-gray-100 mt-6 text-2xl">Conceptos del estudio</h1>
            </div>

            @php $user_route = ''; @endphp

            @if ( auth()->user()->rol == 'admin')
                @php $user_route = 'admin_'; @endphp
            @elseif ( auth()->user()->rol == 'asesor')
                @php $user_route = 'asesor_'; @endphp
            @endif

            <div class="flex justify-center">
                <a class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-md font-medium text-white bg-slate-600 hover:bg-slate-500 border border-gray-300 rounded-lg hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                    href="{{ route($user_route.'plan_de_negocio.estudio.concepto.create', [$plan_de_negocio, $estudio]) }}">
                    <span class="visible md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </span>            
                    <p class="hidden md:flex ">Nuevo concepto</p>
                </a>
            </div>
        </div>

        <div class="mx-20 flex flex-wrap mb-8 space-y-6 grid justify-items-center">
            <div class="py-2 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden sm:rounded-lg">
                        <div class="p-6 dark:bg-gray-900">
                            <div class="mb-6 grid divide-y divide-gray-700 grid-flow-row auto-rows-min md:auto-rows-max dark:bg-gray-800 rounded-xl pl-10 pr-6 pb-4 pt-8">
                                @if (sizeof($estudio->conceptos) == 0)
                                <div class="dark:transparent w-full h-100 flex justify-center">
                                    <div class="m-10 px-6 py-4 text-2xl text-gray-900 dark:text-gray-400">
                                        <div class="flex justify-center mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                        </div>
                                        <p class="text-center dark:text-gray-300 text-gray-400 font-bold w-full">  
                                            Agrega un nuevos conceptos al estudio +
                                        </p>
                                    </div>
                                </div>
                                @endif

                                @if ($estudio->conceptos != null)
                                    @foreach ($estudio->conceptos as $concepto)
                                        <div x-data="{ view: true, edit: false }" class="mb-6 mr-6">
                                            <form
                                                action="{{ route($user_route.'plan_de_negocio.estudio.concepto.update', [$plan_de_negocio, $estudio, $concepto]) }}"
                                                method="post">
                                                @csrf
                                                @method('patch')
                                                <div class="flex items-center justify-between my-4">
                                                    <div x-show="view" class="mr-12 text-md mt-4">
                                                        <p class="text-lg dark:text-gray-300">{{ $concepto->concepto }}</p>
                                                    </div>
                                                    <div x-show="edit" class="w-full">
                                                        <input type="text" name="concepto"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                            value="{{ $concepto->concepto }}">
                                                        <div class="flex flex space-x-4 mt-6">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Actualizar</button>
                                                                <a @click="edit= false, view= true" class="cursor-pointer text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                                    Cancelar
                                                                </a>
                                                        </div>
                                                    </div>
                                                    <div x-show="view" class="flex">
                                                        <form method="post" action="{{ route('plan_de_negocio.estudio.concepto.destroy', [$plan_de_negocio, $estudio, $concepto]) }}">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                onclick="return confirm('¿Seguro que quieres borrar este plan de negocio?');"
                                                                class="mr-2 hover:text-red-700">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                            </button>
                                                        </form>
                                                        <a @click=" edit= true, view= false" class="hover:bg-gray-50 hover:text-sky-700 dark:text-sky-400 ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>