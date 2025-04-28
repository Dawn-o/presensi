@props(['status'])

@php
    $colors = [
        'present' => 'bg-green-100 text-green-800',
        'late' => 'bg-yellow-100 text-yellow-800',
        'absent' => 'bg-red-100 text-red-800',
        'holiday' => 'bg-gray-100 text-gray-800',
        'future' => 'bg-gray-100 text-gray-800',
        'today' => 'bg-blue-100 text-blue-800',
        'none' => 'bg-gray-100 text-gray-800',
    ];

    $labels = [
        'present' => 'Tepat Waktu',
        'late' => 'Terlambat',
        'absent' => 'Tidak Hadir',
        'holiday' => 'Libur',
        'future' => '-',
        'today' => 'Hari Ini',
        'none' => 'Belum Absen',
    ];
@endphp

<span
    {{ $attributes->merge(['class' => "px-2 inline-flex text-xs leading-5 font-semibold sm:rounded-full {$colors[$status]}"]) }}>
    {{ $labels[$status] }}
</span>
