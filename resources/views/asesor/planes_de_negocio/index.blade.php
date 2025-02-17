<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-100">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Planes de negocio') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex flex-wrap mx-auto justify-center px-auto dark:text-gray-100 m-4">
        @if(sizeof($planes) == 0)
            <div class="dark:transparent w-full h-100 flex justify-center">
                <div class="m-10 px-6 py-8 text-2xl text-gray-900 dark:text-gray-400">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 21H4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h5l2 3h9a2 2 0 0 1 2 2v2M21.12 15.88l-4.24 4.24M16.88 15.88l4.24 4.24"/></svg>                    </div>
                    <p class="text-center text-gray-500 w-full">  
                        Usuario sin planes de negocio
                    </p>
                </div>
            </div>
        @else
            @foreach ($planes as $plan_de_negocio)
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
                    href="{{ route('asesor_plan_de_negocio.generalidades.index', [$plan_de_negocio]) }}"
                    >
                    <div class="">
                        <div class="flex items-center justify-between font-bold text-xl mb-2 dark:border-none dark:bg-transparent bg-cyan-700 text-white px-6 py-3 dark:pb-2">
                            {{ $plan_de_negocio->nombre }}
                            <svg class="ml-4" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#cfcfcf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        </div>
                        <p class="mx-6 text-base dark:border-t-2 dark:border-gray-600 pt-2">{{ $plan_de_negocio->descripcion }}</p>
                        <div class="flex justify-between mx-6 my-4 text-base text-right mt-6 border-t-2 border-gray-300 dark:border-none pt-2">
                            <div>
                                <form action="{{ route('asesor_plan_de_negocio.edit', [$plan_de_negocio]) }}">
                                    <button class="inline-flex items-center px-1.5 py-1.5 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium rounded-md ml-2" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                    </button>
                                </form>
                            </div>
                            <p class="">{{ $plan_de_negocio->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
</x-app-layout>