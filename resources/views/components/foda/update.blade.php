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

<div class="w-full flex dark:text-gray-900" :class="open ? '' : 'hidden'">

    <form method="POST" action="{{ route($user_route.'plan_de_negocio.foda.update',[$plan_de_negocio,$foda]) }}">
        @csrf
        @method('patch')

        <div class="flex w-full justify-start items-center space-x-2">
            <div>
                <input class="hidden" type="hidden" name="tipo" value="{{ $foda->tipo }}">
                <input type="text" name="descripcion" :value="open && '{{ $foda->descripcion }}'">
            </div>
            <div>
                <button class="justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#607e81" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                </button>
                <button class="self-center" @click="open = !open" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#607e81" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
        </div>
        
    </form>
</div>