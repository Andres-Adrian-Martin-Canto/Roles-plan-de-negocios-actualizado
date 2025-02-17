<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="mx-20 flex items-center justify-center">
            <h1 class="dark:text-gray-100 my-6 text-2xl">Publicidad, promoción y mercadotecnia</h1>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 flex items-center justify-center my-6">
            <form class="w-full" method="POST" enctype="multipart/form-data" action="{{ route($user_route.'plan_de_negocio.publicidad.update', [$plan_de_negocio, $plan_de_negocio->publicidades]) }}">
                @method('PATCH')    
                @csrf
                <div class="dark:bg-gray-800 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="plan_promocion">
                            Plan de promoción
                            </label>
                            <textarea rows="3" class="w-full bg-gray-100 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="plan_promocion" name="plan_promocion" type="text" placeholder="Escriba el plan de promoción que tiene en mente" required>{{ $plan_de_negocio->publicidades->plan_promocion }}</textarea>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="comercializacion">
                            Comercialización
                            </label>
                            <textarea rows="3" class="w-full bg-gray-100 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="comercializacion" name="comercializacion" type="text" placeholder="Escriba el método de comercialización" required>{{ $plan_de_negocio->publicidades->comercializacion }}</textarea>
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide dark:text-white text-md font-bold mb-2" for="plan_mercadotecnia">
                            Plan de mercadotecnia
                            </label>
                            <textarea rows="3" class="w-full bg-gray-100 text-black border border-gray-200 rounded py-3 px-4 mb-3 mt-4" id="plan_mercadotecnia" name="plan_mercadotecnia" type="text" placeholder="Escriba el plan de mercadotécnia a seguir" required>{{ $plan_de_negocio->publicidades->plan_mercadotecnia }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-center items-center">
                        <div class="">
                            <a href="{{ route($user_route.'plan_de_negocio.publicidad.index', [$plan_de_negocio]) }}" class="rounded-xl bg-red-500 m-6 px-8 py-3 hover:bg-red-700 dark:text-white text-white">Cancelar</a>
                            <button class="m-2 dark:bg-green-600 bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-10 border-gray-500 dark:hover:bg-green-700 rounded-xl">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
