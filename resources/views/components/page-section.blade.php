@props(['title', 'description', 'icon' => null])

<div {{ $attributes }}>
    <div class="flex items-center mb-4">
        @if ($icon)
            <div class="mr-3">
                {{ $icon }}
            </div>
        @endif
        <x-section-header :title="$title" :description="$description" />
    </div>

    {{ $slot }}
</div>
