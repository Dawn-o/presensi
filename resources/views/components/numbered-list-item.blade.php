@props(['number'])

<li class="flex">
    <div class="flex-shrink-0 w-5 h-5 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 mr-3">
        <span class="text-xs font-bold">{{ $number }}</span>
    </div>
    <p class="text-sm text-gray-600">{{ $slot }}</p>
</li>
