@props(['type' => 'success', 'message'])

@php
    $colors = [
        'success' => 'bg-green-50 border-green-200 text-green-800',
        'error' => 'bg-red-50 border-red-200 text-red-800',
    ];

    $iconColor = $type === 'success' ? 'text-green-400' : 'text-red-400';
@endphp

<div {{ $attributes->merge(['class' => "mt-4 {$colors[$type]} border sm:rounded-md p-4"]) }}>
    <div class="flex">
        <div class="flex-shrink-0">
            @if ($type === 'success')
                <x-icons.check-circle class="h-5 w-5 {{ $iconColor }}" />
            @else
                <x-icons.warning class="h-5 w-5 {{ $iconColor }}" />
            @endif
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium {{ $type === 'success' ? 'text-green-800' : 'text-red-800' }}">
                {{ $message }}
            </p>
        </div>
    </div>
</div>
