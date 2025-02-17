<x-form-layout>
    @php $user_route = ''; @endphp

    @if ( auth()->user()->rol == 'admin')
        @php $user_route = 'admin_'; @endphp
    @elseif ( auth()->user()->rol == 'asesor')
        @php $user_route = 'asesor_'; @endphp
    @endif
    <div class="py-12 mx-40">
        <div class="min-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="mb-4 text-xl font-extrabold tracking-tight leading-none text-gray-200 font-bold bg-cyan-700 md:text-2xl lg:text-2xl text-center">Encuesta: {{ $encuestum->titulo }}</h1>
                <div class="p-6 bg-white border-b border-gray-200">
                    @php ($slug = $encuestum->titulo)
                    <form action="{{ route($user_route.'plan_de_negocio.estudio.encuesta.formulario.store', ['plan_de_negocio'=>$plan_de_negocio, 'estudio'=>$estudio, 'encuestum'=>$encuestum, $slug]) }}" method="POST">
                        @csrf
                        @foreach ($encuestum->preguntas as $key=>$pregunta)
                            <div class="mb-6">
                                <div class="mb-6">
                                    <h3 class="mb-4 font-semibold text-gray-900"><strong>{{ $key + 1 }}</strong> {{$pregunta->pregunta}}</h3>
                                </div>
                                <div class="flex items-center mb-4">
                                    <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex">
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                                <div class="flex items-center pl-3">
                                                    <input id="respuesta{{ $respuesta->id }}" type="radio" value="{{ $respuesta->id }}"
                                                        name="elecciones[{{ $key }}][respuesta_id]"
                                                        {{ (old('elecciones.' . $key . '.respuesta_id') == $respuesta->id) ? 'checked' : '' }}
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                    <label for="respuesta{{ $respuesta->id }}" class="py-3 ml-2 w-full text-sm font-medium text-gray-900">
                                                        {{ $respuesta->respuesta }}
                                                    </label>
                                                    <input type="hidden" name="elecciones[{{ $key }}][pregunta_id]" value="{{ $pregunta->id }}">
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <div class="mb-6">
                            <div class="mb-6">
                                <h5 class="text-xl font-medium text-gray-900 text-center">Ingrese sus datos</h5>
                            </div>
                            <div class="mb-6">
                                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                                <input type="text" name="formulario[nombre]" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            </div>
                            @error('nombre')
                                <small>Debes ingresar tu nombre</small>
                            @enderror
                            <div class="mb-6">
                                <label for="correo" class="block mb-2 text-sm font-medium text-gray-900">Correo</label>
                                <input type="email" name="formulario[correo]" id="correo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            </div>
                            @error('correo')
                                <small>Debes ingresar tu correo electronico</small>
                            @enderror
                        </div>

                        <button type="submit" class="float-right mt-2 mb-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Enviar respuestas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-form-layout>
