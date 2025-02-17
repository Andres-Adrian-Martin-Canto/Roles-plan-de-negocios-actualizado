@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent dark:border-transparent text-sm font-medium leading-5 text-gray-200 dark:text-gray-100 hover:text-gray-400 hover:border-gray-200 focus:outline-none focus:border-gray-200 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-200 dark:text-gray-400 hover:text-gray-400 dark:hover:text-gray-300 hover:border-gray-200 dark:hover:border-gray-700 focus:outline-none focus:text-gray-400 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
