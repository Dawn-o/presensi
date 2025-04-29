@props(['title', 'value', 'color' => 'gray', 'icon'])

@php
    $colorClasses = [
        'gray' => 'text-gray-800 bg-gray-100 text-gray-600',
        'green' => 'text-green-600 bg-green-100 text-green-600',
        'indigo' => 'text-indigo-600 bg-indigo-100 text-indigo-600',
        'amber' => 'text-amber-500 bg-amber-100 text-amber-500',
        'red' => 'text-red-600 bg-red-100 text-red-600',
        'blue' => 'text-blue-600 bg-blue-100 text-blue-600',
    ];

    $textColor = explode(' ', $colorClasses[$color])[0];
    $bgColor = explode(' ', $colorClasses[$color])[1];
    $iconColor = explode(' ', $colorClasses[$color])[2];
@endphp

<div
    class="bg-white shadow-sm transition-shadow duration-300 border border-gray-100 sm:rounded-lg p-5 relative overflow-hidden">
    <div class="absolute top-0 right-0 -mt-4 -mr-4 opacity-10">
        <div class="w-24 h-24 rounded-full bg-{{ $color }}-{{ $color === 'amber' ? '500' : '600' }}"></div>
    </div>
    <div class="flex justify-between items-start">
        <div>
            <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
            <p class="mt-1 text-2xl font-bold {{ $textColor }}">{{ $value }}</p>
        </div>
        <div class="p-2 {{ $bgColor }} rounded-lg">
            {{ $icon }}
        </div>
    </div>
</div>
