<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center dark:text-gray-100">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nuevo usuario') }}
            </h2>
        </div>
    </x-slot>
    <div class="justify-items-center grid">
        <div class="w-1/4 dark:text-gray-100 m-8 bg-white border-4 dark:border-none border-gray-200 dark:bg-gray-800 p-8 rounded-3xl">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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

                <div class="flex items-center justify-between mt-4">
                    <a class="inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-800 dark:bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-200 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red-700 focus:bg-red-700 dark:focus:bg-red-600 active:bg-red-900 dark:active:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4" 
                        href="{{ route('usuarios.index') }}">
                        {{ __('Cancelar') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
