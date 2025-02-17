<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="mx-20 flex items-center justify-center">
            <h1 class="dark:text-gray-100 my-6 text-2xl text-slate-700 font-bold">Estructura legal</h1>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 flex bg-white dark:bg-gray-900 p-6 flex-col items-center justify-center">
            @if($plan_de_negocio->estructura_legal == null)
            <form method="POST" action="{{ route($user_route.'plan_de_negocio.estructura_legal.store', [$plan_de_negocio]) }}" class="w-full px-20">
                @csrf
                <div x-data="{ options: ['Física', 'Moral'], selected: 'Física' }" class="w-full">
                    <div class="flex justify-center">
                        <div>
                            <label class="text-gray-700 dark:text-white text-lg">Tipo de persona
                                <select x-model="selected" name="tipo_persona" class="text-gray-800 ml-4 text-lg"
                                x-on:change="$let = document.querySelectorAll('input'); $let.forEach(element => element.checked = false);">
                                    <template x-for="option in options" :key="option">
                                        <option
                                            x-bind:value="option" 
                                            x-text="option"
                                            x-bind:selected="option === selected"
                                        ></option>
                                    </template>
                                </select>
                            </label>
                        </div>
                    </div>

                    <!--Tabla-->
                    <!--Persona fisica-->
                    <div class="flex my-9 relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-base text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Constitución legal
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Régimen fiscal
                                    </th>
                                </tr>
                            </thead>
                            <tbody x-show="selected == 'Física'">
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-pink-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-pink-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10 border-gray-300 focus:border-transparent focus:ring-0" 
                                            type="radio" required
                                            name="constitucion_legal"
                                            id="const_fisica_1"
                                            value="Constitución - Persona Física 1"
                                            />
                                        <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="const_fisica_1"
                                            >Const fisica 1</label>
                                    </td>
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-pink-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-pink-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10 border-gray-300 focus:border-transparent focus:ring-0"
                                            type="radio" required
                                            name="regimen_fiscal"
                                            id="actividad_empresarial"
                                            value="Actividad Empresarial" />
                                        <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="actividad_empresarial"
                                            >Actividad empresarial</label>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        
                                    </td>
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-pink-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-pink-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10 border-gray-300 focus:border-transparent focus:ring-0"
                                            type="radio" required
                                            name="regimen_fiscal"
                                            id="servicios_profesionales"
                                            value="Servicios Profesionales" />
                                        <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="servicios_profesionales"
                                            >Servicios profesionales</label>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        
                                    </td>
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-pink-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-pink-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10 border-gray-300 focus:border-transparent focus:ring-0"
                                            type="radio" required
                                            name="regimen_fiscal"
                                            id="arrendamiento"
                                            value="Arrendamiento" />
                                        <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="arrendamiento"
                                            >Arrendamiento</label>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        
                                    </td>
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-pink-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-pink-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10 border-gray-300 focus:border-transparent focus:ring-0"
                                            type="radio" required
                                            name="regimen_fiscal"
                                            id="incorporacion_fiscal"
                                            value="Incorporacion Fiscal" />
                                        <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="incorporacion_fiscal"
                                            >Incorporación fiscal</label>
                                    </td>
                                </tr>
                            </tbody>

                            <!--Persona moral-->
                            <tbody x-show="selected == 'Moral'">
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-pink-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-pink-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10 border-gray-300 focus:border-transparent focus:ring-0" 
                                            type="radio" required
                                            name="constitucion_legal"
                                            id="conts_moral_1"
                                            value="Constitución - Persona Moral 1"
                                            />
                                        <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="conts_moral_1"
                                            >Const moral 1</label>
                                    </td>
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-pink-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-pink-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10 border-gray-300 focus:border-transparent focus:ring-0"
                                            type="radio" required
                                            name="regimen_fiscal"
                                            id="acumlacion_ingresos"
                                            value="Acumulacion de Ingresos" />
                                        <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="acumlacion_ingresos"
                                            >Acumulación de ingresos</label>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        
                                    </td>
                                    <td scope="row" class="px-10 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-pink-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-pink-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10 border-gray-300 focus:border-transparent focus:ring-0"
                                            type="radio" required
                                            name="regimen_fiscal"
                                            id="regimen_general"
                                            value="Régimen General" />
                                        <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="regimen_general"
                                            >Régimen general</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                
                </div>

                <div class="flex justify-center items-center"> 
                    <input type="submit" value="Guardar" class="cursor-pointer mr-4 text-white space-x-2 rounded p-2 font-bold bg-blue-600 hover:bg-blue-500 dark:bg-blue-800 dark:hover:bg-blue-900">
                </div>
            </form>
            @else
            <!--Detalles guardados de la estructura legal-->
                <div class="text-white">
                    <div class="max-w-sm w-full lg:max-w-full lg:flex">
                        <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                            <div class="mb-8">
                                <div class="text-gray-900 font-bold text-xl m-4 mb-6 font-mono text-center">Detalles de la estructura legal</div>
                                <div class="divide-y divide-neutral-300">
                                    <p class="text-gray-700 text-base font-mono m-4 py-3"><strong>Tipo de persona con el que se dió registro a la empresa:</strong> <br>
                                        @if ( $plan_de_negocio->estructura_legal->tipo_persona == 'Física')
                                            PERSONA FÍSICA
                                        @else
                                            PERSONA MORAL
                                        @endif
                                    </p>

                                    <p class="text-gray-700 text-base font-mono m-4 py-3"><strong>Constitución legal:</strong> <br>
                                        {{ $plan_de_negocio->estructura_legal->constitucion_legal }}
                                    </p>

                                    <p class="text-gray-700 text-base font-mono m-4 py-3"><strong>Régimen fiscal de la empresa:</strong> <br>
                                        {{ $plan_de_negocio->estructura_legal->regimen_fiscal }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inline-flex">
                    <a href="{{ route($user_route.'plan_de_negocio.estructura_legal.edit', [$plan_de_negocio, $plan_de_negocio->estructura_legal]) }}" class="mt-6 inline-flex items-center px-2 py-2 bg-blue-700 hover:bg-blue-800 text-white text-md font-medium rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                        <div class="mx-2">Editar</div>
                    </a>
                    <form method="post" action="{{ route($user_route.'plan_de_negocio.estructura_legal.destroy', [$plan_de_negocio, $plan_de_negocio->estructura_legal]) }}">
                        @method('delete')
                        @csrf
                        <button type="submit"
                            onclick="return confirm('¿Eliminar la estructura legal guardada?');"
                            class="mt-6 inline-flex items-center px-2 py-2 bg-red-700 hover:bg-red-800 text-white text-md font-medium rounded-md ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            <div class="mx-2">Eliminar</div>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>