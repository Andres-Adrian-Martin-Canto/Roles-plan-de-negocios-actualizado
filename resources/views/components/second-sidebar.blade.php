@props([
    'plan_de_negocio' => '',
    'estudio' => ''
])

@php $user_route = ''; @endphp

@if ( auth()->user()->rol == 'admin')
    @php $user_route = 'admin_'; @endphp
@elseif ( auth()->user()->rol == 'asesor')
    @php $user_route = 'asesor_'; @endphp
@endif

<div class="">
    <div class="
        hidden
        w-60
        min-h-screen
        p-4
        md:flex
        bg-slate-700
        text-white
        border-none
        dark:bg-gray-800
        dark:text-gray-100"
        >
    
        <aside class="h-full space-y-4 text-base font-normal">
            <div class="flex flex-nowrap space-x-2">
                <a href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 010 1.06l-2.47 2.47H21a.75.75 0 010 1.5H4.81l2.47 2.47a.75.75 0 11-1.06 1.06l-3.75-3.75a.75.75 0 010-1.06l3.75-3.75a.75.75 0 011.06 0z" clip-rule="evenodd" />
                    </svg>          
                </a>
                <span>
                    @if ($user_route == 'admin_')
                        <p class="bg-red-800 text-white rounded-xl p-2">ADMINISTRADOR</p>
                    @elseif ($user_route == 'asesor_')
                        <p class="bg-blue-800 p-1">ASESOR</p>
                    @else
                        CIIE
                    @endif
                </span>
            </div>

            <div class="flex flex-col divide-y divide-gray-700">
                <div>
                    <!-- Button -->
                    <a href="{{ route($user_route.'plan_de_negocio.estudio.show', [$plan_de_negocio, $estudio]) }}" class="hover:bg-slate-800 flex w-full items-center gap-2 p-4 my-1 rounded-md hover:bg-gray-200 hover:dark:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c4c4c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        Detalles del estudio
                    </a>
                </div>

                <div class="relative">
                    <!-- Button -->
                    <a href="{{ route($user_route.'plan_de_negocio.estudio.concepto.index', [$plan_de_negocio, $estudio]) }}" class="hover:bg-slate-800 flex w-full items-center gap-2 p-4 my-1 rounded-md hover:bg-gray-200 hover:dark:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c4c4c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        Conceptos 
                    </a>
                </div>

                <div class="relative">
                    <!-- Button -->
                    <a href="{{ route($user_route.'plan_de_negocio.estudio.encuesta.index', [$plan_de_negocio, $estudio]) }}" class="hover:bg-slate-800 flex w-full items-center gap-2 p-4 my-1 rounded-md hover:bg-gray-200 hover:dark:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c4c4c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        Encuestas
                    </a>
                </div>

                <div class="relative">
                    <!-- Button -->
                    <a href="{{ route($user_route.'plan_de_negocio.estudio.capturar_resultado.index', [$plan_de_negocio, $estudio]) }}" class="hover:bg-slate-800 flex w-full items-center gap-2 p-4 my-1 rounded-md hover:bg-gray-200 hover:dark:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c4c4c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                        Capturar resultados
                    </a>
                </div>

                <div class="relative">
                    <!-- Button -->
                    <a href="{{ route($user_route.'plan_de_negocio.estudio.conclusion.index', [$plan_de_negocio, $estudio]) }}" class="hover:bg-slate-800 flex w-full items-center gap-2 p-4 my-1 rounded-md hover:bg-gray-200 hover:dark:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c4c4c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        Conclusión
                    </a>
                </div>

                <div class="relative">
                    <!-- Button -->
                    <a href="{{ route('pdf', [$plan_de_negocio, $estudio]) }}" class="hover:bg-slate-800 flex w-full items-center gap-2 p-4 my-1 rounded-md hover:bg-gray-200 hover:dark:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c4c4c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        Ver resultados
                    </a>
                </div>

                <div class="relative">
                    <!-- Button -->
                    <a href="{{ route($user_route.'plan_de_negocio.estudio.index', [$plan_de_negocio]) }}" class="bg-sky-800 hover:bg-sky-900 flex w-full items-center gap-2 p-4 my-1 rounded-md dark:hover:bg-sky-900 dark:bg-sky-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c4c4c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        Salir del estudio
                    </a>
                </div>
            <div>
        </aside>
    </div>
</div>
