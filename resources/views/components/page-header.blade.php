@props(['title'])

<div class="mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
        <div class="w-full sm:w-auto">
            {{ $action ?? '' }}
        </div>
    </div>
</div>
