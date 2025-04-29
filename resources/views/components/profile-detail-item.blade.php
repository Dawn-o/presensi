@props(['label', 'value'])

<div class="sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4">
    <dt class="text-sm font-medium text-gray-500">{{ $label }}</dt>
    <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:col-span-2">{{ $value }}</dd>
</div>
