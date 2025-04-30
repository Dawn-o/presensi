@props(['leave', 'size' => 'sm'])

@php
$sizes = [
    'sm' => 'px-3 py-1.5 text-xs',
    'md' => 'px-4 py-2 text-sm'
];
$buttonSize = $sizes[$size] ?? $sizes['sm'];
@endphp

<div class="flex space-x-3">
    <form action="{{ route('leaves.approve', $leave) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit"
            class="inline-flex items-center justify-center {{ $buttonSize }} rounded-md border border-green-200 bg-green-50 font-medium text-green-700
            hover:bg-green-100 hover:border-green-300 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-green-500 transition-all duration-150 shadow-sm">
            <x-icons.check class="w-3.5 h-3.5 mr-1.5" />
            Setujui
        </button>
    </form>
    <form action="{{ route('leaves.reject', $leave) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit"
            class="inline-flex items-center justify-center {{ $buttonSize }} rounded-md border border-red-200 bg-red-50 font-medium text-red-700
            hover:bg-red-100 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-red-500 transition-all duration-150 shadow-sm">
            <x-icons.x class="w-3.5 h-3.5 mr-1.5" />
            Tolak
        </button>
    </form>
</div>
