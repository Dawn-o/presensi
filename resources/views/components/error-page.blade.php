@props(['code', 'title', 'message', 'color' => 'indigo'])

<div class="mt-64 flex items-center justify-center">
    <div class="max-w-xl w-full px-4">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-{{ $color }}-600">{{ $code }}</h1>
            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $title }}</p>
            <p class="mt-4 text-gray-600">{{ $message }}</p>
            
            <div class="mt-8">
                <div class="inline-flex items-center">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
