@props(['title', 'description'])

<div>
    <div class="flex justify-center">
        <div
            class="h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center transform transition-transform duration-300 hover:scale-110">
            {{ $icon }}
        </div>
    </div>
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        {{ $title }}
    </h2>
    <p class="mt-2 text-center text-sm text-gray-600">
        {{ $description }}
    </p>
</div>
