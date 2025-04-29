@props(['status'])

@php
    $colors = [
        'approved' => 'bg-green-100 text-green-800',
        'pending' => 'bg-yellow-100 text-yellow-800',
        'rejected' => 'bg-red-100 text-red-800',
    ];
    
    $labels = [
        'approved' => 'Disetujui',
        'pending' => 'Menunggu',
        'rejected' => 'Ditolak',
    ];
    
    $colorClass = $colors[$status] ?? 'bg-gray-100 text-gray-800';
    $label = $labels[$status] ?? $status;
@endphp

<span {{ $attributes->merge(['class' => "px-2 inline-flex text-xs leading-5 font-semibold sm:rounded-full {$colorClass}"]) }}>
    {{ $label }}
</span>
