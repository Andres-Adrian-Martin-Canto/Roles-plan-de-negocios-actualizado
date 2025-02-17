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
                <div class="p-6 bg-cyan-800 text-gray-200 border-b border-gray-200">
                    <p class="text-center text-2xl">Gracias por contestar la encuesta</p>
                </div>
            </div>
        </div>
    </div>
</x-form-layout>
