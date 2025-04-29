@props(['footerAction' => null])

<div class="bg-white shadow sm:rounded-lg">
    <div class="p-4 sm:p-6">
        {{ $slot }}
    </div>
    
    @if ($footerAction)
    <div class="px-4 py-3 bg-gray-50 sm:rounded-b-lg sm:px-6">
        <div class="flex justify-end">
            {{ $footerAction }}
        </div>
    </div>
    @endif
</div>
