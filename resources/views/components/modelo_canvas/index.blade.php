@props([
    'plan_de_negocio',
	'tipo',
	'array_canvas'
])

<div class="flex flex-wrap">
    <header x-data="{open: false}" :class="open ? 'flex-nowrap' : ''" class="flex w-full items-center justify-between p-4 bg-gray-200 dark:bg-zinc-700">
		<span class="dark:text-gray-50">{{ $tipo }}</span>
		<button @click="open = !open" :class="open ? 'hidden' : 'flex'" class=" items-center space-x-2 rounded p-2 bg-slate-600 dark:bg-zinc-500" type="button">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-gray-50">
				<path d="M4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM5 5V19H19V5H5ZM11 11V7H13V11H17V13H13V17H11V13H7V11H11Z" />
			</svg>
			<span class="hidden font-mono text-gray-200 dark:text-gray-50 md:inline-flex"> Agregar </span>
		</button>
		<x-modelo_canvas.create :plan_de_negocio="$plan_de_negocio" :tipo="$tipo"></x-modelo_canvas.create>
    </header>
    <div class="flex w-full dark:bg-zinc-800">
		<div class="h-fit w-full divide-y px-2 dark:text-gray-50 border-4 dark:border-none border-gray-200">
			@if(count($array_canvas)>0) 
				@foreach($array_canvas as $canva_item)
					<div x-data="{open:false}" class="flex w-full px-1 py-2 mx-auto my-2 items-center">
						<span class="w-3/4" :class="open ? 'hidden' : ''">{{ $canva_item->descripcion }}</span>
						<div :class="open ? 'hidden' : ''" class="flex flex-nowrap w-1/4 items-center justify-end mr-5 space-x-2">
							<button @click="open = !open" type="button">Editar</button>
							{{-- <button type="button">Eliminar</button> --}}
							<x-modelo_canvas.delete :plan_de_negocio="$plan_de_negocio" :canva_item="$canva_item" />
						</div>
						<x-modelo_canvas.edit :plan_de_negocio="$plan_de_negocio" :canva_item="$canva_item" />
					</div>
				@endforeach
			@endif
		</div>
    </div>
</div>
  