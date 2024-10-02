@props(['active'])

@php
$style = ($active ?? false) 
    ? 'border-color: green; color: green;' 
    : '';

$classes = ($active ?? false) 
    ? 'block w-full ps-3 pe-4 py-2 border-l-4 text-start text-base font-medium focus:outline-none focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out' 
    : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'style' => $style]) }}>
    {{ $slot }}
</a>

