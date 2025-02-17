<x-app-layout class="flex flex-nowrap">
    
    <x-sidebar :plan_de_negocio="$plan_de_negocio"></x-sidebar>
    @if($edit == true)
        <x-cultura_organizacional.edit
          :plan_de_negocio="$plan_de_negocio" 
          :cultura_organizacional="$plan_de_negocio->cultura_organizacional" />
    @else
        <x-cultura_organizacional />
    @endif
    
</x-app-layout>