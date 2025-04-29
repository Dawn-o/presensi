@props(['route', 'icon', 'variant' => 'secondary'])

@php
    $baseClasses = "inline-flex items-center justify-center px-4 py-2 border sm:rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500";
    
    $variantClasses = [
        'primary' => 'border-transparent text-white bg-indigo-600 hover:bg-indigo-700',
        'secondary' => 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50',
    ];
@endphp

<a href="{{ $route }}" 
   {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses[$variant]}"]) }}>
    {{ $icon }}
    <span>{{ $slot }}</span>
</a>
