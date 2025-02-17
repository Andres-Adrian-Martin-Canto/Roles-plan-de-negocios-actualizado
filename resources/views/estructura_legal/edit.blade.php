<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="mx-20 flex items-center justify-center">
            <h1 class="dark:text-gray-100 text-slate-700 font-bold my-6 text-2xl">Actualizando la estructura legal</h1>
        </div>

        @if ($plan_de_negocio->estructura_legal->tipo_persona == 'Física')
            @php $persona = 'Física'; @endphp
        @else
            @php $persona = 'Moral'; @endphp
        @endif

        @php
            $input_contitucion = $plan_de_negocio->estructura_legal->constitucion_legal;
            $input_regimen = $plan_de_negocio->estructura_legal->regimen_fiscal;
        @endphp

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 bg-white dark:bg-gray-900 p-6 flex flex-col items-center justify-center">
            <form method="POST" action="{{ route($user_route.'plan_de_negocio.estructura_legal.update', [$plan_de_negocio, $estructura_legal]) }}" class="w-full px-20">
                @method('PATCH')
                @csrf
                <div x-data="{ options: ['Física', 'Moral'], selected: @js($persona) }" class="w-full">
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
                    <a href="{{ route($user_route.'plan_de_negocio.estructura_legal.index', [$plan_de_negocio]) }}" class="rounded bg-red-500 m-6 px-4 py-2 hover:bg-red-700 dark:text-white text-white font-bold">Cancelar</a>
                    {{-- <input  type="submit" value="Crear"> --}}
                    <button class="rounded bg-green-600 m-6 px-4 py-2 hover:bg-green-500 dark:text-white text-white font-bold">Actualizar</button>
                </div>
            <form>
        </div>

        <script>
            let all_inputs = document.querySelectorAll('input[type="radio"]');
            all_inputs.forEach(element => {
                if (element.value === "<?php echo $input_contitucion; ?>" || element.value === "<?php echo $input_regimen; ?>"){
                    element.checked = true;
                }
            });
        </script>

</x-app-layout>