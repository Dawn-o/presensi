@props(['type'])

@php
$classes = match($type) {
    'sick' => 'bg-blue-100 text-blue-800',
    'personal' => 'bg-yellow-100 text-yellow-800',
    default => 'bg-gray-100 text-gray-800'
};

$label = match($type) {
    'sick' => 'Sakit',
    'personal' => 'Pribadi',
    default => 'Lainnya'
};
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium $classes"]) }}>
    {{ $label }}
</span>
