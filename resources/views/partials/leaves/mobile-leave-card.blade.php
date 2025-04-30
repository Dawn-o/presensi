<div class="px-4 py-3 border-b border-gray-200">
    <div class="space-y-2">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-900">{{ $leave->user->name }}</p>
                <p class="text-xs text-gray-500">
                    {{ $leave->start_date->format('d/m/Y') }}
                    @if($leave->start_date->format('d/m/Y') !== $leave->end_date->format('d/m/Y'))
                        - {{ $leave->end_date->format('d/m/Y') }}
                    @endif
                </p>
            </div>
            <x-leave-type-badge :type="$leave->type" />
        </div>
        <p class="text-sm text-gray-600">{{ $leave->reason }}</p>
        <div class="flex space-x-2 pt-2">
            <x-leave-action-buttons :leave="$leave" size="md" />
        </div>
    </div>
</div>
