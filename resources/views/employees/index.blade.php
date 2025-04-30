<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <x-page-header-card title="Daftar Karyawan" subtitle="{{ now()->format('l, d F Y') }}">
            <x-slot name="icon">
                <x-icons.users class="h-6 w-6 text-indigo-600" />
            </x-slot>

            <x-slot name="action">
                <div class="flex flex-col sm:flex-row w-full sm:w-auto space-y-2 sm:space-y-0 sm:space-x-4">
                    <!-- Recap Button -->
                    <x-page-action-button :route="route('presence.recap')" variant="secondary" class="w-full sm:w-auto">
                        <x-slot name="icon">
                            <x-icons.chart class="-ml-1 mr-2 h-5 w-5 text-gray-500" />
                        </x-slot>
                        Rekap Kehadiran
                    </x-page-action-button>

                    <!-- Presence Page Button -->
                    <x-page-action-button :route="route('presence.index')" variant="primary" class="w-full sm:w-auto">
                        <x-slot name="icon">
                            <x-icons.clock class="-ml-1 mr-2 h-5 w-5" />
                        </x-slot>
                        Halaman Presensi
                    </x-page-action-button>
                </div>
            </x-slot>
        </x-page-header-card>

        <!-- Stats Summary -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
            <!-- Total Employees -->
            <x-stat-card title="Total Karyawan" :value="count($employees)" color="gray">
                <x-slot name="icon">
                    <x-icons.users class="h-5 w-5 text-gray-600" />
                </x-slot>
            </x-stat-card>

            <!-- Present Employees -->
            <x-stat-card title="Hadir" :value="$employees->filter(fn($e) => $e->presences->first())->count()" color="green">
                <x-slot name="icon">
                    <x-icons.check-circle class="h-5 w-5 text-green-600" />
                </x-slot>
            </x-stat-card>

            <!-- On-time Employees -->
            <x-stat-card title="Tepat Waktu" :value="$employees->filter(fn($e) => $e->presences->first()?->status === 'present')->count()" color="indigo">
                <x-slot name="icon">
                    <x-icons.clock class="h-5 w-5 text-indigo-600" />
                </x-slot>
            </x-stat-card>

            <!-- Late Employees -->
            <x-stat-card title="Terlambat" :value="$employees->filter(fn($e) => $e->presences->first()?->status === 'late')->count()" color="amber">
                <x-slot name="icon">
                    <x-icons.warning class="h-5 w-5 text-amber-500" />
                </x-slot>
            </x-stat-card>
        </div>

        <!-- Mobile View -->
        <div class="mt-6 sm:hidden space-y-4">
            @foreach ($employees as $employee)
                <x-employee-card :employee="$employee" />
            @endforeach
        </div>

        <!-- Desktop View -->
        <div class="hidden sm:block mt-8">
            @include('partials.employee-table')
        </div>
    </div>
</x-app-layout>
