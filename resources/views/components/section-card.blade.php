@props(['title', 'rightContent' => null])

<div class="bg-white shadow-md sm:rounded-xl border border-gray-100 overflow-hidden {{ $attributes->get('class') }}">
    <!-- Decorative header section -->
    <div class="bg-gray-50 border-b border-gray-100 px-6 py-4 flex items-center">
        <div class="h-8 w-1 bg-indigo-500 rounded-full mr-3"></div>
        <h2 class="text-lg font-medium text-gray-800">{{ $title }}</h2>
        @if ($rightContent)
            <div class="ml-auto flex items-center text-sm text-gray-500">
                {{ $rightContent }}
            </div>
        @endif
    </div>

    <!-- Main content -->
    <div class="p-6 relative">
        {{ $slot }}
    </div>
</div>
