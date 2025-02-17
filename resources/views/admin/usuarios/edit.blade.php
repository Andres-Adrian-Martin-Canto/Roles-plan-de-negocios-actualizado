<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between dark:text-gray-100">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Actualizar usuario') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('usuarios.update', [$user]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name  ?? '') }}" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email ?? '') }}" required autocomplete="username" />
                            @if(session('msg'))
                                <p class="text-red-500 ml-2 text-sm mt-1">{{ session('msg') }}</p>
                            @endif
                        </div>

                        <!-- Rol -->
                        <div class="flex gap-10 mt-4">
                            <div class="inline-flex items-center">
                                <label class="relative flex cursor-pointer items-center rounded-full p-3" for="asesor" data-ripple-dark="true">
                                    <input required
                                        id="asesor"
                                        name="rol"
                                        value="asesor"
                                        type="radio"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10"
                                        {{ $user->rol == 'asesor' ? 'checked' : '' }}
                                    />
                                    <div class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-pink-500 opacity-0 transition-opacity peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16" fill="currentColor">
                                            <circle data-name="ellipse" cx="8" cy="8" r="8"></circle>
                                        </svg>
                                    </div>
                                </label>
                                <label class="mt-px cursor-pointer select-none font-light dark:text-gray-200" for="asesor">
                                    Asesor
                                </label>
                            </div>

                            <div class="inline-flex items-center">
                                <label class="relative flex cursor-pointer items-center rounded-full p-3" for="discipulo" data-ripple-dark="true">
                                    <input required
                                        id="discipulo"
                                        name="rol"
                                        value="discipulo"
                                        type="radio"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 text-pink-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:before:bg-pink-500 hover:before:opacity-10"
                                        {{ $user->rol == 'discipulo' ? 'checked' : '' }}
                                    />
                                    <div class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-pink-500 opacity-0 transition-opacity peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16" fill="currentColor">
                                            <circle data-name="ellipse" cx="8" cy="8" r="8"></circle>
                                        </svg>
                                    </div>
                                </label>
                                <label class="mt-px cursor-pointer select-none font-light dark:text-gray-200" for="discipulo">
                                    Discípulo
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('usuarios.index') }}" class="m-4 bg-red-900 text-white font-bold py-1.5 px-2 border-gray-500 dark:hover:bg-red-800 rounded-md">
                                Cancelar
                            </a>

                            <x-primary-button onclick="if ( ({{ $user->rol == 'discipulo' || $user->rol == 'asesor'}}) ) {
                                        return confirm('¿Desea continuar con el rol seleccionado?');
                                    }">Guardar</x-primary-button>                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
