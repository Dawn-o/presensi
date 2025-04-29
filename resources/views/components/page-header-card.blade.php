@props(['title', 'subtitle' => null, 'icon' => null])

<div class="bg-white sm:rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-5 sm:p-6">
        <div class="flex items-center mb-4 sm:mb-0">
            @if ($icon)
                <div class="bg-indigo-100 p-2.5 rounded-lg mr-4">
                    {{ $icon }}
                </div>
            @endif
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $title }}</h1>
                @if ($subtitle)
                    <p class="text-gray-500 text-sm">{{ $subtitle }}</p>
                @endif
            </div>
        </div>
        
        @if (isset($action))
            <div class="w-full sm:w-auto">
                {{ $action }}
            </div>
        @endif
    </div>
</div>
