@props(['title', 'subtitle' => null])

<div class="bg-gradient-to-r from-indigo-600 via-blue-500 to-indigo-700 px-6 py-6 relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute right-0 bottom-0 w-64 h-64 bg-white rounded-full -mr-32 -mb-32 opacity-10"></div>
    <div class="absolute left-1/4 top-0 w-32 h-32 bg-indigo-300 rounded-full -ml-16 -mt-16 opacity-10"></div>

    <div class="relative">
        <h1 class="text-2xl font-bold text-white">{{ $title }}</h1>
        @if ($subtitle)
            <p class="text-indigo-100 text-sm mt-1">{{ $subtitle }}</p>
        @endif
    </div>
</div>
