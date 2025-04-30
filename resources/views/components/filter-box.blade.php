@props(['title' => 'Filter'])

<div class="flex flex-col bg-gray-50 rounded-lg p-4 border border-gray-200">
    <p class="text-sm font-medium text-gray-700 mb-3">{{ $title }}</p>
    <div class="space-y-3">
        {{ $slot }}
    </div>
</div>
