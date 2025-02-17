<x-app-layout class="flex flex-nowrap">

    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full h-screen overflow-auto">
        <div class="mx-20 flex items-center justify-center">
            <h1 class="dark:text-gray-100 my-6 text-2xl">Imagen corporativa</h1>
        </div>

        @php $user_route = ''; @endphp

        @if ( auth()->user()->rol == 'admin')
            @php $user_route = 'admin_'; @endphp
        @elseif ( auth()->user()->rol == 'asesor')
            @php $user_route = 'asesor_'; @endphp
        @endif

        <div class="mx-20 items-center justify-center">
            @if ($plan_de_negocio->imagenes_corporativas != null)
                <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-full dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="m-6 object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-lg" src="{{asset($plan_de_negocio->imagenes_corporativas->logotipo)}}" alt="">
                    
                    <div class="flex flex-col justify-between p-4 leading-normal m-3">
                        <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Datos de la imagen corporativa</h5>
                        <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">
                            <strong class="dark:text-white text-lg">Nombre de la emrpresa: </strong><br> {{ $plan_de_negocio->imagenes_corporativas->nombre_corporativo }} </p>
                        <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">
                            <strong class="dark:text-white text-lg">Justificación del nombre: </strong><br> {{ $plan_de_negocio->imagenes_corporativas->justificacion_nombre }} </p>
                        <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">
                            <strong class="dark:text-white text-lg">Justificación del logo: </strong><br> {{ $plan_de_negocio->imagenes_corporativas->justificacion_logo }} </p>
                        <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">
                            <strong class="dark:text-white text-lg">Eslogan: </strong><br> {{ $plan_de_negocio->imagenes_corporativas->eslogan }} </p>
                        <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">
                            <strong class="dark:text-white text-lg">Justificación eslogan: </strong><br> {{ $plan_de_negocio->imagenes_corporativas->justificacion_eslogan }} </p>   
                    </div>
                </div>

                <div class="flex justify-center">
                    <a href="{{ route($user_route.'plan_de_negocio.imagen_corporativa.edit', [$plan_de_negocio, $plan_de_negocio->imagenes_corporativas]) }}" class="bg-blue-600 hover:bg-blue-500 my-6  inline-flex items-center px-4 mr-3 text-lg font-medium text-white border border-gray-300 rounded-lg hover:text-white dark:bg-blue-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-blue-700 dark:hover:text-white">
                        Editar
                    </a>
                    <form method="post" action="{{ route($user_route.'plan_de_negocio.imagen_corporativa.destroy', [$plan_de_negocio, $plan_de_negocio->imagenes_corporativas]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            onclick="return confirm('¿Seguro que quieres borrar la imgen corporativa?');"
                            class="inline-flex
                                items-center 
                                my-6 px-4 py-4
                                bg-red-700
                                hover:bg-red-600
                                text-white
                                text-lg
                                font-medium
                                rounded-md ml-2">
                                Eliminar
                        </button>
                    </form>
                </div>

            @else
                <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-full dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex justify-center text-white dark:text-gray-400 bg-gray-400 dark:bg-gray-700 m-6 object-cover w-full rounded-lg md:h-auto md:w-48 md:rounded-none md:rounded-lg p-6" src="#" alt="">
                        <p>Sin logo
                        </p>
                    </div>
                    
                    <div class="flex flex-col justify-between p-4 leading-normal m-3">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Datos de la imagen corporativa</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            Aún no hay datos</p>                            
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <a href="{{ route($user_route.'plan_de_negocio.imagen_corporativa.create', [$plan_de_negocio]) }}" class="my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-lg font-medium text-white bg-blue-600 border border-gray-300 rounded-lg hover:bg-blue-500 hover:text-white dark:bg-blue-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-blue-700 dark:hover:text-white">
                        Ingresar información
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>