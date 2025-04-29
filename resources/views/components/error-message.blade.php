@props(['message'])

<div class="mt-1 flex items-center text-sm text-red-600">
    <x-icons.warning-circle class="h-4 w-4 mr-1.5" />
    {{ $message }}
</div>
