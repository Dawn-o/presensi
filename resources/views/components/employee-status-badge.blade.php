@props(['presence' => null, 'size' => 'normal'])

@php
    $sizeClass = $size === 'large' ? 'px-2 py-1' : 'px-2';
    $textClass = $size === 'large' ? 'text-xs' : 'text-xs';
@endphp

@if($presence)
    <span class="whitespace-nowrap {{ $sizeClass }} inline-flex {{ $textClass }} leading-5 font-semibold sm:rounded-full 
        {{ $presence->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
        {{ $presence->status === 'present' ? 'Tepat Waktu' : 'Terlambat' }}
    </span>
@else
    <span class="whitespace-nowrap {{ $sizeClass }} inline-flex {{ $textClass }} leading-5 font-semibold sm:rounded-full bg-red-100 text-red-800">
        Belum Hadir
    </span>
@endif
