<x-app-layout class="flex flex-nowrap">
    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="flex items-center justify-center">
            <h1 class="dark:text-gray-100 py-6 text-slate-700 font-bold text-2xl">Foda de la empresa</h1>
        </div>

        <div class="mx-20 bg-white p-6 dark:bg-gray-900 grid gap-x-10 gap-y-10 grid-cols-2 grid-rows-2 dark:text-gray-300">
            
            <div class="border divide-y divide-gray-500 rounded-md border-neutral-200 dark:border-none">
                <div class="flex items-stretch justify-center bg-gray-200 dark:bg-gray-700 space-x-2 rounded-t-md">
                    <x-foda.insert tipo="Fortalezas"></x-foda.insert>
                </div>
                <div class="flex flex-col divide-y divide-gray-400 bg-slate-100 dark:bg-gray-800 rounded-b-md">
                    @if(count($foda_data['fortalezas'])>0)                        
                        @foreach($foda_data['fortalezas'] as $fortaleza)
                        <div x-data="{ open: false }" class="flex items-center justify-between py-4 px-6 space-x-2">
                            <div :class="!open ? '' : 'hidden'">
                                <span :class="!open ? '' : 'hidden'">{{ $fortaleza->descripcion }}</span>
                            </div>
                            <div class="flex">
                                <button :class="!open ? '' : 'hidden'" type="button" @click="open = !open">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#607e81" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                </button>
                                <x-foda.update x-show="open" :plan_de_negocio="$plan_de_negocio" :foda="$fortaleza"></x-foda.update>
                                <x-foda.delete x-show="open" :plan_de_negocio="$plan_de_negocio" :foda="$fortaleza"></x-foda.delete>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="mx-auto pl-2 py-5"></div>
                    @endif
                </div>
            </div>

            <div class="border divide-y divide-gray-500 rounded-md border-neutral-200 dark:border-none">
                <div class="flex items-stretch justify-center bg-gray-200 dark:bg-gray-700 space-x-2 rounded-t-md">
                    <x-foda.insert tipo="Debilidades"></x-foda.insert>
                </div>
                <div class="flex flex-col divide-y divide-gray-500 bg-slate-100 dark:bg-gray-800 rounded-b-md">
                    @if(count($foda_data['debilidades']) > 0)
                        @foreach($foda_data['debilidades'] as $debilidad)
                            <div x-data="{ open: false }" class="flex items-center justify-between py-4 px-6 space-x-2">
                                <div :class="!open ? '' : 'hidden'">
                                    <span :class="!open ? '' : 'hidden'">{{ $debilidad->descripcion }}</span>
                                </div>
                                <div class="flex">
                                    <button :class="!open ? '' : 'hidden'" type="button" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#607e81" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                    </button>
                                    <x-foda.update x-show="open" :plan_de_negocio="$plan_de_negocio" :foda="$debilidad"></x-foda.update>
                                    <x-foda.delete x-show="open" :plan_de_negocio="$plan_de_negocio" :foda="$debilidad"></x-foda.delete>
                                </div>     
                            </div>
                        @endforeach
                    @else
                        <div class="mx-auto pl-2 py-5"></div>
                    @endif
                </div>
            </div>

            <div class="border divide-y divide-gray-500 rounded-md border-neutral-200 dark:border-none">
                <div class="flex items-stretch justify-center bg-gray-200 dark:bg-gray-700 space-x-2 rounded-t-md">
                    <x-foda.insert tipo="Amenazas"></x-foda.insert>
                </div>
                <div class="flex flex-col divide-y divide-gray-500 bg-slate-100 dark:bg-gray-800 rounded-b-md">
                    @if(count($foda_data['amenazas'])>0)
                        @foreach($foda_data['amenazas'] as $amenaza)
                            <div x-data="{ open: false }" class="flex items-center justify-between py-4 px-6 space-x-2">
                                <div :class="!open ? '' : 'hidden'">
                                    <span :class="!open ? '' : 'hidden'">{{ $amenaza->descripcion }}</span>
                                </div>
                                <div class="flex">
                                    <button :class="!open ? '' : 'hidden'" type="button" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#607e81" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                    </button>
                                    <x-foda.update x-show="open" :plan_de_negocio="$plan_de_negocio" :foda="$amenaza"></x-foda.update>
                                    <x-foda.delete x-show="open" :plan_de_negocio="$plan_de_negocio" :foda="$amenaza"></x-foda.delete>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mx-auto pl-2 py-5"></div>
                    @endif
                </div>
                
            </div>

            <div class="border divide-y divide-gray-500 rounded-md border-neutral-200 dark:border-none">
                <div class="flex items-stretch justify-center bg-gray-200 dark:bg-gray-700 space-x-2 rounded-t-md">
                    <x-foda.insert tipo="Oportunidades"></x-foda.insert>
                </div>
                <div class="flex flex-col divide-y divide-gray-500 bg-slate-100 dark:bg-gray-800 rounded-b-md">
                    @if(count($foda_data['oportunidades'])>0)
                        @foreach($foda_data['oportunidades'] as $oportunidad)
                            <div x-data="{ open: false }" class="flex items-center justify-between py-4 px-6 space-x-2">
                                <div :class="!open ? '' : 'hidden'">
                                    <span :class="!open ? '' : 'hidden'">{{ $oportunidad->descripcion }}</span>
                                </div>
                                <div class="flex">
                                    <button :class="!open ? '' : 'hidden'" type="button" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#607e81" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                    </button>
                                    <x-foda.update x-show="open" :plan_de_negocio="$plan_de_negocio" :foda="$oportunidad"></x-foda.update>
                                    <x-foda.delete x-show="open" :plan_de_negocio="$plan_de_negocio" :foda="$oportunidad"></x-foda.delete>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mx-auto pl-2 py-5"></div>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>