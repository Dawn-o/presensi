@props(['employee'])

<div class="bg-white shadow sm:rounded-lg mb-4 p-4">
    <div class="flex justify-between items-start space-x-2">
        <div class="min-w-0 flex-1">
            <h3 class="text-sm font-medium text-gray-900 break-words">{{ $employee->name }}</h3>
            <p class="text-xs text-gray-500 mt-1">{{ $employee->employee_id }}</p>
        </div>
        <div class="flex-shrink-0">
            <x-employee-status-badge :presence="$employee->presences->first()" size="large" />
        </div>
    </div>
    <div class="mt-3 grid grid-cols-2 gap-4 text-sm">
        <div>
            <p class="text-gray-500">Jam Masuk</p>
            <p class="font-medium">{{ $employee->presences->first()?->check_in?->format('H:i') ?? '-' }}</p>
        </div>
        <div>
            <p class="text-gray-500">Jam Pulang</p>
            <p class="font-medium">{{ $employee->presences->first()?->check_out?->format('H:i') ?? '-' }}</p>
        </div>
    </div>
</div>
