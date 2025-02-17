@props([
    'plan_de_negocio',
    'seccion', 
    'input_name'   
])
<div class="mx-20 flex flex-wrap mb-8">
    <header class="flex w-full items-center justify-between p-4 dark:bg-gray-800 rounded-t-lg">
		<span class="dark:text-gray-50">{{ $seccion }}</span>
		<button class="flex items-center space-x-2 rounded p-2 dark:bg-green-800" type="button">
		    <span class="hidden font-mono dark:text-gray-50 md:inline-flex"> Editar </span>
		</button>
    </header>

    <div class="flex w-full dark:bg-gray-700 rounded-b-lg">
		<div class="h-fit w-full space-y-4 divide-y-2 p-4 dark:text-gray-50">
            @if ($plan_de_negocio->generalidades == null)
                <div class="text-center text-gray-400">
                    Información sin agregar
                </div>
            @else
                <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">
                    {{ $plan_de_negocio->generalidades->$input_name }}
                </textarea>
            @endif
		</div>
    </div>
</div>