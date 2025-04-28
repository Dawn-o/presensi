@props(['class'])

<svg {{ $attributes->merge(['class' => 'h-2 w-2 ' . $class]) }} fill="currentColor" viewBox="0 0 8 8">
    <circle cx="4" cy="4" r="3" />
</svg>
