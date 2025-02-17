@props([
    'plan_de_negocio',
    'cultura_organizacional',
])

@php $user_route = ''; @endphp

@if ( auth()->user()->rol == 'admin')
    @php $user_route = 'admin_'; @endphp
@elseif ( auth()->user()->rol == 'asesor')
    @php $user_route = 'asesor_'; @endphp
@endif

<div class="flex w-full flex-wrap ">
  <header class="flex max-h-fit w-full items-center justify-center p-2">
    <h1 class="dark:text-gray-100 md:text-2xl">Cultura Organizacional</h1>
  </header>
  <section class="min-h-fit w-full">
    <form class="mx-20" action="{{ route($user_route.'plan_de_negocio.cultura_organizacional.update',[$plan_de_negocio,$cultura_organizacional]) }}" method="POST">
      @csrf
      @method('patch')
      <label for="Mision" class="mx-auto flex min-w-full flex-wrap items-center justify-center space-y-2 p-2 md:min-w-fit md:flex-nowrap md:justify-between md:space-x-2">
        <span class="text-base uppercase dark:text-zinc-100 md:w-1/6 md:text-center">Misión empresarial</span>
        <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="mision" id="Mision" required>{{ $cultura_organizacional->mision }}</textarea>
      </label>
      <label for="Vision" class="mx-auto flex min-w-full flex-wrap items-center justify-center space-y-2 p-2 md:flex-nowrap md:justify-between md:space-x-2">
        <span class="text-base uppercase dark:text-zinc-100 md:w-1/6 md:text-center">Visión empresarial</span>
        <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="vision" id="Vision" required>{{ $cultura_organizacional->vision }}</textarea>
      </label>
      <label for="Objetivos" class="mx-auto flex min-w-full flex-wrap items-center justify-center space-y-2 p-2 md:flex-nowrap md:space-x-2">
        <span class="text-base uppercase dark:text-zinc-100 md:w-1/6 md:text-center">Objetivos empresariales</span>
        <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="objetivos" id="Objetivos" required>{{ $cultura_organizacional->objetivos }}</textarea>
      </label>
      <label for="Valores" class="mx-auto flex min-w-full flex-wrap items-center justify-center space-y-2 p-2 md:flex-nowrap md:space-x-2">
        <span class="text-base uppercase dark:text-zinc-100 md:w-1/6 md:text-center">Valores</span>
        <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="valores" id="Valores" required>{{ $cultura_organizacional->valores }}</textarea>
      </label>
      <label for="Metas" class="mx-auto flex w-full flex-wrap items-center justify-center space-x-2 space-y-2 p-2 md:flex-nowrap md:justify-between">
        <span class="text-base uppercase dark:text-zinc-100 md:w-1/6 md:text-center">Metas</span>
        <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="metas" id="Metas" required>{{ $cultura_organizacional->metas }}</textarea>
      </label>
      <div class="flex flex-nowrap w-full items-center justify-center my-4 mx-auto md:w-1/4">
        <button class="rounded-lg px-3 py-2 bg-green-600 hover:bg-green-500 text-white hover:text-white dark:hover:bg-cyan-800 dark:bg-cyan-900 dark:text-gray-50">Actualizar</button>
      </div>
    </form>
  </section>
</div>
