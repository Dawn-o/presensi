<div class="flex-1 min-w-0">
    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
        Rekap Kehadiran
    </h2>
    @if (auth()->user()->is_admin && $user->id !== auth()->id())
        <div class="mt-2 flex flex-wrap items-center gap-2">
            <span class="text-base sm:text-lg text-gray-600 truncate">{{ $user->name }}</span>
            <span class="inline-flex items-center px-2.5 py-0.5 sm:rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                {{ $user->employee_id }}
            </span>
        </div>
    @endif
</div>
