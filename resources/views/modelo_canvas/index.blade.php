<x-app-layout class="flex flex-nowrap">
    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    <div class="w-full h-screen overflow-auto space-y-5 p-2 mb-4">
        <div class="flex w-full justify-center items-center">
            <h1 class="text-3xl dark:text-zinc-50 text-slate-700 font-bold py-3">Modelo Canvas</h1>
        </div>
        <div class="bg-white dark:bg-gray-900 m-20 py-8">
            <div class="mx-10 space-y-5">
                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Socios clave"
                :array_canvas="$modelo_canvas_data['Socios clave']">
                </x-modelo_canvas>

                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Actividades clave"
                :array_canvas="$modelo_canvas_data['Actividades clave']">
                </x-modelo_canvas>

                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Propuestas de valor"
                :array_canvas="$modelo_canvas_data['Propuestas de valor']">
                </x-modelo_canvas>

                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Relaciones con los clientes"
                :array_canvas="$modelo_canvas_data['Relaciones con los clientes']">
                </x-modelo_canvas>

                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Segmentos de clientes"
                :array_canvas="$modelo_canvas_data['Segmentos de clientes']">
                </x-modelo_canvas>

                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Recursos clave"
                :array_canvas="$modelo_canvas_data['Recursos clave']">
                </x-modelo_canvas>

                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Canales"
                :array_canvas="$modelo_canvas_data['Canales']">
                </x-modelo_canvas>

                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Estructura de costes"
                :array_canvas="$modelo_canvas_data['Estructura de costes']">
                </x-modelo_canvas>

                <x-modelo_canvas 
                :plan_de_negocio="$plan_de_negocio" 
                tipo="Fuentes de ingresos"
                :array_canvas="$modelo_canvas_data['Fuentes de ingresos']">
                </x-modelo_canvas>
            </div>
        </div>
    </div>
</x-app-layout>