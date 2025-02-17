@props([
    'plan_de_negocio' => '',
    'foda' => '',
])

@php $user_route = ''; @endphp

@if ( auth()->user()->rol == 'admin')
    @php $user_route = 'admin_'; @endphp
@elseif ( auth()->user()->rol == 'asesor')
    @php $user_route = 'asesor_'; @endphp
@endif

<div class="flex ml-2">
    <form class="flex items-center" action="{{ route($user_route.'plan_de_negocio.foda.destroy', [$plan_de_negocio,$foda]) }}" method="POST">
        @csrf
        @method('delete')
        <button :class="!open ? '' : 'hidden'" onclick="return confirm('¿Seguro que quieres borrar este registro?');">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#607e81" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
        </button>
    </form>
</div>

