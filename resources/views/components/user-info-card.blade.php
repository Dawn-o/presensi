@props(['user'])

<div class="flex items-center bg-blue-50 sm:rounded-lg p-4">
    <div class="p-2 bg-blue-100 rounded-full mr-4">
        <x-icons.user class="h-5 w-5 text-blue-600" />
    </div>
    <div>
        <p class="text-sm font-medium text-blue-900">Menampilkan rekap untuk:</p>
        <div class="flex items-center mt-1">
            <h2 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h2>
            <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ $user->employee_id }}
            </span>
        </div>
    </div>
</div>
