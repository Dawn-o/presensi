@props(['checkIn', 'checkOut'])

<div class="grid grid-cols-2 gap-6">
    <div class="bg-gray-50 sm:rounded-lg p-4">
        <div class="text-sm font-medium text-gray-500">Jam Masuk</div>
        <div class="mt-1 text-2xl font-semibold text-gray-900">
            {{ $checkIn?->format('H:i') ?? '-' }}
        </div>
    </div>
    <div class="bg-gray-50 sm:rounded-lg p-4">
        <div class="text-sm font-medium text-gray-500">Jam Pulang</div>
        <div class="mt-1 text-2xl font-semibold text-gray-900">
            {{ $checkOut?->format('H:i') ?? '-' }}
        </div>
    </div>
</div>
