<div class="flex w-full flex-wrap ">
  <header class="flex max-h-fit w-full items-center justify-center p-2">
    <h1 class="dark:text-gray-100 text-slate-700 font-bold md:text-2xl">Cultura Organizacional</h1>
  </header>
  <section class="min-h-fit w-full">
    <div class="bg-white mx-20 py-6">
      <form action="" method="POST" class="mx-10">
        @csrf
        <label for="Mision" class="mx-auto flex min-w-full flex-wrap items-center justify-center space-y-2 p-2 md:min-w-fit md:flex-nowrap md:justify-between md:space-x-2">
          <span class="text-base dark:text-zinc-100 md:w-1/6 md:text-center uppercase">Misión empresarial</span>
          <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="mision" id="Mision" required>{{ old('mision') }}</textarea>
        </label>
        <label for="Vision" class="mx-auto flex min-w-full flex-wrap items-center justify-center space-y-2 p-2 md:flex-nowrap md:justify-between md:space-x-2">
          <span class="text-base dark:text-zinc-100 md:w-1/6 md:text-center uppercase">Visión empresarial</span>
          <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="vision" id="Vision" required></textarea>
        </label>
        <label for="Objetivos" class="mx-auto flex min-w-full flex-wrap items-center justify-center space-y-2 p-2 md:flex-nowrap md:space-x-2">
          <span class="text-base dark:text-zinc-100 md:w-1/6 md:text-center uppercase">Objetivos empresariales</span>
          <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="objetivos" id="Objetivos" required></textarea>
        </label>
        <label for="Valores" class="mx-auto flex min-w-full flex-wrap items-center justify-center space-y-2 p-2 md:flex-nowrap md:space-x-2">
          <span class="text-base dark:text-zinc-100 md:w-1/6 md:text-center uppercase">Valores</span>
          <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="valores" id="Valores" required></textarea>
        </label>
        <label for="Metas" class="mx-auto flex w-full flex-wrap items-center justify-center space-x-2 space-y-2 p-2 md:flex-nowrap md:justify-between">
          <span class="text-base dark:text-zinc-100 md:w-1/6 md:text-center uppercase">Metas</span>
          <textarea class="h-20 w-full rounded-md p-2 md:w-5/6" name="metas" id="Metas" required></textarea>
        </label>
        <div class="flex flex-nowrap w-full items-center justify-center my-4 mx-auto md:w-1/4">
          <button class="rounded px-3 py-2 dark:hover:bg-cyan-800 dark:bg-cyan-900 dark:text-gray-50 bg-blue-600 text-white">Guardar</button>
        </div>
      </form>
    </div>
  </section>
</div>
