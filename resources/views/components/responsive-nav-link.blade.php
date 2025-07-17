@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-blue-300 text-start text-base font-medium text-white bg-blue-600 bg-opacity-30 focus:outline-none focus:text-white focus:bg-blue-600 focus:bg-opacity-40 focus:border-blue-200 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:text-blue-200 hover:bg-gray-700 hover:bg-opacity-50 hover:border-blue-300 focus:outline-none focus:text-blue-200 focus:bg-gray-700 focus:bg-opacity-50 focus:border-blue-300 transition duration-150 ease-in-out opacity-90 hover:opacity-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
