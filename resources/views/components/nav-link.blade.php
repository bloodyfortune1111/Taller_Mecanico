@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-300 text-sm font-medium leading-5 text-white focus:outline-none focus:border-blue-200 transition duration-150 ease-in-out bg-blue-600 bg-opacity-30 rounded-t-lg'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-blue-200 hover:border-blue-300 focus:outline-none focus:text-blue-200 focus:border-blue-300 transition duration-150 ease-in-out opacity-90 hover:opacity-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
