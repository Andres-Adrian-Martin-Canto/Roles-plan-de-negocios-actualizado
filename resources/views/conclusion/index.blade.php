<x-app-layout class="flex flex-nowrap">

    <x-second-sidebar :plan_de_negocio="$plan_de_negocio" :estudio="$estudio"></x-sidebar>

    <div class="w-full h-screen overflow-auto">
        <div>
            <div class="mx-20 flex items-center justify-center">
                <h1 class="dark:text-gray-100 text-slate-700 font-bold mt-6 text-2xl">Conclusion del estudio de mercado</h1>
            </div>

            @php $user_route = ''; @endphp

            @if ( auth()->user()->rol == 'admin')
                @php $user_route = 'admin_'; @endphp
            @elseif ( auth()->user()->rol == 'asesor')
                @php $user_route = 'asesor_'; @endphp
            @endif

            <div class="flex justify-center">
                <a href="#" id="btn_editar">
                    <button class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-md font-medium text-white bg-blue-600 border border-gray-300 rounded-lg hover:bg-blue-500 hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white" name="check" id="check" value="1" onclick="javascript:showContent()">
                        Editar
                    </button>
                </a>
                <a href="#" id="btn_cancelar">
                    <button class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-md font-medium text-white bg-red-600 border border-gray-300 rounded-lg hover:bg-red-500 hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white" name="check" id="check" value="1" onclick="javascript:cancelar()">
                        Cancelar
                    </button>
                </a>
                <a href="{{ route($user_route.'plan_de_negocio.estudio.conclusion.create',[$plan_de_negocio, $estudio]) }}" id="btn_crear" style="display: none">
                    <button class="float-right my-6 mb-4 inline-flex items-center px-4 py-2 mr-3 text-md font-medium text-white bg-blue-600 border border-gray-300 rounded-lg hover:bg-blue-500 hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white" name="check" id="check" value="1">
                        Crear conclusion
                    </button>
                </a>
            </div>
        </div>

        <div class="mx-20 flex flex-wrap mb-8 space-y-6 grid justify-items-center">
            <div class="py-8 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden sm:rounded-lg">
                        <div class="p-6 dark:bg-gray-800 bg-white">
                            
                            <div id="conclusion_txt" class="text-base">
                                @if ($estudio->conclusion == null)

                                    <div class="dark:transparent w-full h-100 flex justify-center">
                                        <div class="m-10 px-6 py-4 text-2xl text-gray-900 dark:text-gray-400">
                                            <div class="flex justify-center mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#c0c0c0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                            </div>
                                            <p class="text-center dark:text-gray-300 text-gray-400 font-bold w-full">  
                                                Aún no tiene una conclusión
                                            </p>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        btn_edit = document.getElementById("btn_editar").style.display = 'none';
                                        btn_crear = document.getElementById("btn_crear").style.display = 'block';
                                    </script>

                                @else
                                    <p class="text-gray-700 dark:text-gray-200">{{ $estudio->conclusion->conclusion }}</p>
                                    <script type="text/javascript">
                                        btn_edit = document.getElementById("btn_editar").style.display = 'block';
                                        btn_crear = document.getElementById("btn_crear").style.display = 'none';
                                    </script>
                                    <form method="post" action="{{ route($user_route.'plan_de_negocio.estudio.conclusion.destroy', [$plan_de_negocio, $estudio, $estudio->conclusion]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            onclick="return confirm('¿Seguro que quieres borrar la conclusión?');"
                                            class="inline-flex float-right
                                                items-center 
                                                my-10 px-4 py-2
                                                bg-red-700
                                                hover:bg-red-600
                                                text-white
                                                text-lg
                                                font-medium
                                                rounded-md ml-2">
                                                Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div id="edit" style="display: none;" class="">
                                @if ($estudio->conclusion != null)
                                    <form method="POST" action="{{ route($user_route.'plan_de_negocio.estudio.conclusion.update', [$plan_de_negocio, $estudio, $estudio->conclusion]) }}">
                                        @method('PATCH')
                                        @csrf
                                        <div class="mb-6">
                                            <label for="conclusion" class="block mb-2 text-lg text-center font-medium dark:text-gray-200 text-color-600">Actualizar conclusión</label>
                                            <textarea name="conclusion" id="conclusion" rows="8" class="block p-2.5 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Ingrese la conclusión del estudio a la que se llegó tras hacer las investigaciones">{{ $estudio->conclusion['conclusion'] }}</textarea>
                                        </div>
                
                                        <button type="submit" class="my-10 float-right text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-5 py-2.5 text-center">Actualizar</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById("btn_cancelar").style.display = "none";
        function showContent() {
            form_edit = document.getElementById("edit");
            document.getElementById("btn_editar").style.display = "none";
            document.getElementById("btn_cancelar").style.display = "block";
            conclusion_txt = document.getElementById("conclusion_txt");
            if (form_edit.style.display == 'none') {
                form_edit.style.display='block';
                conclusion_txt.style.display='none';
            }
            else {
                form_edit.style.display='none';
                conclusion_txt.style.display='block';
            }
        }
        function cancelar() {
            document.getElementById("btn_cancelar").style.display = "none";
            document.getElementById("btn_editar").style.display = "block";
            conclusion_txt = document.getElementById("conclusion_txt");
            if (form_edit.style.display == 'none') {
                form_edit.style.display='block';
                conclusion_txt.style.display='none';
            }
            else {
                form_edit.style.display='none';
                conclusion_txt.style.display='block';
            }
        }
    </script>
</x-app-layout>