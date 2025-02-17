<x-app-layout class="flex flex-nowrap">

    <x-second-sidebar :plan_de_negocio="$plan_de_negocio" :estudio="$estudio"></x-sidebar>

    <div class="w-full h-screen overflow-auto">
        <div>
            <div class="mx-20 flex items-center justify-center">
                <h1 class="dark:text-gray-100 mt-6 text-2xl">Conclusion del estudio de mercado</h1>
            </div>

            <div class="flex justify-center">
                
            </div>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 flex flex-wrap mb-8 space-y-6 grid justify-items-center">
            <div class="py-8 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden sm:rounded-lg">
                        <div class="p-4 bg-white">
                            <form action="{{ route($user_route.'plan_de_negocio.estudio.conclusion.store',[$plan_de_negocio, $estudio]) }}" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label for="conclusion" class="block mb-2 text-sm font-medium text-gray-900"></label>
                                    <textarea name="conclusion" id="conclusion" rows="12" class="block p-2.5 w-full text-md text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Ingrese la conclusión del estudio a la que se llegó tras hacer las investigaciones"></textarea>
                                    @error('conclusion')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="flex justify-between">
                                    <a href="{{ route($user_route.'plan_de_negocio.estudio.conclusion.index', [$plan_de_negocio, $estudio]) }}" class="m-4 bg-red-900 text-white font-bold py-4 px-10 border-gray-500 dark:hover:bg-red-700 rounded-xl">
                                        Cancelar
                                    </a>
                                    <button type="submit" class="m-4 dark:bg-blue-700 text-white bg-blue-600 hover:bg-blue-500 font-bold py-4 px-10 border-gray-500 dark:hover:bg-blue-700 rounded-xl">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>