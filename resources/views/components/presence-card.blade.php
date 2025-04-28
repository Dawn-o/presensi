@props(['presence', 'route'])

<div class="bg-white shadow sm:rounded-lg">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">Absensi Hari Ini</h2>
            @if ($presence)
                <x-status-badge :status="$presence->status" class="px-3 py-1 text-sm" />
            @else
                <x-status-badge status="none" class="px-3 py-1 text-sm" />
            @endif
        </div>

        <!-- Alert messages -->
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        <div class="mt-6">
            <x-attendance-times :checkIn="$presence?->check_in" :checkOut="$presence?->check_out" />
        </div>

        @if (!$presence || !$presence->check_out)
            <div class="mt-6 md:flex md:justify-end">
                <form action="{{ $route }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium sm:rounded-md text-white {{ $presence && $presence->check_in ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} transition-colors duration-200">
                        <x-icons.login class="h-5 w-5 -ml-1 mr-2" />
                        {{ $presence && $presence->check_in ? 'Presensi Pulang' : 'Presensi Masuk' }}
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
